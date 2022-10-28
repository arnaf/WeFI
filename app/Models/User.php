<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'nama',
        'tgl_lhr',
        'tmp_lhr',
        'alamat',
        'pendidikan',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function bimbel()
    // {
    //     return $this->hasMany(Bimbel::class);
    // }

    public function tagihan()
    {
        return $this->hasMany(Tagihan::class);
    }

    public function bimbel()
    {
        return $this->hasMany(Bimbel::class);
    }

    // public function riwayatPembayaran()
    // {
    //     return $this->hasMany(RiwayatPembayaran::class);
    // }
}
