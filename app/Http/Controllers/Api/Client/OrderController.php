<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Services\Api\Client\ClientOrderService;
use App\Http\Requests\Client\Order\StoreOrderRequest;
use App\Infrastructure\Services\ResponseService;
use App\Infrastructure\Services\UserService;

class OrderController extends Controller
{    
    /**
     * orderService
     *
     * @var object
     */
    protected $orderService;  
  
    /**
     * responseService
     *
     * @var mixed
     */
    protected $responseService;   

    /**
     * __construct
     *
     * @param  object $orderService
     */
    public function __construct(ClientOrderService $orderService, ResponseService $responseService)
    {
        $this->orderService = $orderService;
        $this->responseService = $responseService;
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
        $responseData = $this->orderService->createOrder($data);
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
