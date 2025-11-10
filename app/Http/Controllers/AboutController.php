<?php

namespace App\Http\Controllers;

use App\Helpers\ImageUpload;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // if(About::count() >= 1){
        //     return redirect()->route('admin.dashboard')->with('error', 'Only one About entry is allowed.');
        // }
        if(About::count() == 1){
            $about = About::first();
            return redirect()->route('admin.about.edit', $about->id);
        }
        return Inertia::render('Admin/About/AddAbout');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'year_of_establishment' => 'required|integer|min:1900|max:' . date('Y'),
            'cook_quotes' => 'required|string|max:500',
            'image1' => 'required|array',
            'image1.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'image2' => 'required|array',
            'image2.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ],[
            'image1.required' => 'The first image is required.',
            'image2.required' => 'The second image is required.',
        ]);
        try {
            // dd($request->image1[0]);
            // dd($request->hasFile('image1'));
            $about = new About();
            $about->heading = $validated['heading'];
            $about->description = $validated['description'];
            $about->year_of_establishment = $validated['year_of_establishment'];
            $about->cook_quotes = $validated['cook_quotes'];
            if ($request->hasFile('image1')) {
                $image1Path = ImageUpload::customSaveImage($request->file('image1')[0], 'about_images');
                $about->image1 = $image1Path;
            }
            if ($request->hasFile('image2')) {
                $image2Path = ImageUpload::customSaveImage($request->file('image2')[0], 'about_images');
                $about->image2 = $image2Path;
            }
            $about->chef_id = 2; // Set a default chef_id or modify as needed
            $about->save();
            return redirect()->route('admin.about.edit', $about->id)
                ->with('success', 'About information saved successfully.');
        } catch (\Throwable $th) {
            Log::error('ERROR :: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while saving About information.');
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
        $about = About::with('chef')->findOrFail($id)->toArray();
        return Inertia::render('Admin/About/AddAbout', [
            'data' => $about
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'year_of_establishment' => 'required|integer|min:1900|max:' . date('Y'),
            'cook_quotes' => 'required|string|max:500',
            'image1' => 'nullable|array',
            'image1.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'image2' => 'nullable|array',
            'image2.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        try {
            $about =  About::find($id);
            $about->heading = $validate['heading'];
            $about->description = $validate['description'];
            $about->year_of_establishment = $validate['year_of_establishment'];
            $about->cook_quotes = $validate['cook_quotes'];
            if ($request->hasFile('image1')) {
                $image1Path = ImageUpload::customSaveImage($request->file('image1')[0], 'about_images');
                $about->image1 = $image1Path;
            }
            if ($request->hasFile('image2')) {
                $image2Path = ImageUpload::customSaveImage($request->file('image2')[0], 'about_images');
                $about->image2 = $image2Path;
            }
            $about->save();
            return redirect()->back()->with('success','Updated Successfully');
        } catch (\Throwable $th) {
           Log::error("ERRORR :: ".$th->getMessage());
           return redirect()->back()->with('error','Something Went Wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
