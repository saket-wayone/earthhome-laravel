<?php

namespace App\Providers;

use App\Repositories\Auth\AuthInterface;
use App\Repositories\AuthRepository;
use App\Repositories\Book\BookInterface;
use App\Repositories\BookRepository;
use App\Repositories\Coupen\CoupenInterface;
use App\Repositories\CoupenRepository;
use App\Repositories\FirmRepository;
use App\Repositories\Firms\FirmInterface;
use App\Repositories\Invoice\InvoiceInterface;
use App\Repositories\InvoiceRepository;
use App\Repositories\LeadRepository;
use App\Repositories\leads\LeadInterface;
use App\Repositories\Manager\ManagerInterface;
use App\Repositories\ManagerRepository;
use App\Repositories\Mr\MrInterface;
use App\Repositories\MrRepository;
use App\Repositories\PlanType\PlanTypeInterface;
use App\Repositories\PlanTypeRepository;
use App\Repositories\Price\PriceInterface;
use App\Repositories\PriceRepository;
use App\Repositories\Project\ProjectInterface ;
use App\Repositories\ProjectRepository;
use App\Repositories\Risk\RiskInterface;
use App\Repositories\RiskRepository;
use App\Repositories\Sales\SalesInterface;
use App\Repositories\SalesRepository;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\ServiceRepository;
use App\Repositories\Source\SourceInterface;
use App\Repositories\SourceRepository;

use App\Repositories\Banner\BannerInterface;
use App\Repositories\BannerRepository;

use App\Repositories\Status\StatusInterface;
use App\Repositories\StatusRepository;
use App\Repositories\User\UserInterface;
use App\Repositories\UserRepository;
use App\Repositories\Withdraw\WithdrawInterface;
use App\Repositories\WithdrawelRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Laravel\Pennant\Feature;

use Illuminate\Pagination\Paginator;
use Laravel\Sail\SailServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthInterface::class, AuthRepository::class);

        // bind with app index
        $this->app->bind(UserInterface::class, UserRepository::class);


        // bind BookRepostory or BookINterface
        $this->app->bind(BookInterface::class, BookRepository::class);

        // bind the mr interface and reporsitory here
        $this->app->bind(MrInterface::class, MrRepository::class);
        // bind the Manager interface and reporsitory here
        $this->app->bind(ManagerInterface::class, ManagerRepository::class);

        // bind the prices interface and reporsitory here
        $this->app->bind(PriceInterface::class, PriceRepository::class);

        // bind the coupen interface and reporsitory here
        $this->app->bind(CoupenInterface::class, CoupenRepository::class);


        // bind the coupen interface and reporsitory here
        $this->app->bind(PlanTypeInterface::class, PlanTypeRepository::class);

        // bind the risk interface and reporsitory here
        $this->app->bind(RiskInterface::class, RiskRepository::class);


        // bind the lead interface and reporsitory here
        $this->app->bind(LeadInterface::class, LeadRepository::class);

        // bind the Status interface and reporsitory here
        $this->app->bind(StatusInterface::class, StatusRepository::class);


        // bind the Source interface and reporsitory here
        $this->app->bind(SourceInterface::class, SourceRepository::class);

                // bind the Banner interface and reporsitory here
        $this->app->bind(BannerInterface::class, BannerRepository::class);



        // bind the Source interface and reporsitory here
        $this->app->bind(ServiceInterface::class, ServiceRepository::class);


         // bind the sales interface and reporsitory here
         $this->app->bind(SalesInterface::class, SalesRepository::class);

        //  bind the project repository and interface
        $this->app->bind(ProjectInterface::class,ProjectRepository::class);

        //  bind the Invoice repository and interface
        $this->app->bind(InvoiceInterface::class,InvoiceRepository::class);
        //  bind the Firm repository and interface
        $this->app->bind(FirmInterface::class,FirmRepository::class);

         //  bind the withdraw repository and interface
         $this->app->bind(WithdrawInterface::class,WithdrawelRepository::class);


    }




    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // feature for admin role
        Feature::define('admin_panel', function () {
            return Auth::check() && Auth::user()->role === 'admin';
        });

        Feature::define('compliance_panel', function () {
            return Auth::check() && Auth::user()->role === 'Compliance';
        });

        Feature::define('manager_panel', function () {
            return Auth::check() && Auth::user()->role === 'manager';
        });
        Paginator::useBootstrap();

    }
}
