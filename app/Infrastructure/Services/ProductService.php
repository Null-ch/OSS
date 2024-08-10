<?php

namespace App\Infrastructure\Services;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Connection;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Interfaces\ProductInterface;

class ProductService implements ProductInterface
{
    /**
     * Model: Product
     *
     * @var object
     */
    protected $product;
    /**
     * Category class
     *
     * @var object
     */
    protected $logger;

    /**
     * Construct product service
     *
     * @param Product $product
     * @param Category $category
     * @param LogInterface $logger
     * @param Connection $database
     * 
     */
    public function __construct(
        Product $product,
        LogInterface $logger
    ) {
        $this->product = $product;
        $this->logger = $logger;
    }

    /**
     * Getting products
     *
     * @return object
     * 
     */
    public function getProducts(int $count): ?object
    {
        if (!$count) {
            $this->logger->error('The quantity has not been transferred.');
            return null;
        }

        try {
            $products = $this->product::paginate($count);
        } catch (\Exception $e) {
            $this->logger->error('Error when receiving the products: ' . $e->getMessage());
            return null;
        }

        return $products;
    }

    /**
     * Get product
     *
     * @param int $id
     * 
     * @return object
     * 
     */
    public function getProduct(int $id): ?object
    {
        if (!$id) {
            $this->logger->error('The id has not been transferred.');
            return null;
        }

        try {
            $product = $this->product::findOrFail($id);
        } catch (\Exception $e) {
            $this->logger->error('Error when receiving the product: ' . $e->getMessage());
            return null;
        }

        return $product;
    }

    
    /**
     * Method checkAvailability
     *
     * @param array $data
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
                            'exists' => false,
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
                            'quantity' => $product->quantity,
                            'exists' => true,
                        ];
                    }
                }
                $output['error'] = $error;
            }
        } catch (\Exception $e) {
            $this->logger->error('' . $e->getMessage());
            return null;
        }
        return $output;
    }
}
