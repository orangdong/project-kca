<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangOrder extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    protected $fillable = [
        'orderan_id',
        'data_barang_id',
        'parcel',
        'name',
        'harga_satuan',
        'jumlah',
        'harga_subtotal'
    ];

    public function orderan(){
        return $this->belongsTo(Orderan::class);
    }

    public function history_diskons(){
        return $this->hasMany(HistoryDiskon::class);
    }

    public function history_special_prices(){
        return $this->hasMany(HistorySpecialPrice::class);
    }

    public function history_buy_gets(){
        return $this->hasMany(HistoryBuyGet::class);
    }

}
