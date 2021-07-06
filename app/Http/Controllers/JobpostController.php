<?php

namespace App\Http\Controllers;

use App\Models\Jobpost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobpostController extends Controller
{

    public function index()
    {
      $jobpost = Jobpost::all();
      return view('Jobpost.index',[
        'jobpost' => $jobpost
      ]);
    }

    public function create()
    {
      return view('Jobpost.form');
    }

    public function store(Request $request)
    {
      $request->validate([
        'title' => 'required',
        'city' => 'required',
        'price' => 'required|numeric',
        'description' => 'required|max:4000',
        'name' => 'required',
        'phonenumber' => 'required|numeric'
    ]);

    $jobpost = Jobpost::create($request->all());
    return redirect('/');
    }

    public function show($id)
    {
      $jobpost = Jobpost::findorFail($id);
      return view('Jobpost.show',[
        'jobpost' => $jobpost
      ]);
    }


}
