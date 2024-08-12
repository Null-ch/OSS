<?php

namespace App\Http\Controllers\Api\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Infrastructure\Services\ResponseService;
use App\Services\Api\Client\ClientDeliveryService;

class DeliveryController extends Controller
{
    protected $deliveryService;
    protected $responseService;

    public function __construct(ClientDeliveryService $deliveryService,  ResponseService $responseService)
    {
        $this->deliveryService = $deliveryService;
        $this->responseService = $responseService;
    }

    /**
     * Getting a list of deliveries (client)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        (object) $data = $this->deliveryService->getDeliveries(10);
        $response = $this->responseService->getResponse($data);
        return response()->json($response, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Getting a delivery by id (client)
     *
     * @param int $id
     * 
     * @return \Illuminate\Http\Response
     * 
     */
    public function show($id)
    {
        (object) $data = $this->deliveryService->getDelivery($id);
        $response = $this->responseService->getResponse($data);
        return response()->json($response, JSON_UNESCAPED_UNICODE);
    }
}
