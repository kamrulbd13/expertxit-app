<?php

namespace App\Providers;
use App\Models\Event;
use App\Models\ITServiceCategory;
use App\Models\KidsProgramming;
use App\Models\KidsProgrammingCategory;
use App\Models\SoftwareCategory;
use App\Models\SystemMailSetting;
use App\Models\SystemSetting;
use App\Models\Training;
use App\Models\TrainingCategory;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use View;
use Auth;


use Illuminate\Support\ServiceProvider;

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

        Schema::defaultStringLength(191);
        //bootstrap link
        Paginator::useBootstrap();
//        for chat
        $this->loadRoutesFrom(base_path('routes/WebCustomer.php'));
        $this->loadRoutesFrom(base_path('routes/WebAdmin.php'));


//        relation with
        Relation::morphMap([
            'admin' => \App\Models\User::class,
            'customer' => \App\Models\Customer::class,
        ]);




//        system mail setting
        try {
            // Check if DB is connected and the table exists
            if (Schema::hasTable('system_mail_settings')) {
                $activeSetting = SystemMailSetting::where('status', 1)->first();

                if ($activeSetting) {
                    Config::set('mail.default', $activeSetting->mail_mailer ?? 'smtp');
                    Config::set('mail.mailers.smtp.host', $activeSetting->mail_host);
                    Config::set('mail.mailers.smtp.port', (int)$activeSetting->mail_port);
                    Config::set('mail.mailers.smtp.encryption', $activeSetting->mail_encryption);
                    Config::set('mail.mailers.smtp.username', $activeSetting->mail_username);
                    Config::set('mail.mailers.smtp.password', $activeSetting->mail_password);
                    Config::set('mail.from.address', $activeSetting->mail_from_address);
                    Config::set('mail.from.name', $activeSetting->mail_from_name);
                }
            }
        } catch (\Exception $e) {
            // Optionally log the exception or ignore
            // \Log::error("Mail setting error: " . $e->getMessage());
        }

// Site name setting
        try {
            if (Schema::hasTable('system_settings')) {
                $settings = SystemSetting::first();
                $siteName = $settings->site_name ?? config('app.name');

                config([
                    'app.name' => $siteName,
                    'mail.from.name' => $siteName,
                    'mail.from.address' => $settings->site_email ?? env('MAIL_FROM_ADDRESS', 'microcodelab@gmail.com'),
                ]);
            }
        } catch (\Exception $e) {
            config([
                'app.name' => env('APP_NAME', 'Laravel'),
                'mail.from.name' => env('MAIL_FROM_NAME', 'defaults'),
                'mail.from.address' => env('MAIL_FROM_ADDRESS', 'microcodelab@gmail.com'),
            ]);
        }


        View::composer([
            '*',
            '*'
        ], function ($view) {
            $view->with('customer', Auth::guard('customer')->user());
            $view->with('upComingEvents', Event::where('status', 1)->orderBy('created_at', 'desc')->limit(10)->get());
            $view->with('totalEvent', Event::where('status', 1)->count());
            $view->with('trainingCategories', TrainingCategory::where('status', 1)->get());
            $view->with('trainings', Training::where('status', 1)->get());

            $view->with('softwareCategories', SoftwareCategory::where('status', 1)->get());
            $view->with('trainings', Training::where('status', 1)->get());

            $view->with('itServiceCategories', ITServiceCategory::where('status', 1)->get());
            $view->with('trainings', Training::where('status', 1)->get());

            $view->with('kidsProgrammeCategories', KidsProgrammingCategory::where('status', 1)->get());
            $view->with('kidsProgrammes', KidsProgramming::where('status', 1)->get());


            $view->with('systemInfo', SystemSetting::first());
            $view->with('admin', Auth::guard('admin')->user());
        });

    }






























}
