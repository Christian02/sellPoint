<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,User::$create_validation_rules);
        $data = $request->only('name','email','password');
        $data['password'] = bcrypt($data['password']);
        // getting all of the post data
        $file = array('image' => Input::file('image'));
        // setting up rules
        $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
             // send back to the page with the input data and errors
             return Redirect::to('createUser')->withInput()->withErrors($validator);
        }
        else {
        // checking file is valid.
        if (Input::file('image')->isValid()) {
            $destinationPath = 'uploads'; // upload path
            //$extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
            //$fileName = rand(11111,99999).'.'.$extension; // renameing image
            $nameOfFile =$file['image']->getClientOriginalName();
            $email= $data['email'];
            $fileName=$email.''.$nameOfFile;
            Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
            // sending back with message
            $data['path_image_profile']=$fileName;
            $user = User::create($data);
            if($user)
            {
                \Auth::login($user);
                return redirect()->route('home');
            }else
            {
                return back()->withInput();
            }
              //return Redirect::to('login');
        }
        else{
                // sending back with error message.
                return Redirect::to('createUser');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /*
    public function home()
    {

        return view('users.home'); 
    }
    */
}
