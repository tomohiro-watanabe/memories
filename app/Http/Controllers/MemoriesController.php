<?php

namespace App\Http\Controllers;

use Illuminate\Http\File;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManagerStatic as Image;

class MemoriesController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $memories = $user->feed_memories()->orderBy('created_at', 'desc')->paginate(10);
            
            $data = [
                'user' => $user,
                'memories' => $memories,
            ];
        }
        
        return view('welcome', $data);
    }
    
    public function store(Request $request)
    {   
        
        $this->validate($request, [
            'content' => 'required|max:191',
            'image' => 'required|max:10240'
        ]);
        
        $file = $request->file('image');
        $img = Image::make($file);
        $width = 400;
        $img->resize($width, null, function($constraint){
        $constraint->aspectRatio();
});
        $extension = $request->file('image')->getClientOriginalExtension(); 
        $filename = $request->file('image')->getClientOriginalName(); 
        $resize_img = $img->encode($extension);
        $path = Storage::disk('s3')->put('images'.$filename,(string)$resize_img, 'public');
        $url = Storage::disk('s3')->url('images'.$filename);
        
        $request->user()->memories()->create([
            'content' => $request->content,
            'image' => $url,
            ]);
            
            return back();
        
    }
    
    public function destroy($id)
    {
        $memory = \App\Memory::find($id);

        if (\Auth::id() === $memory->user_id) {
            $memory->delete();
        }

        return back();
    }
}
