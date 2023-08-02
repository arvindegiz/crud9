<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\support\facades\Validator;


class EmployeeController extends Controller
{
    //
    public function index()
    {   
        $employees = Employee::orderBy('id','DESC')->paginate(5);
        return view('employee.list',['employees'=> $employees]);
    }
    public function create()
    {
       return view('employee.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'image' => 'sometimes|image:gif,png,jpeg,jpg',


        ]);
        if($validator->passes() ) {
            $employee = new Employee();
            $employee-> name = $request->name;
            $employee-> email = $request->email;
            $employee-> address = $request->address;
            $employee->save();

            // Upload image
            if ($request->image){
                $ext = $request->image->getClientOriginalExtension();
                $newFIleName = time().'.'.$ext;
                $request->image->move(public_path().'/upload/employees',$newFIleName);
                $employee->image = $newFIleName;
                $employee->save();
            }

            $request->session()->flash('success','Employee added successfully.');

            return redirect()->route('employee.index');

        } else {
            return redirect()->route('employee.create')->withErrors($validator)->withInput();
        }
    }
}
