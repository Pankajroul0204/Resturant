<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageUpload;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::all();
        return Inertia::render('Admin/Menu/MenuList', [
            'data' => $menus
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Menu/CreateMenu');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'category' => 'required|string|max:255',
            'is_available' => 'nullable|boolean',
        ]);
         $menu = new Menu();
            $menu->name = $data['name'];
            $menu->description = $data['description'];
            $menu->price = $data['price'];
            $menu->category = $data['category'];
            $menu->is_available = $data['is_available']??1;

            $path = ImageUpload::customSaveImage($request->file('image')[0], 'menu');
            $menu->image = $path;
            $menu ->save();
            return redirect()->back()->with('success', 'Menu created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function menulist(){
        $menus = Menu::paginate(10);
        return Inertia::render('Admin/Menu/MenuList', [
            'data' => $menus
        ]);
    }
}
