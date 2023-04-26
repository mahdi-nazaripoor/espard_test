<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\MessageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\v1\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->successful([
            'products' => ProductResource::collection(Product::get())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        //ToDo: add uploaded image security checker then add main_pic input file
        if(Product::create([
            'title' => htmlspecialchars(htmlentities($request->input('title'))),
            'price' => $request->input('price'),
            'description' => htmlspecialchars(htmlentities(nl2br($request->input('title'))))
        ])){
            return response()->successful();
        }else{
            return response()->failed(500,MessageHelper::Translate('unable_to_save_data'));
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->successful([
            'product' => new ProductResource($product)
        ]);
    }

    public function update(ProductRequest $request, string $id)
    {
        //ToDo: add uploaded image security checker then add main_pic input file
        if(Product::update([
            'title' => htmlspecialchars(htmlentities($request->input('title'))),
            'price' => $request->input('price'),
            'description' => htmlspecialchars(htmlentities(nl2br($request->input('title'))))
        ])){
            return response()->successful();
        }else{
            return response()->failed(500,MessageHelper::Translate('unable_to_update_data'));
        }
    }


    public function destroy(Product $product)
    {
        DB::beginTransaction();

        //First of all we'll remove all product bookmarked records
        if(DB::table('user_bookmarked_product')->where('product_id',$product->uid)->delete()){

            //Then remove the product
            if($product->delete()){
                //Commit changes to DB
                DB::commit();
                return response()->successful();
            }

        }

        //Rollback all DB changes
        DB::rollBack();
        return response()->failed(500,MessageHelper::Translate('unable_to_remove_data'));
    }
}
