<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //

    private $model;

  public function __construct() {

    $this->model = new User();
    
  }



  public function searchTiket(){



  }
  public function createUser(Request $req){
    $validator = Validator::make($req->all(), [
        'name' => 'required|min:2|max:12|regex:/^[\pL\s]+$/u|min:3|',
        'photo' => 'image | required | mimes:png,jpg|max:2048',
        'email' => 'required|email|unique:users',
        'occupation_area' => 'required|String',
    ],[
        'description.required' => 'required',
        'title.required' => 'required',
    ]);
    if ($validator->fails()) {
        return response()->json($validator->errors(),400);
    }
    $image = $req->photo->hashName();
    $user = New User();
    $path = $req->file('photo')->store('photo');    
    $user->name = $req->name;
    $user->photo = $image;    
    $user->email = $req->email;
    $user->occupation_area = $req->occupation_area;
    //verify if random number exists
    $users = [];
    $resultado = [];
    $pin = 0;
    $count_users = User::count();
    for ($i=0; $i <$count_users ; $i++) { 
      $users[$i] = User::find($i);
    } 
    for ($i=0; $i <$count_users ; $i++) { 
      $pin = str::random(10);
      if ($pin != $users[$i]->tiket_id) {
       continue;
      }
      if ($pin != $users[$i]->tiket_id) {
        break ;
      }
      if ($pin != $users[$i]->tiket_id) {
        $pin = str::random(10);
       }
    } 
    $user->tiket_id = $pin;
    $user->link = env('APP_URL')."tickets/na-placa-do-dev/$pin";
    $result = $this->model->save();
    if (User::find($this->model->id)) {
       return response()->json( [ 
        "error" =>false,
        "message"=>$this->model,
       ],201
       );
    }
    return response()->json( [ 
        "error" =>true,
        "message"=>"There was an error saving, try again",
        
    ],
    200
    );
  }

    
}
