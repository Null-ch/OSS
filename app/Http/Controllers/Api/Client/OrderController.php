<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Infrastructure\Services\OrderService;
use App\Infrastructure\Services\PaymentService;
use App\Services\Api\Client\ClientOrderService;
use App\Infrastructure\Services\ResponseService;
use App\Http\Requests\Client\Order\StoreOrderRequest;

class OrderController extends Controller
{    
    /**
     * orderService
     *
     * @var OrderService
     */
    protected $orderService;  
  
    /**
     * responseService
     *
     * @var ResponseService
     */
    protected $responseService;     
    /**
     * paymentService
     *
     * @var PaymentService
     */
    protected $paymentService;  

    /**
     * __construct
     *
     * @param  object $orderService
     */
    public function __construct(ClientOrderService $orderService, ResponseService $responseService, PaymentService $paymentService)
    {
        $this->orderService = $orderService;
        $this->responseService = $responseService;
        $this->paymentService = $paymentService;
    }

    /**
     * createOrder
     *
     * @param  mixed $request
     * @return \Illuminate\Http\Response
     */
    public function createOrder(StoreOrderRequest $request)
    {
        $data = $request->validated();
        $order = $this->orderService->createOrder($data);
        $responseData = $this->paymentService->Pay($order);
        $response = $this->responseService->getResponse($responseData);
        return response()->json($response, JSON_UNESCAPED_UNICODE);
    }

    /**
     * cancelOrder
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function cancelOrder(int $id)
    {
        $responseData = $this->orderService->cancelOrder($id);
        $response = $this->responseService->getResponse($responseData);
        return response()->json($response, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Method orderComplete
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function orderComplete(int $id)
    {
        $responseData = $this->orderService->orderComplete($id);
        $response = $this->responseService->getResponse($responseData);
        return response()->json($response, JSON_UNESCAPED_UNICODE);
    }
}
