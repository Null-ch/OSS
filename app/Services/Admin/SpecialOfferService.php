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
    /**
     * [Description for getSpecialOffer]
     *
     * @param int $id
     * 
     * @return object
     * 
     */
    public function getSpecialOffer(int $id): object
    {
        return $this->specialOffer::findOrFail($id);
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
     * Create new special offer
     *
     * @param object $data
     * 
     */
    public function createsSpecialOffer(array $data)
    {
        if ($data['is_active'] == 'on') {
            $data['is_active'] = 1;
        } elseif ($data['is_active'] == 'off') {
            $data['is_active'] = 0;
        }
        $file = $data['image'];
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/img/products', $filename);
        $path = 'storage/img/products/' . $filename;
        $data['image'] = $path;
        $this->specialOffer::create($data);
    }
    /**
     * Update current specialOffer
     *
     * @param object $data
     * 
     */
    public function updateSpecialOffer(array $data, int $id)
    {
        $specialOffer = $this->getSpecialOffer($id);

        if ($data['is_active'] == 'on') {
            $data['is_active'] = 1;
        } elseif ($data['is_active'] == 'off') {
            $data['is_active'] = 0;
        }

        if ($data['image'] == null) {
            unset($data['image']);
        } else {
            $file = $data['image'];
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/img/products', $filename);
            $path = 'storage/img/products/' . $filename;
            $data['image'] = $path;
        }
        $specialOffer->update($data);
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
