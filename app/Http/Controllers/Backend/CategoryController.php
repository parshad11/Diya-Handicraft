<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;

use App\Models\Category;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends BackendController
{
    public function index()
    {
        $categories = $this->getFullListFromDB();
           return view($this->_pages . 'categories.index', compact('categories'));
    }


    public function create()
    {
        return view($this->_pages . 'categories.create');
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        // dd($request);

        $validatedData = $request->validate([
            'title' => 'required|max:255',
        ]);

        $max_order = DB::table('categories')->max('order_no');
        $slug = $this->createSlug($request->title, 0);

        $categories = new Category();
        $categories->title = $request->title;
        $categories->order_no = $max_order + 1;
        $categories->slug = $slug;
        if ($request->status) {
            $categories->status = 1;
        }
        if ($request->feature) {
            $categories->feature = 1;
        }
        /*        $categories->description = $request->description;

                if ($request->hasFile('image')) {
                    $validatedData = $request->validate([
                        'image' => 'image|mimes:jpeg,png,jpg',
                    ]);
                    //Add the new photo
                    $image = $request->file('image');
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $folderPath = "public/categories/" . $slug;
                    $thumbPath = "public/categories/" . $slug . "/thumbs";

                    if (!file_exists($thumbPath)) {
                        Storage::makeDirectory($thumbPath, 0777, true, true);
                    }

                    Storage::putFileAs($folderPath, new File($image), $filename);

                    Category::resize_crop_images(350, 350, $image, $folderPath . "/thumbs/thumb_" . $filename);
                    Category::resize_crop_images(200, 200, $image, $folderPath . "/thumbs/small_" . $filename);

                    //Update the database
                    $categories->image = $filename;
                }*/
        $categories->save();
        return redirect()->route('categories.list')->with('status', "Category Created Successfully");

    }

    public function show($id)
    {

        $categories = Category::findOrFail(base64_decode($id));
        return view($this->_pages . 'categories.view', compact('categories'));
    }

    public function edit($id)
    {
        $categories = Category::findOrFail(base64_decode($id));

        return view($this->_pages . 'categories.edit', compact('categories'));
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'title' => 'required|max:255',
        ]);

        $categories = Category::findOrFail(base64_decode($id));

        $slug = $this->createSlug($request->title, $categories->id);
        $path = public_path() . '/storage/pages/' . $categories->slug;
        if ($categories->slug != $slug) {
            $oldslug = $categories->slug;
            $categories->slug = $slug;
            if (file_exists($path)) {
                Storage::move('public/categories/' . $oldslug, 'public/categories/' . $slug);
            }
        }
        /*$folderPath = 'public/categories/' . $slug;
        if (!file_exists($path)) {

            Storage::makeDirectory($folderPath, 0777, true, true);

            if (!is_dir($path . "/thumbs")) {
                Storage::makeDirectory($folderPath . '/thumbs', 0777, true, true);
            }
        }*/

        $categories->title = $request->title;
        if ($request->status) {
            $categories->status = 1;
        } else {
            $categories->status = 0;
        }
        if ($request->feature) {
            $categories->feature = 1;
        } else {
            $categories->feature = 0;
        }
        /*        $categories->description = $request->description;

                if ($request->hasFile('image')) {
                    $oldimg = $categories->image;
                    $validatedData = $request->validate([
                        'image' => 'image|mimes:jpeg,png,jpg',
                    ]);
                    //Add the new photo
                    $image = $request->file('image');
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $folderPath = "public/categories/" . $slug;
                    $thumbPath = "public/categories/" . $slug . "/thumbs";

                    if (!file_exists($thumbPath)) {
                        Storage::makeDirectory($thumbPath, 0777, true, true);
                    }

                    Storage::putFileAs($folderPath, new File($image), $filename);

                    Category::resize_crop_images(350, 350, $image, $folderPath . "/thumbs/thumb_" . $filename);
                    Category::resize_crop_images(200, 200, $image, $folderPath . "/thumbs/small_" . $filename);

                    //Update the database
                    $categories->image = $filename;
                    Storage::delete('public/categories/' . $slug . '/' . $oldimg);
                }*/
        $categories->save();
        return redirect()->route('categories.list')->with('status', "Category Updated Successfully");

    }


    public function destroy($id)
    {

        $categories = Category::findOrFail($id);
        dd($categories);
        $categories->delete();
        $folderPath = 'public/categories/' . $categories->slug;
        Storage::deleteDirectory($folderPath);
        return redirect()->route('categories.list')->with('status', "Category Deleted Successfully");
    }

    public function createSlug($title, $id = 0)
    {
        // Normalize the title
        $slug = Str::slug($title);

        $allSlugs = $this->getRelatedSlugs($slug, $id);

        // If we haven't used it before then we are all good .
        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }


        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('Can not create a unique slug');
    }


    protected function getRelatedSlugs($slug, $id = 0)
    {
        return \App\Models\Category::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }


    public function setOrder(Request $request)
    {

        $list_order = $request['list_order'];
        $this->saveList($list_order, $request->parentid);
        $data = array('status' => 'success');
        echo json_encode($data);
        exit;
    }

    /**
     * @param $list
     * @param int $parent_id
     * @param int $child
     * @param int $m_order
     */
    function saveList($list, $parent_id = 0, $child = 0, &$m_order = 0)
    {
        foreach ($list as $item) {
            $m_order++;
            $updateData = array("parent_id" => $parent_id, "child" => $child, "order_no" => $m_order);

           Category::where('id', $item['id'])->update($updateData);

            if (array_key_exists("children", $item)) {
                $updateData = array("child" => 1);
                $updateData = array("child" => 1);
                Category::where('id', $item['id'])->update($updateData);
                $this->saveList($item["children"], $item['id'], 0, $m_order);
            }
        }
    }

    public function getFullListFromDB($parent_id = 0)
    {
        $categories = DB::table('categories')->where('parent_id', $parent_id)->orderBy('order_no')->get();

        foreach ($categories as &$value) {
       $subresult = $this->getFullListFromDB($value->id);

            if (count($subresult) > 0) {
                $value->children = $subresult;
            }


        }

        unset($value);

        return $categories;
    }


}
