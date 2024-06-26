<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function peminjaman(){
        return $this->belongsTo(Peminjaman::class);
    }

    public function barang(){
        return $this->belongsTo(Barang::class);
    }

}
