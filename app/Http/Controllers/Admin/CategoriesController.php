<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use Inertia\Inertia;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('admin/CategoryAdmin', [
            'categories' => Category::orderBy('created_at', 'desc')->paginate(3)->through(fn($category) => [
                'id' => $category->id,
                'title' => $category->title,
                'slug' => $category->slug,
                'meta_info' => $category->meta_info,
                'urlphoto' => $category->urlphoto
            ])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {

        $category = new Category();
        $category->title = $request->title;
        $category->slug = Str::slug($request->title, '-');
        $category->meta_info = $request->meta_info;
        if ($request->hasFile('urlphoto')) {
            $image          = $request->file('urlphoto');
            $imageName      = $image->getClientOriginalName();
            $imageNewName   = explode('.', $imageName)[0];
            $fileExtention  = time() . '.' . $imageNewName . '.' . $image->getClientOriginalExtension();
            $location       = storage_path('app/public/images/category/' . $fileExtention);
            Image::make($image)->resize(1200, 630)->save($location);

            $category->urlphoto = $fileExtention;
        };
        $category->save();

        return redirect('/categories')->with('message', 'Category has been successfully created!.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->title = $request->title;
        $category->slug = Str::slug($request->title, '-');
        $category->meta_info = $request->meta_info;
        if ($request->hasFile('urlphoto')) {
            File::delete(storage_path('app/public/images/category/' . $category->urlphoto));
            $image          = $request->file('urlphoto');
            $imageName      = $image->getClientOriginalName();
            $imageNewName   = explode('.', $imageName)[0];
            $fileExtention  = time() . '.' . $imageNewName . '.' . $image->getClientOriginalExtension();
            $location       = storage_path('app/public/images/category/' . $fileExtention);
            Image::make($image)->resize(1200, 630)->save($location);

            $category->urlphoto = $fileExtention;
        };
        $category->update();

        return redirect('/categories')->with('message', 'Category has been successfully updated!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        File::delete(storage_path('app/public/images/category/' . $category->urlphoto));
        $category->delete();

        return redirect('/categories')->with('message', 'Category has been successfully deleted!.');
    }
}
