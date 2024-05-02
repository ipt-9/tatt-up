<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function imageUpload(Request $req) {

        $postObj = new Post;

        if($req->hasFile('image')) {
            $imageData = file_get_contents($req->file('image')); // Read image data
            $postObj->image_data = base64_encode($imageData); // Encode image data as base64 and save it
        }

        if($postObj->save()) { // save file in database
            return response()->json(['status' => true, 'message' => "Image uploaded successfully"]);
        } else {
            return response()->json(['status' => false, 'message' => "Error : Image not uploaded successfully"]);
        }
    

    }
}
