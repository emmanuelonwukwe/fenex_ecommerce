<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Returns named funtion view page 
     */
    public function adminCreateCategoryView(){
        return view("admin.create-category")->with("categories", $this->index());
    }

    /**
     * Returns named funtion view page 
     */
    public function adminViewCategoriesView(){
        return view("admin.view-categories")->with("categories", $this->index());
    }

    /**
     * Returns named funtion helps to create and update category creation request
     */
    public function adminCreateCategory(Request $request){

        //flash so old() can work on the blade tmp
        //$request->flashOnly('name');
        $request->flash();

        //check if the admin wants to update the category
        if ($request->update_id != null) {

            $request->validate([
                "id" => 'numeric'
            ]);

            $category = Category::find($request->update_id);

            //check if the category does not exist
            if (empty($category)) {
                return back()->withErrors(['The Category you want to update does not exist']);
            }

            if ($this->update($request, $category)) {
                return back()->with('success', 'Category updated successfully');
            }

            return back()->withErrors(['Category not updated try again']);
        }
        
        //check if the category already exists
        $categoryExists = Category::where('name', $request->name)->first();

        if ($categoryExists) {
            //can not create category
            return back()->withErrors(['Can not create same category name again. Try changing the name to another thing']);
        }

        $request->validate([
            "name" => 'string|max:100'
        ]);

        $newCategory = Category::create([
            'name' => $request->name
        ]);

        return back()->with('success', 'Category Created successfully');
    }

    /**
     * Display a listing of the Categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::all()->sortByDesc('id');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $updated = $category->update([
            'name' => $request->name
        ]);

        return $updated ? true : false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $category = Category::find($request->category_id);
        
        $category->delete();

        return back()->with("success", "Category ". $category->name. ' deleted successfully');
    }
}
