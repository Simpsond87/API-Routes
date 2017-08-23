<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Purifier;

class TestController extends Controller
{
    public function index()
    {
      $data = "Here is my data.";

      return Response::json(['data' => $data]);
    }

    public function store(Request $request)
    {
      $rules = [
        'name' => 'required',
        'age' => 'required'
      ];

      $validator = Validator::make(Purifier::clean($request->all()), $rules);

      $name = $request->input('name');
      $age = $request->input('age');
      $home = $request->input('home');

      if($validator->fails())
      {
        if($name == NULL)
        {
          return Response::json(['error' => 'Please enter your name.']);
        }
        elseif($age == NULL)
        {
          return Response::json(['error' => 'Please enter your age.']);
        }
      }



      $sentence = "Hi! My name is " . $name . " and I am " . $age . " years old. I live in " . $home . ".";

      return Response::json(['sentence' => $sentence]);

    }
}
