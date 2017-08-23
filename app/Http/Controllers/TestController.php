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

      if($validator->fails())
      {
        return Response::json(['error' => 'Please fill out all fields.']);
      }

      $name = $request->input('name');
      $age = $request->input('age');
      $home = $request->input('home');

      $sentence = "Hi! My name is " . $name . " and I am " . $age . " years old. I live in " . $home . ".";

      return Response::json(['sentence' => $sentence]);

    }
}
