<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    public $timestamps= false;
    protected $fillable=  [
   'provider_user_id','provider_user_email','provider','user',
    ];
    protected $primaryKey= 'user_id ';
    protected $table = 'tbl_social';

    public function customer(){
        return $this->belongsTo('App\Models\customer', 'user');
    }
}

