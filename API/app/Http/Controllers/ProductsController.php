<?php

namespace App\Http\Controllers;
use App\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class ProductsController extends Controller
{
   public function add(Request $request){
   		$product = new products();
   		$product->name     = $request->input('name');
   		$product->price    = $request->input('price');
   		$product->size     = $request->input('size');
   		$product->category = $request->input('category');
   		if($product->save()){
			return response()->json([
    		'error'  => false,
    		'code'   => 200,
    		'message'=> 'Product added successfully!',
    	  ]);
		}else{
			return response()->json([
    		'error'  => true,
    		'code'   => 400,
    		'message'=> 'Bad Request'
    	  ]);
		}
   }

   public function Update(Request $request){
   		
   		$product = [
	   		'name'     => $request->input('name'),
	   		'price'    => $request->input('price'),
	   		'size'     => $request->input('size'),
	   		'category' => $request->input('category')
   		];

   		$result = DB::table('products')
      			  ->where('id', $request->input('id'))
                  ->update($product);
   		
   		if($result){
			return response()->json([
    		'error'  => false,
    		'code'   => 200,
    		'message'=> 'Product updated successfully!',
    	  ]);
		}else{
			return response()->json([
    		'error'  => true,
    		'code'   => 400,
    		'message'=> 'Bad Request'
    	  ]);
		}
   }

   public function Delete(Request $request){

   		$result = DB::table('products')
      			  ->where('id', $request->input('id'))
                  ->delete();
   		
   		if($result){
			return response()->json([
    		'error'  => false,
    		'code'   => 200,
    		'message'=> 'Product deleted successfully!',
    	  ]);
		}else{
			return response()->json([
    		'error'  => true,
    		'code'   => 400,
    		'message'=> 'Bad Request'
    	  ]);
		}
   }

   public function List(Request $request){
   	$offset = $request->input('offset');
    $limit  = $request->input('limit');
    $order  = $request->input('order');
   	$query = DB::table('products');
    if(!empty($order)){
    	$query = $query->orderBy($order['by'], $order['order']);
    }else{
    	$query = $query->orderBy('created_at', 'desc');
    }
    $products = $query->offset($offset)
             ->limit($limit)
             ->get();
	$count  = \DB::table('products')->count();
   	if($products){
			return response()->json([
    		'error'  => false,
    		'code'   => 200,
    		'message'=> 'Products got successfully!',
    		'data'   => $products,
    		'total'  => $count
    	  ]);
		}else{
			return response()->json([
    		'error'  => true,
    		'code'   => 400,
    		'message'=> 'Bad Request',
    		'data'   => $products
    	  ]);
		}
   }
}
