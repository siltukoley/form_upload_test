<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Career;

class CareerController extends Controller
{
    public function index()
    {
        $career_data = Career::get();
  
        return view('careers', compact('career_data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'contact_no' => 'required',
            'email' => 'required',
            'experience' => 'required',
            'skill_sets' => 'required',
        ]);
        $request->validate([
            'resume' => 'required|image|mimes:pdf,jpg|max:2048',
        ]);
  
        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        }
       
        $fileName = time().'.'.$request->resume->extension();  
         
        $request->resume->move(public_path('images'), $fileName);
      

        Career::create([
            'name' => $request->name,
            'contact_no' => $request->contact_no,
            'email' => $request->email,
            'experience' => $request->experience,
            'skill_sets' => $request->skill_sets,
            'current_organization' => $request->current_organization,
            'remarks' => $request->remarks,
            'resume' => $fileName,
        ]);
  
        return response()->json(['success' => 'Data added successfully.']);
    }
}
