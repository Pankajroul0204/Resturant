<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageUpload;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TestimonialController extends Controller
{
    public function getCreateTestimonials(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'designation' => 'nullable|string|max:255',
                'image' => 'required|array',
                'image.*' => 'image|mimes:jpeg,png,jpg,svg,webp|max:2048',
                'message' => 'required|string',
                'stars' => 'nullable|string',
                'display' => 'boolean',
            ]);
            $testimonial = new Testimonial();
            $testimonial->name = $data['name'];
            $testimonial->designation = $data['designation'];
            $testimonial->message = $data['message'];
            // $testimonial->stars= $data['stars'];

            $path = ImageUpload::customSaveImage($request->file('image')[0], 'testimonials');
            $testimonial->image = $path;
            $testimonial->save();
            return redirect()->back()->with('success', 'Testimonial created successfully.');
        }
        return Inertia::render('Admin/Testimonial/Testimonial');
    }

    public function testimonial_list()
    {
        $testimonials = Testimonial::paginate(10);
        return Inertia::render('Admin/Testimonial/TestimonialList', ['data' => $testimonials]);
    }
    public function deleteTestimonial($id)
    {
        $data = Testimonial::find($id);
        ImageUpload::deleteImage(str_replace('storage/', '', $data->image), 'public');
        $data->delete();
        return response()->json(['status' => 1, 'msg' => 'Deleted Successfully.']);
    }
    public function edit(Request $request ,$id){
        if($request->isMethod('POST')){
             $data = $request->validate([
                'name' => 'required|string|max:255',
                'designation' => 'nullable|string|max:255',
                'image' => 'nullable|array',
                'image.*' => 'image|mimes:jpeg,png,jpg,svg,webp|max:2048',
                'message' => 'required|string',
                'stars' => 'nullable|string',
                'display' => 'boolean',
            ]);
            $testimonial=Testimonial::find($id);
            $testimonial->name = $data['name'];
            $testimonial->designation = $data['designation'];
            $testimonial->message = $data['message'];
            // $testimonial->stars= $data['stars'];
            if ($request->hasFile('image')) {
                ImageUpload::deleteImage(str_replace('storage/', '', $testimonial->image), 'public');
                $path = ImageUpload::customSaveImage($request->file('image')[0], 'testimonials');
                $testimonial->image = $path;
            }
            $testimonial->save();
            return redirect()->back()->with('success', 'Testimonial updated successfully.');
        }else{
            $data=Testimonial::find($id);
            return Inertia::render('Admin/Testimonial/Testimonial',['data'=>$data]);
        }
    }
}
