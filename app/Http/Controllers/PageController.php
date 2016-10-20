<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Taxi;
use DB;
use App\page;

class PageController extends Controller
{
public function registration(){

$page= new page;
$page->title='aseel';
$page->save();


return view('welcome',compact('page'));

// out of p2 
$s = ['aya','aseel','ashar'];//"aya salous";
$num='100';
return view('about',compact('s','num'));

}



public function p1 () {
	$a="hello word";
	return json_encode($a);
}

public function register(Request $request){
	
   //dd($request->all());
	$email = $request->input('email');
	$password = $request->input('password');
	$taxi = new Taxi;
	$taxi->email = $email;
	$taxi->password = $password;
	$taxi->firstname = $request->input('first');
	$taxi->lastname = $request->input('last');
	$taxi->save();
	return "Done!";

}




}