<?php

namespace App\Services;

use AllowDynamicProperties;
use App\Interfaces\FileUploadServiceInterface;
use App\Interfaces\ProductServiceInterface;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

#[AllowDynamicProperties] class ProductService implements ProductServiceInterface
{
    public function __construct(FileUploadServiceInterface $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Product::all();
    }

    public function store($data)
    {
        $data['user_id'] = Auth::user()?->id;
        $data['slug'] =  $this->generateUniqueSlug();
        if ($data['image']) {
            $data['image'] = $this->fileUploadService->upload($data['image'], 'products');
        }
        return Product::create($data);
    }

    public function update($product, $data)
    {
        if (isset($data['image']) && !is_null($data['image'])) {
            $this->fileUploadService->delete($product->image);
            $imagePath = $this->fileUploadService->upload($data['image'], 'products');
            $data['image'] = $imagePath;
        }

        return $product->update($data);
    }
    public function destroy($product)
    {
        $this->fileUploadService->delete($product->image);
        return $product->delete($product);
    }

    public function generateUniqueSlug()
    {
        $randomString = Str::random(6);
        $timestamp = Carbon::now()->timestamp;
        return $randomString . '-' . $timestamp;
    }
}
