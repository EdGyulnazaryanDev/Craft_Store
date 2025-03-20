<?php

namespace App\Providers;

use App\Interfaces\FileUploadServiceInterface;
use App\Interfaces\ProductServiceInterface;
use App\Models\Product;
use App\Models\User;
use App\Policies\ProductPolicy;
use App\Services\LocalFileUploadService;
use App\Services\ProductService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(FileUploadServiceInterface::class, LocalFileUploadService::class);
        $this->app->bind(ProductServiceInterface::class, ProductService::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
//        $permissions = [
//            'create-product',
//            'update-product',
//            'view-product',
//            'delete-product',
//        ];
//
//        foreach ($permissions as $permission) {
//            Gate::define($permission, function (User $user) {
//                return in_array($user->role, ['admin', 'superadmin']);
//            });
//        }
    }
}
