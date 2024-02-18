<?php

namespace App\Services\Admin;

use App\Models\SpecialOffer;
use App\Services\LogInterface;

class SpecialOfferService
{
    /**
     * Model: SpecialOffer
     *
     * @var object
     */

    private $specialOffer;
    /**
     * LogInterface implementation
     *
     * @var object
     */

    private $logger;

    /**
     * Construct specialOffer service
     *
     * @param SpecialOffer $specialOffer
     * 
     */
    public function __construct(SpecialOffer $specialOffer, LogInterface $logger)
    {
        (object) $this->specialOffer = $specialOffer;
        (object) $this->logger = $logger;
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
        try {
            $specialOffer = $this->specialOffer::findOrFail($id);
        } catch (\Exception $e) {
            $this->logger->error('Error when receiving the special offer: ' . $e->getMessage());
            return [];
        }

        return $specialOffer;
    }

    /**
     * Getting all categories
     *
     * @return array
     * 
     */
    public function getAllSpecialOffers(): object
    {
        try {
            $specialOffers = $this->specialOffer->getAllSpecialOffers();
        } catch (\Exception $e) {
            $this->logger->error('Error when receiving the special offers: ' . $e->getMessage());
            return [];
        }

        return $specialOffers;
    }

    /**
     * Create new special offer
     *
     * @param object $data
     * 
     */
    public function createsSpecialOffer(array $data)
    {
        if (!$data) {
            $this->logger->error('The data has not been transferred.');
        }

        if ($data['is_active'] == 'on') {
            $data['is_active'] = 1;
        } elseif ($data['is_active'] == 'off') {
            $data['is_active'] = 0;
        }

        $file = $data['image'];
        try {
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/img/special-offers', $filename);
            $path = 'storage/img/special-offers/' . $filename;
            $data['image'] = $path;
            $this->specialOffer::create($data);
        } catch (\Exception $e) {
            $this->logger->error('Error loading images: ' . $e->getMessage());
            return [];
        }
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

        if (!$specialOffer) {
            $this->logger->error('The special offer with ID ' . $id . ' was not found.');
            return;
        }

        try {
            if ($data['is_active'] == 'on') {
                $data['is_active'] = 1;
            } elseif ($data['is_active'] == 'off') {
                $data['is_active'] = 0;
            }

            if ($data['image'] == null) {
                unset($data['image']);
            } else {
                try {
                    $file = $data['image'];
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs('public/img/special-offers', $filename);
                    $path = 'storage/img/special-offers/' . $filename;
                    $data['image'] = $path;
                } catch (\Exception $e) {
                    $this->logger->error('Error loading images: ' . $e->getMessage());
                    return;
                }
            }

            $specialOffer->update($data);
        } catch (\Exception $e) {
            $this->logger->error('Error updating the special offer: ' . $e->getMessage());
            return;
        }
    }

    /**
     * Delete current specialOffer
     *
     * @param int $id
     * 
     */
    public function destroy(int $id)
    {
        try {
            $this->specialOffer::destroy($id);
        } catch (\Exception $e) {
            $this->logger->error('Error when deleting a special offer: ' . $e->getMessage());
        }
    }
}
