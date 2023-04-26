<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

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
        Response::macro('successful', function (array $data=null,string $message='') {

            $response = [];

            if(null != $data){
                $response['data'] = $data;
            }
            if(null != $message){
                $response['message'] = $message;
            }
            return \response()->json($response,200,[],JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        });

        Response::macro('failed', function (int $status,string $message='') {
            return \response()->json([
                'message' => $message
            ],$status);
        });
    }
}
