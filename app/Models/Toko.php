<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Toko extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    protected $fillable = [
        'name',
        'lokasi',
        'phone'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function data_barangs(){
        return $this->hasMany(DataBarang::class);
    }

    public function metode_pembayarans(){
        return $this->hasMany(MetodePembayaran::class);
    }
}
