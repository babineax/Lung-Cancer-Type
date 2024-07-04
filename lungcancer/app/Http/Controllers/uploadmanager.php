<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

class uploadmanager extends Controller
{
    public function upload(Request $request,$pathvariable){
      
        
        $url = 'http://127.0.0.1:5000/' . $pathvariable . '/predict';
        ini_set('max_execution_time', 180); 
    $image=$request->file('file');
 $destinationPath = '.';
 $filename=time().$image->getClientOriginalName();
 $newFileName = str_replace(' ', '_', $filename);
 $image->move($destinationPath,$newFileName);

 $response = Http::attach(
    'image', file_get_contents($newFileName), $newFileName
)->post($url);







$jsondata= $response->json();




$data = [
    'pred' => $jsondata['pred'],
    'name' => $jsondata['name']
];
Session::flash('data', $data);
return redirect()->back();




    }
}
