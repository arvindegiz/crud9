<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\support\facades\Validator;
use Illuminate\support\facades\File;



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
            // $employee = new Employee();
            // $employee-> name = $request->name;
            // $employee-> email = $request->email;
            // $employee-> address = $request->address;
            // $employee->save();

            $employee = new Employee();
            $employee->fill($request->post())->save();

            // Upload image
            if ($request->image){
                $ext = $request->image->getClientOriginalExtension();
                $newFIleName = time().'.'.$ext;
                $request->image->move(public_path().'/upload/employees',$newFIleName);
                $employee->image = $newFIleName;
                $employee->save();
            }

            // $request->session()->flash('success','Employee added successfully.');

            return redirect()->route('employee.index')->with('success','Employee added successfully.');

        } else {
            return redirect()->route('employee.create')->withErrors($validator)->withInput();
        }
    }
    public function edit($id){
        $employee = Employee ::findOrFail($id);

        return view('employee.edit',['employee'=>$employee]);
    }
    public function update($id, Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'image' => 'sometimes|image:gif,png,jpeg,jpg',


        ]);
        if($validator->passes() ) {
            $employee = Employee::find($id);
            $employee-> name = $request->name;
            $employee-> email = $request->email;
            $employee-> address = $request->address;
            $employee->save();

            // Upload image
            if ($request->image){
                $oldImage = $employee->image;
                $ext = $request->image->getClientOriginalExtension();
                $newFIleName = time().'.'.$ext;
                $request->image->move(public_path().'/upload/employees',$newFIleName);

                $employee->image = $newFIleName;
                $employee->save();

                File::delete(public_path().'/upload/employees'.$oldImage);
            }

            // $request->session()->flash('success','Employee Updated successfully.');

            return redirect()->route('employee.index')->with('success','Employee Updated successfully.');

        } else {
            return redirect()->route('employees.edit',$id)->withErrors($validator)->withInput();
        }
    }
    public function destroy($id, Request $request){
        $employee = Employee::findOrFail($id);

        File::delete(public_path().'/upload/employees'.$employee->image);

        $employee->delete();

        // $request-> session()->flash('success','Employee Deleted Successfully');
        return redirect()->route( 'employee.index')->with('success','Employee Deleted successfully.');
    } 
}
