<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Payment;
use App\Observers\PaymentObserver;


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

    public function boot()
    {
        // SMTP
        Config::set('mail.mailers.smtp.host', setting('smtp_host'));
        Config::set('mail.mailers.smtp.port', setting('smtp_port'));
        Config::set('mail.mailers.smtp.username', setting('smtp_username'));
        Config::set('mail.mailers.smtp.password', setting('smtp_password'));
        Config::set('mail.mailers.smtp.encryption', setting('smtp_encryption'));

        // Midtrans
        Config::set('midtrans.server_key', setting('midtrans_server_key'));
        Config::set('midtrans.client_key', setting('midtrans_client_key'));
        Config::set('midtrans.is_production', setting('midtrans_is_production') === 'true');

        // Pembayaran
        Payment::observe(PaymentObserver::class);
    }
}
