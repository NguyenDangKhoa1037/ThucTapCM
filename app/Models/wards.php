<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wards extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name_xaphuong','type','maqh'
    ];
    protected $primarykey = 'xaid';
    protected $table = 'tbl_xaphuongthitran';
}
