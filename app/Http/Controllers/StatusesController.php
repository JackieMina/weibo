<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

class StatusesController extends Controller
{
    public function __consturct(){
        $this->middleware('auth');
    }

    public function store(Request $request){
        $this->validate($request,[
            'content'=>'required|max:140'
        ]);

        Auth::user()->statuses()->create([
            'content'=>$request['content']
        ]);
        session()->flash('success','publish success! ');
        return redirect()->back();

    }
}
