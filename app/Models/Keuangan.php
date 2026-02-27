<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Keuangan extends Model
{
    protected $table = 'keuangan';

    protected $fillable = [
        'reference',
        'admin_id',
        'kategori',
        'payment_method',
        'pemasukan',
        'pengeluaran',
        'saldo',
        'keterangan'
    ];

    // pastikan timestamps aktif
    public $timestamps = true;

    protected $casts = [
        'pemasukan' => 'integer',
        'pengeluaran' => 'integer',
        'saldo' => 'integer',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}