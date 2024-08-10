<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminDeliveryService;
use App\Http\Requests\Admin\DeliveryStoreRequest;
use App\Http\Requests\Admin\DeliveryUpdateRequest;

class DeliveryController extends Controller
{
    protected $deliveryService;

    public function __construct(AdminDeliveryService $deliveryService)
    {
        $this->deliveryService = $deliveryService;
    }

    /**
     * Display a listing of the delivery.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        (object) $deliveries = $this->deliveryService->getDeliveries(10);
        return view('admin.main.delivery.index', compact('deliveries'));
    }

    /**
     * Create the delivery.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.main.delivery.create');
    }

    /**
     * Store a newly created delivery.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeliveryStoreRequest $request)
    {
        (array) $data = $request->validated();
        $this->deliveryService->createDelivery($data);
        return redirect()->route('admin.deliveries.index');
    }

    /**
     * Display the specified delivery.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        (object) $delivery =  $this->deliveryService->getDelivery($id);
        return view('admin.main.delivery.show', compact('delivery'));
    }

    /**
     * Show the form for editing the delivery.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        (object) $delivery = $this->deliveryService->getDelivery($id);
        return view('admin.main.delivery.edit', compact('delivery'));
    }

    /**
     * delivery update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DeliveryUpdateRequest $request, $id)
    {
        (array) $data = $request->validated();
        $this->deliveryService->updateDelivery($data, $id);
        return redirect()->route('admin.delivery.edit', $id);
    }

    /**
     * Remove the delivery.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->deliveryService->destroy($id);
        return response()->json([
            'success' => true,
            'message' => "Пользователь успешно удален",
        ]);
    }

    /**
     * Func for chenge activity of delivery
     *
     * @param mixed $id
     * 
     * @return \Illuminate\Http\Response
     * 
     */
    public function toggleActivity($id)
    {
        $response = $this->deliveryService->toggleActivity($id);
        return response()->json($response, 200);
    }
}
