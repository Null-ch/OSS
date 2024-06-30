<?php

namespace App\Infrastructure\Interfaces;

interface ProductInterface
{
    public function getProducts(int $count): ?object;
    public function getProduct(int $id): ?object;
}
