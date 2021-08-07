<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    protected $fillable = [
        'toko_id',
        'barcode',
        'data_barang_id',
        'name',
        'satuan',
        'harga',
        'jumlah'
    ];

    public function diskon(){
        return $this->belongsTo(Diskon::class);
    }

    public function special_price(){
        return $this->belongsTo(SpecialPrice::class);
    }

    public function buy_get(){
        return $this->belongsTo(BuyGet::class);
    }
}
