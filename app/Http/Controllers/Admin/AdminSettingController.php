<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Midtrans\Config;
use Midtrans\Snap;

class AdminSettingController extends Controller
{
    public function index()
    {
        $settings = DB::table('settings')
            ->orderBy('id')
            ->get()
            ->groupBy('group');

        return view('admin.settings.index', compact('settings'));
    }


    public function update(Request $request)
    {
        foreach ($request->settings as $key => $value) {

            // Kalau password kosong, skip update (biar tidak double encrypt)
            if (in_array($key, ['smtp_password', 'midtrans_server_key'])) {

                if (empty($value)) {
                    continue; // jangan update
                }

                $value = Crypt::encryptString($value);
            }

            DB::table('settings')
                ->where('key', $key)
                ->update([
                    'value' => $value
                ]);

            Cache::forget("setting_{$key}");
        }

        return back()->with('success', 'Pengaturan berhasil diperbarui');
    }


    public function testSmtp()
    {
        try {

            config([
                'mail.default' => 'smtp',
                'mail.mailers.smtp.transport' => 'smtp',
                'mail.mailers.smtp.host' => setting('smtp_host'),
                'mail.mailers.smtp.port' => setting('smtp_port'),
                'mail.mailers.smtp.encryption' => setting('smtp_encryption'),
                'mail.mailers.smtp.username' => setting('smtp_username'),
                'mail.mailers.smtp.password' => setting('smtp_password'),
                'mail.from.address' => setting('smtp_username'),
                'mail.from.name' => setting('site_name', 'Oriental Kost'),
            ]);

            Mail::raw('SMTP Test Email dari sistem Oriental Kost.', function ($message) {
                $message->to(setting('smtp_username'))
                    ->subject('Test SMTP Berhasil');
            });

            return back()->with('success', 'SMTP berhasil mengirim email!');
        } catch (\Throwable $e) {

            dd($e->getMessage());
        }
    }




    public function testMidtrans()
    {
        try {

            Config::$serverKey = setting('midtrans_server_key');
            Config::$isProduction = setting('midtrans_is_production') === 'true';
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => 'TEST-' . uniqid(),
                    'gross_amount' => 10000,
                ],
                'customer_details' => [
                    'first_name' => 'Test User',
                    'email' => 'test@email.com',
                ],
            ];

            $snapToken = Snap::getSnapToken($params);

            return back()->with('success', 'Midtrans berhasil! Snap Token dibuat.');
        } catch (\Exception $e) {

            return back()->with('error', 'Midtrans gagal: ' . $e->getMessage());
        }
    }
}
