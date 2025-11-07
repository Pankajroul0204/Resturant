<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageUpload;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Chef;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChefController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Chef::orderBy('id', 'desc')->paginate(10);
        return Inertia::render('Admin/Chef/ChefList', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Chef/AddChef');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'image' => 'required|array',
            'image.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',

            'signature' => 'nullable|array',
            'signature.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',

            'chef_name'   => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'achivement'  => 'nullable|string|max:500',
            'description' => 'required|string|max:1000',
        ]);
        try {

            $chef = new Chef();
            $chef->name   = $validate['chef_name'];
            $chef->designation = $validate['designation'];
            $chef->description = $validate['description'] ?? null;
            if(isset($request->hasFile('signature')[0])){ 
                $signaturePath = ImageUpload::customSaveImage($request->file('signature')[0], 'chef_images');
                $chef->signature = $signaturePath;
            }
            $chef->achivements  = $validate['achivement'] ?? null;
            $path = ImageUpload::customSaveImage($request->file('image')[0], 'chef_images');
            $chef->image = $path;
            $chef->modified_by  = Auth::id();
            $chef->save();

            return redirect()->back()->with('success', 'Chef created successfully.');
        } catch (\Throwable $th) {
            Log::error('ERROR :: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while creating chef.');
        }
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
        dd($id);
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
        $data = Chef::find($id);
        try {
            ImageUpload::deleteImage(str_replace('storage/', '', $data->image), 'public');
            ImageUpload::deleteImage(str_replace('storage/', '', $data->signature), 'public');
            $data->delete();
            return response()->json(['status' => 1, 'msg' => 'Deleted Successfully.']);
        } catch (\Throwable $th) {
            Log::error('ERROR :: ' . $th->getMessage());
            return response()->json(['status' => 0, 'msg' => 'Something went wrong while deleting chef.']);
        }
    }
}
