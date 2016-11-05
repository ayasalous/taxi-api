<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Response;
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



public function login () {
	 return "hello word from login action";
	
}



public function looooginnn (Request $request) {
$taxi = new Taxi;
$email = $request->input('email');
$password = $request->input('password');
$fromDb= DB::table('usertaxi')->get();
$emailarray = DB::table('usertaxi')->pluck('email');
$passwordarray = DB::table('usertaxi')->pluck('password');
//$email='ayasalous@gmail.com';
//$password=1123;

/*
echo  $userInfo[0];
echo  $userInfo[1];
echo  $userInfo[2];
echo  $userInfo[3];
echo  $userInfo[4];
echo  $userInfo[5];
echo  $userInfo[6];
echo  $userInfo[7];
echo  $userInfo[8];
*/

$size =count($emailarray);
$sizepass =count($passwordarray);
$userInfo= array();


/*

//////////////////////check pass/////////////
$checkpass="false";
$resultPass="notDB";

for ( $j=0;$j<$sizepass;$j++){
if ($password== $passwordarray[$j]){
echo $password;
$checkpass="true";
}//if
}//for
  


if($checkpass=="false")
{ $resultPass= "notDB";
$userInfo[9]='notDB';
}//if false
if ($checkpass=="true"){
	$resultPass= "inDB";
}//if true
////////////////////////////////////////////
*/


$check="false";
for ( $i=0;$i<$size;$i++){
if ($email== $emailarray[$i]){
	
$check="true";
}//if
}//for

if($check=="false")
{ 
$userInfo[9]='notDB';
}//if false
if ($check=="true" ){//
	//echo "correct pass && email";
$getUserByEmail = DB::table('usertaxi')->where('email',  $email)->first();

$userInfo[0] = $getUserByEmail->id ;
$userInfo[1] = $getUserByEmail->type;
$userInfo[2] = $getUserByEmail->firstname ;
$userInfo[3] = $getUserByEmail->lastname;
$userInfo[4] = $getUserByEmail->email;
$userInfo[5] = $getUserByEmail->password;
$userInfo[6] = $getUserByEmail->phonenum;
$userInfo[7] = $getUserByEmail->cardnum;
$userInfo[8] = $getUserByEmail->image;
$userInfo[10] = $getUserByEmail->nameoffice;


if ($userInfo[5]==$password){
$userInfo[9] ='inDB';
}else
$userInfo[9] ='notDB';
 
}//if true

//return $userInfo[9];
//return $userInfo;


return json_encode($userInfo);


}//function


public function showDriver(Request $request){
	$nameOffice=$request->input('nameoffice');
	//echo $nameOffice;	
//$nameOffice="madina";
$DriverOffice = DB::table('usertaxi')->where('nameoffice',$nameOffice)->
                                       where('type','driver')->get();

return  json_encode($DriverOffice);
}

public function deleteDriver(Request $request){
	$DriverID=$request->input('DriverID');
	DB::table('usertaxi')->where('id', '=', $DriverID)->delete();
}


public function register(Request $request){
	$taxi = new Taxi;
	$email = $request->input('email');
	$password = $request->input('password');

$fromDb= DB::table('usertaxi')->get();
//$emaildb = DB::table('usertaxi')->where('firstname', 'aya')->value('email'); //T
$titles = DB::table('usertaxi')->pluck('email');

//echo $titles;
$size =count($titles);
//echo $size;

$check="false";
for ( $i=0;$i<$size;$i++){
if ($email== $titles[$i]){
$check="true";
}//if
}//for

if($check=="false")
{  
    $taxi->email = $email;
	$taxi->password = $password;
	$taxi->firstname = $request->input('first');
	$taxi->lastname = $request->input('last');
	$taxi->type = $request->input('type');
	$taxi->phonenum = $request->input('number');
    $taxi->cardnum = $request->input('carnum');
$taxi->save();
return "Done";
}//if false
if ($check=="true"){
	return "notDone";//not done .. not save in DB
}//if true
}//function



public function MangerAddDriver(Request $request){
$taxi = new Taxi;
$email = $request->input('email');
$password = $request->input('password');
$fromDb= DB::table('usertaxi')->get();
$titles = DB::table('usertaxi')->pluck('email');
//echo $titles;
$size =count($titles);
//echo $size;
$check="false";
for ( $i=0;$i<$size;$i++){
if ($email== $titles[$i]){
$check="true";
}//if
}//for
if($check=="false")
{  
    $taxi->email = $email;
	$taxi->password = $password;
	$taxi->firstname = $request->input('first');
	$taxi->lastname = $request->input('last');
	$taxi->type = "driver";
	$taxi->phonenum = $request->input('number');
    $taxi->cardnum = $request->input('cardnumber');
    $taxi->nameoffice = $request->input('officename');
    $taxi->image = 'driver';
$taxi->save();
return "Done";
}//if false
if ($check=="true"){
	return "notDone";//not done .. not save in DB
}//if true
}//function




public function knowtype(Request $request){



}//funKnowuser

}//class