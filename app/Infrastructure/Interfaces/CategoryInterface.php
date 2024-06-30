<?php

namespace App\Infrastructure\Interfaces;

interface CategoryInterface
{
    public function getCategories(int $count): ?object;

    public function getCategory(int $id): ?object;

}
