<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=User::get();
   
        return response()->json(['user'=>$user], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
      return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string',
            'profile_image' => 'mimes:jpg,bmp,png',
            'age' => 'integer',
        ]);
     $data=$request->all();
    
    unset( $data['profile_image'] );
     if ($request->hasFile('profile_image')) {
        $imageName = time() . '.' . $request->profile_image->extension();
        $request->profile_image->move('assets/', $imageName);
        $data['profile_image'] = $imageName;
    }

     User::create($data);
     return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
   $user=User::whereId($id)->first();
   
   return response()->json(['user'=>$user], 200);

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
}
