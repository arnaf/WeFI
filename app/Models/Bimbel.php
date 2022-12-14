<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bimbel extends Model
{
    protected $fillable =[
        'kelas_id', 'user_id',
    ];

    public function tagihan()
    {
        return $this->hasMany(Tagihan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

}
