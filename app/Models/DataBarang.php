<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataBarang extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    protected $fillable = [
        'toko_id',
        'barcode',
        'name',
        'satuan',
        'harga_satuan',
        'stok'
    ];

    public function buy_get(){
        return $this->hasOne(BuyGet::class);
    }

    public function diskon(){
        return $this->hasOne(Diskon::class);
    }

    public function special_price(){
        return $this->hasOne(SpecialPrice::class);
    }

}
