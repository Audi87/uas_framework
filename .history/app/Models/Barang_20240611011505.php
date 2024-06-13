<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

protected $guarded  = ['id'];

public function category(){
    return $this->belongsTo(Category::class);
}

public function peminjamanDetail(){
    return $this->hasMany(PeminjamanDetail::class);
}


}
