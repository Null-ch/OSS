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
     * @return void
     */
    public function createOrder(StoreOrderRequest $request)
    {
        $data = $request->validated();
        // $responseData = $this->orderService->createOrder($data);
        $responseData = ['sps', $data];
        $response = $this->responseService->getResponse($responseData);
        return response()->json($response, JSON_UNESCAPED_UNICODE);
    }

    /**
     * cancelOrder
     *
     * @param  mixed $id
     * @return void
     */
    public function cancelOrder($id)
    {
        // $responseData = $this->orderService->cancelOrder($id);
        $responseData = ['sps', $id];
        $response = $this->responseService->getResponse($responseData);
        return response()->json($response, JSON_UNESCAPED_UNICODE);
    }
    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }
}
