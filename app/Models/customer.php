<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    public $timestamps= false;
   protected $fillable= [
  'customer_name','customer_email','customer_password','customer_phone','customer_picture'
   ];
   protected $primaryKey= 'customer_id';
   protected $table = 'tbl_customr';
}
