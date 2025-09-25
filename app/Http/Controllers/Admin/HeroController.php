<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Resturant;
use Illuminate\Support\Facades\Log;
use App\Helpers\ImageUpload;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class HeroController extends Controller
{
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'password' => 'required|string|max:50'
            ]);
            // Resturant::create($validate);
            // return redirect()->back()->with('success', 'Resturant created successfully!');
        } else {
            return Inertia::render('Admin/Create');
        }
    }
    public function hero(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $validate = $request->validate([
                'resturant_name' => 'required|string|max:255',
                'heading' => 'required|string|max:255',
                'description' => 'required|string|max:500',
                'open_interval' => 'required|string|max:255',
                'open_time_duration_from' => 'required|string|max:255',
                'open_time_duration_to' => 'required|string|max:255',
                'booking_status' => 'required|string|max:255',
                'image' => 'required|array',
                'image.*' => 'image|mimes:jpeg,png,jpg,svg,webp|max:2048',
                'fb' => 'required|url|max:255',
                'insta' => 'required|url|max:255',
                'x' => 'required|url|max:255',
                'you_tube' => 'required|url|max:255'
            ], [
                'x.required' => 'Twitter account link is required',
                'insta.required' => 'Instagram account link is required',
                'you_tube.required' => 'You Tube link is required',
            ]);
            try {
                $resturant = new Resturant();
                $resturant->resturant_name = $validate['resturant_name'];
                $resturant->heading = $validate['heading'];
                $resturant->description = $validate['description'];
                $resturant->open_interval = $validate['open_interval'];
                $resturant->open_time_duration_from = $validate['open_time_duration_from'];
                $resturant->open_time_duration_to = $validate['open_time_duration_to'];
                $resturant->booking_status = $validate['booking_status'];
                $resturant->fb = $validate['fb'];
                $resturant->insta = $validate['insta'];
                $resturant->x = $validate['x'];
                $resturant->you_tube = $validate['you_tube'];
                $resturant->created_by = Auth::user()->id;
                $resturant->save();

                if ($request->hasFile('image')) {
                    foreach ($request->file('image') as $image) {
                        $path = ImageUpload::customSaveImage($image, 'hero_banner_images');
                        $images[] = $path;
                        Image::create(['resturant_id' => $resturant->resturant_id, 'related_to' => 'hero_banner', 'image_path' => $path]);
                    }
                }
                return redirect()->back()->with('success', 'Hero section created successfully.');
            } catch (\Throwable $th) {
                Log::debug('ERROR :: ' . $th->getMessage());
                return redirect()->back()->with('error', 'Something went wrong.');
            }
        } else {
            if ($id == null) {
                return Inertia::render('Admin/Hero/Hero');
            } else {
                // dd($id)
                $data = Resturant::where('resturant_id', $id)->first();
                return Inertia::render('Admin/Hero/Hero', ['data' => $data]);
            }
        }
    }

    public function deleteHero($id)
    {
        $resturant = Resturant::where('resturant_id', $id);
        if ($resturant) {
            $resturant->delete();
            return response()->json(['msg' => 'Hero deleted successfully', 'status' => 1], 200);
        } else {
            return response()->json(['msg' => 'Something went wrong', 'status' => 0], 200);
        }
    }
    public function heroList(Request $request)
    {
        $data = Resturant::with('user')->orderBy('created_at', 'desc')->paginate();
        return Inertia::render('Admin/Hero/HeroList', ['data' => $data]);
    }
}
