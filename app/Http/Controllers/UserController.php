<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller{
    function index (Request $request){
        if($request->isJson()){
            $users = User::all();
            return response()->json($users,200);    
        }
        return response()->json(['error'=>'Unauthorized'],401,[]);
    }

    function create (Request $request){
        
        if($request->isJson()){
            $data = $request->json()->all();
            $user = User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'api_token' => Str::random(60)
            ]);
            return response()->json($user,200);    
        }
        return response()->json(['error'=>'Unauthorized'],401,[]);
        
    }

    function getToken(Request $request){
        if($request->isJson()){
            try{
                $data = $request->json()->all();
                $user = User::where('username', $data['username'])->first();
                if($user && Hash::check($data['password'], $user->password)){
                    return response()->json($user, 200);
                }else{
                    response()->json(['error' => 'No content'], 406);
                }
            }catch (ModelNotFoundException $e){
                return response()->json(['error' => 'No content'], 406);
            }
        }
        return response()->json(['error'=>'Unauthorized'],401,[]);       
    }

}