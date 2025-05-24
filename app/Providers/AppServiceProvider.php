<?php

namespace App\Providers;

use App\Domain\Book\BookRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\EloquentBookRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(BookRepositoryInterface::class, EloquentBookRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
