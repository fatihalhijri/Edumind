<?php

namespace App\Providers;

use App\Models\Material;
use App\Policies\MaterialPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Strict mode untuk menghindari N+1 di development
        Model::preventLazyLoading(app()->isLocal());

        // Daftarkan Material Policy
        Gate::policy(Material::class, MaterialPolicy::class);
    }
}
