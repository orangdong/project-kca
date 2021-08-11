<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    protected $fillable = [
        'kode_member',
        'name',
        'phone',
        'alamat',
        'nik',
        'email'
    ];

    public function orderans(){
        return $this->hasMany(Orderan::class);
    }
}
