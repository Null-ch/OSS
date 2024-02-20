<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SpecialOfferRequest;
use App\Services\Admin\SpecialOfferService;
use App\Http\Requests\Admin\SpecialOfferUpdateRequest;

class SpecialOfferController extends Controller
{
    protected $specialOfferService;

    public function __construct(SpecialOfferService $specialOfferService)
    {
        $this->specialOfferService = $specialOfferService;
    }

    /**
     * Display a listing of the current special offers.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        (object) $specialOffers = $this->specialOfferService->getAllSpecialOffers();
        return view('admin.main.special_offer.index', compact('specialOffers'));
    }

    /**
     * Show the form for creating a new special offer.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.main.special_offer.create');
    }

    /**
     * Store a newly created special offer.
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
     * Display the current special offer.
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
     * Show the form for editing the current special offer.
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
     * Update current special offer.
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
     * Remove current special offer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->specialOfferService->destroy($id);
        return response()->json([
            'success' => true,
            'message' => "Пользователь успешно удален",
        ]);
    }
    /**
     * Func for chenge activity of special offer
     *
     * @param mixed $id
     * 
     * @return \Illuminate\Http\Response
     * 
     */
    public function toggleActivity($id)
    {
        (object) $specialOffer = $this->specialOfferService->getSpecialOffer($id);
        $specialOffer->is_active == 1 ? $specialOffer->is_active = 0 : $specialOffer->is_active = 1;
        $specialOffer->save();

        return response()->json(['success' => true]);
    }
}
