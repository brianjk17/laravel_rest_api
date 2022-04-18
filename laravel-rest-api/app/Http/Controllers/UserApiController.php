<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserApiController extends Controller
{
    //READ (GET all users)
    public function AllUser(){
        return UserResource::collection(User::all());
    }

    //READ (GET a users)
    public function GetUser(User $id){
        $user = User::query()->find($id);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User does not exist']);
        }
    
        return response()->json(['success' => true, 'user' => new UserResource($user)]);
    }

    //CREATE (create the user)
    public function create(){
        request()->validate([
            'name'=>'required|min:3|max:255',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8|max:255',
        ]);
    
        return User::create([
            'name'=>request('name'),
            'email'=>request('email'),
            'password'=>request('password'),
        ]);
    }

    //UPDATE (updates existing users)
    public function update(User $id){
        request()->validate([
            'name'=>'required|min:3|max:255',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8|max:255',
        ]);
    
        $success = $id->update([
            'name'=>request('name'),
            'email'=>request('email'),
            'password'=>request('password'),
        ]);
    
        return[
            'success' =>$success,
        ];//if successful returns TRUE, else FALSE
    }

    //DELETE (delete a user)
    public function delete(User $id){
        $success = $id->delete();
        return[
            'success' =>$success,
        ];
    }
}
