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




public function getGeolocationDriver(Request $request) {

$allDrivers= DB::table('usertaxi')->where('type','driver')->get();
return json_encode($allDrivers);


}

public function getGeolocationUser(Request $request) {

$allUsers= DB::table('usertaxi')->where('type','user')->get();
return json_encode($allUsers);


}

public function getGeolocationManger(Request $request) {

$allmangers= DB::table('usertaxi')->where('type','manger')->get();
return json_encode($allmangers);


}
public function MangerUpdateDriver (Request $request) {

	$firstname= $request->input('firstname');
    $lastname= $request->input('lastname');
    $mobilenumber= $request->input('mobilenumber');
    $carnumber= $request->input('carnumber');
    $email=$request->input('email');
    $emailbeforchange=$request->input('emailbeforchange');
 if($emailbeforchange== $email){


DB::table('usertaxi')->where('email',$emailbeforchange)->update(['firstname' => $firstname]);
DB::table('usertaxi')->where('email',$emailbeforchange)->update(['lastname' => $lastname]);
DB::table('usertaxi')->where('email',$emailbeforchange)->update(['email' => $email]);
DB::table('usertaxi')->where('email',$emailbeforchange)->update(['phonenum' => $mobilenumber]);
DB::table('usertaxi')->where('email',$emailbeforchange)->update(['cardnum' => $carnumber]);


 }
else{
 $titles = DB::table('usertaxi')->pluck('email');
    $size =count($titles);
    $check="false";
for ( $i=0;$i<$size;$i++){
if ($email== $titles[$i]){
$check="true";
}//if
}//for

if($check=="false")//you dont have the same email
{  

DB::table('usertaxi')->where('email',$emailbeforchange)->update(['firstname' => $firstname]);
DB::table('usertaxi')->where('email',$emailbeforchange)->update(['lastname' => $lastname]);
DB::table('usertaxi')->where('email',$emailbeforchange)->update(['email' => $email]);
DB::table('usertaxi')->where('email',$emailbeforchange)->update(['phonenum' => $mobilenumber]);
DB::table('usertaxi')->where('email',$emailbeforchange)->update(['cardnum' => $carnumber]);


return "Done";
}//if false
if ($check=="true"){
	return "notDone";//not done .. not save in DB
}//if true

}

}//fun

public function tracking (Request $request) {
	
	$long= $request->input('long');
	$lati=$request->input('lati');
    $email=$request->input('emailuser');
    DB::table('usertaxi')->where('email',$email)->update(['trackLati' => $lati]);
    DB::table('usertaxi')->where('email',$email)->update(['trackLong' => $long]);
    return json_encode($email);
}



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
$size =count($emailarray);
$sizepass =count($passwordarray);
$userInfo= array();
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
$getUserByEmail = DB::table('usertaxi')->where('email',  $email)->first();//get 1 Row from DB

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