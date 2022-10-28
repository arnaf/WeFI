<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $fillable = [
        'user_id',
        'bimbel_id',
        'foto',
        'invoice',
        'status',
        'metode',
        'jml_byr',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function bimbel()
    // {
    //     return $this->belongsTo(Bimbel::class);
    // }

    public function riwayatPembayaran()
    {
        return $this->belongsTo(RiwayatPembayaran::class);
    }

}
