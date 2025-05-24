<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;

use App\Models\SiteSetting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //////////////////////////////////////////////////////////////////////////////////////////////

        Schema::defaultStringLength(191);

        //////////////////////////////////////////////////////////////////////////////////////////////

        if(! $this->app->runningInConsole()) {
            

            $siteSettings = SiteSetting::first();

            $categories  = Category::where('is_active', 1)->orderBy('name', 'ASC')->take(5)->get();
            $tags        = Tag::where('is_active', 1)->orderBy('name', 'ASC')->take(5)->get();
            $recentPosts = Post::where('is_published', 1)->orderBy('created_at', 'DESC')->take(5)->get();

            view()->share(compact('categories','tags','recentPosts','siteSettings'));

        }

        //////////////////////////////////////////////////////////////////////////////////////////////
    }

}