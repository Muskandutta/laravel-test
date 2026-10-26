<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOrderRequest;
use App\Http\Requests\Api\UpdateOrderStatusRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly OrderService $orderService
    ) {}

    /**
     * GET /api/orders
     * List orders with optional email filter & pagination.
     *
     * Query params:
     *   - email    : string — filter by customer email
     *   - status   : string — filter by order status
     *   - per_page : int    — items per page (default: 15)
     */
    public function index(Request $request): JsonResponse
    {
        $query = Order::with('items')
            ->latest();

        if ($email = $request->query('email')) {
            $query->where('customer_email', $email);
        }

        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }

        $perPage = min((int) $request->query('per_page', 15), 50);
        $orders  = $query->paginate($perPage);

        return $this->success(
            OrderResource::collection($orders),
            'Orders retrieved successfully.',
            200,
            [
                'current_page' => $orders->currentPage(),
                'last_page'    => $orders->lastPage(),
                'per_page'     => $orders->perPage(),
                'total'        => $orders->total(),
            ]
        );
    }

    /**
     * POST /api/orders
     * Place a new order.
     */
    public function store(StoreOrderRequest $request): JsonResponse
    {
        try {
            $order = $this->orderService->createOrder($request->validated());

            return $this->created(
                new OrderResource($order),
                'Order placed successfully.'
            );
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 422);
        }
    }

    /**
     * GET /api/orders/{id}
     * Get a single order's full details.
     */
    public function show(int $id): JsonResponse
    {
        $order = Order::with('items.product')->find($id);

        if (! $order) {
            return $this->notFound('Order not found.');
        }

        return $this->success(
            new OrderResource($order),
            'Order retrieved successfully.'
        );
    }

    /**
     * PATCH /api/orders/{id}/status
     * Update the status of an order (with transition validation).
     */
    public function updateStatus(UpdateOrderStatusRequest $request, int $id): JsonResponse
    {
        $order = Order::with('items.product')->find($id);

        if (! $order) {
            return $this->notFound('Order not found.');
        }

        try {
            $order = $this->orderService->updateStatus($order, $request->validated('status'));

            return $this->success(
                new OrderResource($order),
                "Order status updated to '{$order->status}'."
            );
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 422);
        }
    }
}
