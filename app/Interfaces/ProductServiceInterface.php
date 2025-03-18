<?php

namespace App\Interfaces;

interface ProductServiceInterface
{
    public function getAll();
    public function store($data);
    public function update($product, $data);
    public function destroy($product);
    public function generateUniqueSlug();
}
