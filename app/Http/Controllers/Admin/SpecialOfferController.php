<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SpecialOfferRequest;
use App\Services\Admin\SpecialOfferService;
use App\Http\Requests\SpecialOfferUpdateRequest;

class SpecialOfferController extends Controller
{
    protected $specialOfferService;

    public function __construct(SpecialOfferService $specialOfferService)
    {
        $this->specialOfferService = $specialOfferService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        (object) $specialOffers = $this->specialOfferService->getAllSpecialOffers();
        return view('admin.main.special_offer.index', compact('specialOffers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.main.special_offer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecialOfferRequest $request)
    {
        $data = $request->validated();
        $this->specialOfferService->createsSpecialOffer($data);
        return redirect()->route('admin.special-offers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        (object) $specialOffer = $this->specialOfferService->getSpecialOffer($id);
        return view('admin.main.special_offer.show', compact('specialOffer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        (object) $specialOffer = $this->specialOfferService->getSpecialOffer($id);
        return view('admin.main.special_offer.edit', compact('specialOffer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SpecialOfferUpdateRequest $request, $id)
    {
        $data = $request->validated();
        $this->specialOfferService->updateSpecialOffer($data, $id);
        return redirect()->route('admin.special-offers.index', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->specialOfferService->destroy($id);
        return redirect()->route('admin.special_offer.index');
    }
    public function toggleActivity($id)
    {
        (object) $specialOffer = $this->specialOfferService->getSpecialOffer($id);
        $specialOffer->is_active == 1 ? $specialOffer->is_active = 0 : $specialOffer->is_active = 1;
        $specialOffer->save();

        return response()->json(['success' => true]);
    }
}
