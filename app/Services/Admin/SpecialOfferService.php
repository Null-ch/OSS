<?php

namespace App\Services\Admin;

use App\Models\SpecialOffer;

class SpecialOfferService
{
/**
     * SpecialOffer class
     *
     * @var object
     */
    private $specialOffer;

    /**
     * Construct specialOffer service
     *
     * @param SpecialOffer $specialOffer
     * 
     */
    public function __construct(SpecialOffer $specialOffer)
    {
        (object) $this->specialOffer = $specialOffer;

    }
    public function getCategory(int $id): object
    {
        return $this->specialOffer::find($id);
    }
    /**
     * Getting all categories
     *
     * @return array
     * 
     */
    public function getAllSpecialOffers(): object
    {
        return $this->specialOffer->getAllSpecialOffers();
    }
    /**
     * Create new category
     *
     * @param object $data
     * 
     */
    public function createCategory(object $data)
    {
        $title = $data->title;
        $this->specialOffer::create(['title' => $title]);
    }
    /**
     * Update current specialOffer
     *
     * @param object $data
     * 
     */
    public function updateCategory(object $data)
    {
        $title = $data->title;
        $this->specialOffer::update(['title' => $title]);
    }
    /**
     * Delete current specialOffer
     *
     * @param int $id
     * 
     */
    public function destroy(int $id)
    {
        $this->specialOffer::destroy($id);
    }
}
