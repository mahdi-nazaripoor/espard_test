<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //If user has been authenticated and is an Admin
        if(auth()->user()){
            if(auth()->user()->is_admin){
                return parent::toArray($request);
            }
        }

        $response = [
            'uid' => $this->uid,
            'title' => $this->title,
            'price' => $this->price,
            'main_pic' => url('assets/uploads/img/products/' . $this->uid . '/' . $this->main_pic)
        ];

        if(auth()->user() && $request->routeIs('products.show')){
            $response = array_merge($response,[
                'description' => $this->description,
                'bookmarked' => (DB::table('user_bookmarked_product')->where(['user_id' => auth()->id(),'product_id' => $this->uid])->count())
            ]);
        }
        return $response;

    }
}
