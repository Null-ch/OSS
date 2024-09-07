<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Infrastructure\Services\ResponseService;
use App\Services\Api\Client\ClientSpecialOfferService;

class SpecialOfferController extends Controller
{
    protected $specialOffer;
    protected $responseService;


    public function __construct(ClientSpecialOfferService $specialOffer, ResponseService $responseService)
    {
        $this->specialOffer = $specialOffer;
        $this->responseService = $responseService;
    }

    /**
     * Getting a list of special offers
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        (object) $data = $this->specialOffer->getSpecialOffers(3);
        $response = $this->responseService->getResponse($data);
        return response()->json($response, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Getting special offer by id
     *
     * @param mixed $id
     * 
     * @return \Illuminate\Http\Response
     * 
     */
    public function show(int $id)
    {
        (object) $data = $this->specialOffer->getSpecialOfferById($id);
        $response = $this->responseService->getResponse($data);
        return response()->json($response, JSON_UNESCAPED_UNICODE);
    }
}
