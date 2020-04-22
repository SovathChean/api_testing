<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Product;
use App\Http\Resources\ProductResource as ProductResource;
use Illuminate\Support\Facades\Auth;
use Validator;



class ProductController extends BaseController
{
     public function __construct()
      {

        $this->middleware('auth:api')->except(['index', 'show']);

      }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return $this->sendResponse(ProductResource::Collection(product::paginate(10)), "Product retreive successfully");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->all();

        $validate = Validator::make($input, [
          'name' => 'required',
          'detail' => 'required',
        ]);

        if($validate->fails())
        {
          return $this->sendError('Validation is error', $validate->errors());
        }


        $product = Product::create($input);

        return $this->sendResponse(new ProductResource($product), 'Your are adding successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $input = $request->all();

        $validate = Validator::make($input, [
          'name' => 'required',
          'detail' => 'required',
        ]);

        if($validate->fails())
        {
          return $this->sendError('Validation is error', $validate->errors());
        }

        $product = Product::findOrFail($id);

        $product->update($input);

        return $this->sendResponse(new ProductResource($product), 'Product successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product =Product::findOrFail($id);

        $product->delete();

        return $this->sendResponse([], 'Product deleted successfully.');
    }
}
