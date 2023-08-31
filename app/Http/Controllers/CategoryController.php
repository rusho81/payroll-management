<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\LeaveCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function CategoryPage() {
        return view('pages.dashboard.category-page');
    }

    function CategoryList(Request $request){
        return LeaveCategory::get();
    }

    function CategoryCreate(Request $request) {

        return LeaveCategory::create([
            'category_name' =>$request->input('catName'),
        ]);
    }
    function CategoryDelete(Request $request) {
        $category_id = $request->input('id');
        return LeaveCategory::where('id', $category_id)
        ->delete();
    }

    function CategoryUpdate(Request $request) {
        $category_id = $request->input('id');
        return LeaveCategory::where('id', $category_id)
        ->update([
            'category_name' => $request->input('catName')
        ]);
    }

    function CategoryById(Request $request) {
        $cat_id = $request->input('id');
        return LeaveCategory::where('id', $cat_id)
        ->first();
    }
}
