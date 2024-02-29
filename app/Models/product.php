<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
class product extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'product_name','product_slug', 'Brand_id','category_id','product_quantity', 'product_desc','product_content','product_price','product_image','product_status','product_tags','product_view','product_cost','meta_keywords',
    ];
    protected $primaryKey = 'product_id';
 	protected $table = 'tbl_product';
     public function category(){
        return $this->belongsTo('App\Models\CategoryProductModel','category_id');
     }
     public function Comment(){
      return $this->hasMany('App\Models\Comment');
  }
}
