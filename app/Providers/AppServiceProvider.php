<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\customer;
use App\Models\Login;
use App\Models\order;
use App\Models\Post;
use App\Models\product;
use Illuminate\Support\Facades\Redirect;
use App\Models\Social;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Socialcustomer;
use Illuminate\Http\Request;
use App\Models\Statistic;
use Carbon\Carbon;
use App\Models\Visitors;
use App\Models\icons;
use App\Models\Contact;
session_start();

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function($view) {

            //
            $post_footer = Post::where('cate_post_id',21)->get();


            //
            $contact_footer = Contact::where('info_id',5)->get();

            $icons = icons::where('category','icons')->orderby('id_icons','desc')->get();
            $icons_doitac = icons::where('category','doitac')->orderby('id_icons','desc')->get();

            $portorder = product::all()->count();
            $portt = Post::all()->count();
            $orderr = order::all()->count();
            $customerr = Customer::all()->count();
            $product_views = product::orderBy('product_views','desc')->take(20)->get(); //desc bài nào xem nhiều nhất sẽ lên trang đầu
            $post_views = post::orderBy('post_views','desc')->take(20)->get();// đưa số bài viết ra 20 bài để so sánh
            // Pass variables to the view
            $view->with(compact('portorder','portt','orderr','customerr','product_views','post_views','icons','icons_doitac','contact_footer','post_footer'));
        });
    }
}
