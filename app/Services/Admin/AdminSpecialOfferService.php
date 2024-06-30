<?php

namespace App\Services\Admin;

use App\Infrastructure\Services\SpecialOfferService;
use App\Models\SpecialOffer;
use Illuminate\Support\Facades\DB;
use App\Infrastructure\Services\FileService;
use App\Infrastructure\Interfaces\LogInterface;

class AdminSpecialOfferService extends SpecialOfferService
{
    /**
     * Model: SpecialOffer
     *
     * @var object
     */

    protected $specialOffer;
    /**
     * LogInterface implementation
     *
     * @var object
     */

    protected $logger;

    /**
     * fileService
     *
     * @var object
     */
    protected $fileService;

    /**
     * Construct specialOffer service
     *
     * @param SpecialOffer $specialOffer
     * @param LogInterface $logger
     * 
     */
    public function __construct(SpecialOffer $specialOffer, LogInterface $logger, FileService $fileService)
    {
        parent::__construct($specialOffer, $logger);
        
        (object) $this->fileService = $fileService;
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

        DB::beginTransaction();

        try {
            $file = $data['image'];
            $filename = $this->fileService->uploadFile($file, 'img/special-offers/');
            $path = 'img/special-offers/' . $filename;
            $data['image'] = $path;
            $this->specialOffer::create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error('Error loading images: ' . $e->getMessage());
        }
    }

    /**
     * Update current specialOffer
     *
     * @param array $data
     * 
     */
    public function updateSpecialOffer(array $data, int $id)
    {
        $specialOffer = $this->getSpecialOfferById($id);

        if (!$specialOffer) {
            $this->logger->error('The special offer with ID ' . $id . ' was not found.');
            return;
        }
        DB::beginTransaction();

        try {
            if ($data['image'] == null) {
                unset($data['image']);
            } else {
                try {
                    $file = $data['image'];
                    $filename = $this->fileService->uploadFile($file, 'img/special-offers/');
                    $path = 'img/special-offers/' . $filename;
                    $data['image'] = $path;
                } catch (\Exception $e) {
                    $this->logger->error('Error loading images: ' . $e->getMessage());
                    return;
                }
            }

            $specialOffer->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
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

    /**
     * Func for chenge activity of special offer
     *
     * @param int $id
     * @return string
     * 
     */
    public function toggleActivity(int $id): ?string
    {
        $specialOffer = $this->getSpecialOfferById($id);
        if ($specialOffer) {
            $specialOffer->is_active == 1 ? $specialOffer->is_active = 0 : $specialOffer->is_active = 1;
            $specialOffer->save();

            return 'Активность изменена';
        } else {
            return null;
        }
    }
}
