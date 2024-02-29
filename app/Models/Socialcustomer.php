<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socialcustomer extends Model
{
    public $timestamps= false;
    protected $fillable=  [
   'provider_user_id','provider_user_email','provider','user',
    ];
    protected $primaryKey= 'user_id ';
    protected $table = 'tbl_social_customer';

    public function Login(){
        return $this->belongsTo('App\Models\Login', 'user');
    }
}
