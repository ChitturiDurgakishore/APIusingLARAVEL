<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ApiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function Register(Request $req){
        $input=$req->all();
        $input['password']=bcrypt($input['password']);
        $user=ApiModel ::create($input);
        $token=$user->createToken('MyApp')->plainTextToken;
        return response()->json([
            'status' => 200,
            'message' => 'User registered successfully',
            'token' => $token
        ]);

    }

    public function Login(Request $req){
        $user=ApiModel::where('email',$req->email)->first();
        if(!$user){
            return "No User Found!";
        }
        else{
            if(Hash::check($req->password,$user->password)){
                $token=$user->createToken('MyApp')->plainTextToken;

                return ['username'=>$user->name,
            'email'=>$user->email,
            'token'=>$token ,
        'msg'=>"Login Success"];
            }else{
                return "Password Wrong";
            }
        }

    }


    function getapi(Request $req){
        // $student=ApiModel::where('email',$req->email)->first();
        $student=ApiModel::all();
        if($student){
            return $student;
        }else{
            return "Student not found";
        }
    }

      function deleteapi(Request $req){
        $student=ApiModel::where('email',$req->email)->where('name',$req->name)->first();
        if($student){
            $student->delete();
            return "Student deleted successfully";
        }else{
            return "Student not found";
        }
    }

    function putapi(Request $req){
        // return "Hello ";
        $student=ApiModel::where('email',$req->email)->first();
        // return $student;
            $student->name=$req->name;
            $student->email=$req->email;
            $student->password=$req->password;
            $student->phone=$req->phone;
        if( $student->save()){
            return $student;
        }else{
            return "Student not found";
        }
    }

    function postapi(Request $req){
        $students=ApiModel::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'password'=>$req->password,
            'phone'=>$req->phone,
        ],[

        ]);
        if($students){
            return $req->input() ;
        }else{
            return "Something went wrong";
        }
    }

    function API(){
       $students=ApiModel::all();
        return $students;
    }


}
