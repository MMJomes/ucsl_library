<?php

namespace App\Providers;

use App\Repositories\Backend\Impls\RoleRepositoryImpl;
use App\Repositories\Backend\Impls\DashboardRepositoryImpl;
use App\Repositories\Backend\Impls\BookListRepositoryImpl;
use App\Repositories\Backend\Impls\ContactListRepositoryImpl;

use App\Repositories\Backend\Interf\AdminRepository;
use App\Repositories\Backend\Interf\BookListRepository;
use App\Repositories\Backend\Interf\RoleRepository;
use App\Repositories\Backend\Interf\ContactListRepository;
use App\Repositories\Backend\Interf\DashboardRepository;
use App\Repositories\Frontend\Interf\MemberAuthRepository;
use App\Repositories\Frontend\Impls\MemberAuthRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(RoleRepository::class, RoleRepositoryImpl::class);
        $this->app->bind(DashboardRepository::class, DashboardRepositoryImpl::class);
        $this->app->bind(ContactListRepository::class, ContactListRepositoryImpl::class);
        $this->app->bind(BookListRepository::class, BookListRepositoryImpl::class);
        $this->app->bind(MemberAuthRepository::class, MemberAuthRepositoryImpl::class);



    }
}
