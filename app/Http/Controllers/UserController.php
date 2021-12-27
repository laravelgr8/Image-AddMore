<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class UserController extends Controller
{
    public function index()
    {
        $data=DB::table('image')->get();
        return view('home',compact('data'));
    }

    public function insert(Request $request)
    {
        // if($request->hasFile('pic') || $request->pic_!=''){
        DB::table('image')->delete();
        foreach($request->user_id as $key => $value)
        {
            if (!empty($request->file('pic')[$key]) && array_key_exists($key, $request->file('pic'))) 
            {

                 if ($request->hasFile('pic')) 
                 {                            
                    $file = $request->file('pic')[$key];
                    $fileName = time() . '-' . $file->getClientOriginalName();
                    $fileUploaded = $file->move(public_path() . '/image/', $fileName);
                    if ($fileUploaded) 
                    {
                        $File_Uploaded_Status = 1;
                        $pic = $fileName;
                    }
                } 
                else 
                {
                    $pic = '';
                }
            }
            else 
            {
                if(array_key_exists($key, $request->pic_))
                {
                    $pic = $request->pic_[$key];
                }
                // else{
                //     $pic = '';
                // }
                // return $pic;
            }


            $data=DB::table('image')->insert([
                "emp_id"=>$value,
                "pic"=>$pic
            ]);
        }
        return redirect()->route('index');


    }
}
