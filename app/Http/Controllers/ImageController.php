<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $image->storeAs('public/images', $imageName);

            $imagePath = '/api/images/'.$imageName;

            // Return a response with the image URL
            return response()->json(['message' => 'Image uploaded successfully', 'image_url' => asset($imagePath)], 200);
        }

        return response()->json(['message' => 'No image to upload'], 400);
    }
    public function getImage($filename)
    {
        $imagePath = 'public/images/'.$filename;

        if (Storage::exists($imagePath)) {
            return response()->file(storage_path('app/'.$imagePath));
        }

        return response()->json(['message' => 'Image not found image'], 404);
    }

    public function uploads(Request $request)
{
    $request->validate([
        'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation rules
    ]);

    $uploadedImages = [];

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $image->storeAs('public/images', $imageName);

            $imagePath = '/api/images/'.$imageName;

            $uploadedImages[] = asset($imagePath);
        }
        
        return response()->json(['message' => 'Images uploaded successfully', 'image_urls' => $uploadedImages], 200);
    }

    return response()->json(['message' => 'No images to upload'], 400);
}
}
