<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Validator;

class HomeController extends Controller
{

    public function dashboard(){
        return view('dashboard');
    }
    public function index(){

        $data = User::get();

        return view('index', compact('data'));
    }

    public function create(){
        return view('create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'email'    => 'required|email',
            'nama'   => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['email']    = $request->email;
        $data['name']     = $request->nama;
        $data['password'] = Hash::make($request->password);

        User::create($data);

        return redirect()->route('index');
    }

    public function edit(Request $request, $id){
        $data = User::find($id);

        dd($data);
    }
}
