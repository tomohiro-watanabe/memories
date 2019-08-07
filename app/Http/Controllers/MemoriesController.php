<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        ]);

        $request->user()->memories()->create([
            'content' => $request->content,
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
