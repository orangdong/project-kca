<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    protected $fillable = [
        'toko_id',
        'barcode',
        'name',
        'harga_satuan',
        'stok'
    ];

    public function parcel_items(){
        return $this->hasMany(ParcelItem::class);
    }
}
