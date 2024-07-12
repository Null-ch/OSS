<?php

namespace App\Services\Api\Client;

use App\Models\Product;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\ProductService;

class ClientProductService extends ProductService
{
    /**
     * LogInterface implementation
     *
     * @var object
     */
    protected $logger;


    /**
     * Model: Product
     *
     * @var object
     */
    protected $product;

    /**
     * Construct client product service
     *
     * @param LogInterface $logger
     * @param Product $product
     * 
     */
    public function __construct(Product $product, LogInterface $logger)
    {
        parent::__construct($product, $logger);
    }

    /**
     * Method checkAvailability
     *
     *
     * @return array
     */
    public function checkAvailability(array $data): ?array
    {
        try {
            if (empty($data)) {
                return null;
            }

            $output = [];
            $error = false;

            if (isset($data)) {
                foreach ($data as $key => $value) {
                    $product = $this->product->find($value['id']);
                    if (!isset($product)) {
                        $output[] = [
                            'id' => $value['id'],
                            'availability' => false,
                            'quantity' => 0,
                            'message' => 'Товара не существует',
                        ];
                        $error = true;
                    } else {
                        if ($product->quantity < $value['quantity']) {
                            $availability = false;
                            $error = true;
                        } else {
                            $availability = true;
                        }

                        $output[] = [
                            'id' => $product->id,
                            'availability' => $availability,
                            'quantity' => $product->quantity
                        ];
                        $output['error'] = $error;
                    }
                }
                return $output;
            }
        } catch (\Exception $e) {
            $this->logger->error('' . $e->getMessage());
            return null;
        }
    }
}
