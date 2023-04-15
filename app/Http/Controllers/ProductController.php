<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Returns named funtion view page 
     */
    public function adminCreateProductView(){
        return view("admin.create-product")->with('products', self::index())
                ->with('categories', (new CategoryController)->index());
    }

    /**
     * Returns named funtion view page 
     */
    public function adminViewProductsView(){
        return view("admin.view-products")->with('products', self::index());
    }

      /**
     * Returns named funtion helps to create and update Product creation request
     */
    public function adminCreateProduct(Request $request){

        //flash so old() can work on the blade tmp
        //$request->flashOnly('name');
        //$request->flash();
        //form must have enctype="multipart/form-data" for upload to work

        //check if the admin wants to update the Product
        if ($request->update_id != null) {

            $request->validate([
                "name" => 'required|string|max:100',
                "price" => "numeric",
                "category_id" => "numeric"
            ]);

            //check if the request wants to change the image to validate the file type
            if (!empty($request->image)) {
                $request->validate([
                    "image" => "file|mimes:jpg,jpeg,png,bmp,jfif|max:25000000",
                ]);

                //get the image name on server
                $productImageBasenameOnServer = Product::find($request->update_id)->image;
                if ($productImageBasenameOnServer !== null) {

                    if (file_exists(public_path('storage/').$productImageBasenameOnServer)) {
                        //try unlinking the old file from the server
                        if (!unlink(public_path('storage/').$productImageBasenameOnServer)) {
                            return back()->withErrors(['Unable to remove the old product image from server']);
                        }
                    }
                    

                    //format the file name to be uploaded
                    $fileName = auth()->user()->id . "---". time(). '.' .$request->image->extension();

                    if (!$this->moveUpload($request, "image", $fileName)) {
                        return back()->withErrors(['Unable to upload Image to server']);
                    }

                } else {
                    $fileName = null;
                }

                 
            } else {
                $fileName = null;
            }


            $product = Product::find($request->update_id);

            //check if the Product does not exist
            if (empty($product)) {
                return back()->withErrors(['The Product you want to update does not exist']);
            }

            if ($this->update($request, $product, $fileName)) {
                return back()->with('success', 'Product updated successfully');
            }

            return back()->withErrors(['Product not updated try again']);
        }
        
        //check if the Product already exists
        $productExists = Product::where('name', $request->name)->first();

        if ($productExists) {
            //can not create Product
            return back()->withErrors(['Can not create same Product name again. Try changing the name to another thing']);
        }

        //validate the new create  product request
        $request->validate([
            "name" => 'required|string|max:100',
            "price" => "numeric",
            "image" => "file|mimes:jpg,jpeg,png,bmp,jfif|max:25000000",
            "category_id" => "numeric"
        ]);

        if (empty($request->image)) {
            return back()->withErrors(['You must choose the product image before creating the new product']);
        }

        //format the file name to be uploaded
        $fileName = auth()->user()->id . "---". time() . '.' .$request->image->extension();

        if (!$this->moveUpload($request, "image", $fileName)) {
            return back()->withErrors(['Unable to upload Image to server']);
        }
        
        $newProduct = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $fileName,
            'category_id' => $request->category_id,
        ]);

        return back()->with('success', 'New Product Created successfully'); 
    }

    /**
     * THis function helps to move the image to the server
     * @param string $fileName - The (formated) name of the file to be uploaded
     * @param string $fileInputFieldName - The name of the request form file input name attribute
     */
    private function moveUpload(Request $request,string $fileInputFieldName, string $fileName) {
        return $request->$fileInputFieldName->move(public_path('storage'), $fileName) ? true : false;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index()
    {
       return Product::all()->sortByDesc('id');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product,string $fileName = null)
    {
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,    
        ];

        if ($fileName !== null) {
            $data["image"] = $fileName;
        }

        $updated = $product->update($data);

        return $updated ? true : false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Product::find($request->product_id);
        
        //unlink the image from server
        $productImageBasenameOnServer = $product->image;
        if (file_exists(public_path('storage/').$productImageBasenameOnServer)) {
            unlink(public_path('storage/').$productImageBasenameOnServer);
        }

        $product->delete();

        return back()->with("success", "Product ". $product->name. ' deleted successfully');
    }
}
