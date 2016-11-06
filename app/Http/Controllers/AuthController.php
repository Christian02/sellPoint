<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Product;

class AuthController extends Controller
{
    public function login()
    {
    	return view('auth.login');
    }
    public function handleLogin(Request $request)
    {
    	$this->validate($request,User::$login_validation_rules);
    	$data = $request->only('email','password');
    	if(\Auth::attempt($data))
    	{
           
    	   return \View::make('sales.counter_sale');
        }
    	return back()->withInput()->withErrors(['email'=>'Username or password incorrect']);
    }
    public function logout()
    {
		\Auth::logout();
		return redirect()->route('login');    

    }
    public function home(){
        $product= new Product();
        $cochinitaPrice=$product->getPriceSaleProductById(13);
        var_dump($cochinitaPrice);
        $field_data=array();
        for ($i=10; $i <=$cochinitaPrice ; $i=$i+10) {
             $field_data[$i]=($i/$cochinitaPrice);
        }

        return \View::make('sales.counter_sale')->with(array('field_data'=>$field_data)); 
    }
}
