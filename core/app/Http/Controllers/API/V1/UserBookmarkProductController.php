<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\MessageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserBookmarkProductRequest;
use App\Http\Resources\v1\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserBookmarkProductController extends Controller
{

    public function index()
    {
        $bookmarked_products = DB::table('user_bookmarked_product')
            ->where('user_id',auth()->id())
            ->join('products', 'user_bookmarked_product.product_id', '=', 'products.uid')
            ->select('user_bookmarked_product.product_id', 'products.*')
            ->get();

        return response()->successful([
            'products' => ProductResource::collection($bookmarked_products)
        ]);
    }


    public function create(UserBookmarkProductRequest $request)
    {

    }


    public function store(Request $request)
    {
        if(!(DB::table('user_bookmarked_product')->where(['user_id' => auth()->id(),'product_id' => $request->product])->count())){

            if(DB::table('user_bookmarked_product')->insert([
                'product_id' => $request->product,
                'user_id' => auth()->id()
            ])){
                return response()->successful();
            }
            else{
                return response()->failed(500,MessageHelper::Translate('unable_to_save_data'));
            }
        }else{
            return response()->successful(null,'این محصول قبلا بوکمارک شده است');
        }
    }

    public function destroy(UserBookmarkProductRequest $request)
    {
        if(DB::table('user_bookmarked_product')->where(['user_id' => auth()->id(),'product_id' => $request->product])->count()){

            if(DB::table('user_bookmarked_product')->where([
                'product_id' => $request->product,
                'user_id' => auth()->id()
            ])->delete()){
                return response()->successful();
            }
            else{
                return response()->failed(500,MessageHelper::Translate('unable_to_remove_data'));
            }
        }else{
            return response()->successful(null,'شما قبلا این محصول را بوکمارک نکرده اید');
        }
    }
}
