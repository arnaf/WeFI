<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPembayaran extends Model
{
    protected $fillable = [
        'tagihan_id',
        'user_id',
        'bimbel_id',
        'debit',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class);
    }

    // public function bimbel()
    // {
    //     return $this->belongsTo(Bimbel::class);
    // }
}
