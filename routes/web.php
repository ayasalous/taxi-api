 <?php



Route::get('/', function () {
    return view('welcome'); });

Auth::routes();
Route::get('/home', 'HomeController@index');
Route::get('m', 'PageController@registration');




Route::get('s',function(){
$fromDb= DB::table('usertaxi')->get();
return Response::Json($fromDb);
});



