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
    public function __construct(
        Product $product,
        LogInterface $logger
    ) {
        parent::__construct($product, $logger);
    }
}
