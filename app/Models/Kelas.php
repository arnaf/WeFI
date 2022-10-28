<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelass'; //Ini ditambahin soalnya si model ngga bisa baca nama tabelnya. sebenernya secara otomatis baca cuma kalau belakangnya s => kela(s) jadinya bakal nyari di dbnya kelases bukan kelass. Di db saya namainnya kelass harusnya kelases.
    protected $fillable =[
        'kategori_id',
        'gambar',
        'judulkelas',
        'pengajar',
        'deskripsi',
        'kode',
        'harga',
        // 'status'
    ];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function bimbel()
    {
        return $this->hasMany(Bimbel::class);
    }
}
