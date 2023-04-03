<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index(){
        return view('frontEnd.home.home');
    }

    public function store(Request $request){
        $file= $request->file('avatar');
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $file->storeAs('public/images/',$fileName);
        $empData=[
            'first_name'=>$request->fname,
            'last_name'=>$request->lname,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'post'=>$request->post,
            'avatar'=>$fileName,
        ];
        Employee::create($empData);
        return response()->json([
            'status'=>200,
        ]);
    }

    public function fetchAll(){
        $employee=Employee::all();
        $output='';
        if($employee->count() > 0){
            $output .='<table class="table table-striped table-sm text-center">
            <thead>
            <tr>
            <th>ID</th>
            <th>Avasta</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>Post</th>
            <th>Phone</th>
            <th>Action</th>
            </tr>
            </thead>
            <tbody>';
            foreach($employee as $empl){
                $output .='<tr>
                <td>'.$empl->id.'</td>
                <td><img src="storage/images/'.$empl->avatar.'" width="50" class="img-thumbnail rounded-circle"></td>
                <td>'.$empl->first_name.' '.$empl->last_name.'</td>
                <td>'.$empl->email.'</td>
                <td>'.$empl->post.'</td>
                <td>'.$empl->phone.'</td>
                <td>
                <a href="" id="'.$empl->id.'" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i class="fa-solid fa-pen-to-square"></i></a>
                <a href="" id="'.$empl->id.'" class="text-danger mx-1 deleteIcon"><i class="fa-solid fa-trash"></i></a>
                </td>
                </tr>';
            }
            $output .='</tbody></table>';
            echo $output;
        }else{
            echo '<h1 class="text-center text-secondary">No record Present in database</h1>';
        }
    }
    //delete
    public function delete(Request $request){
        $id  = $request->id;
        $emp = Employee::find($id);
        if(Storage::delete('public/images/'.$emp->avatar)){
            Employee::destroy($id);
        }
        // $emp->delete();
    }

    //edit
    public function edit(Request $request){
        $id= $request->id;
        $emp = Employee::find($id);
        return response()->json($emp);
    }

    //update
    public function update(Request $request){
        $fileName = '';
        $emp =  Employee::find($request->emp_id);
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('public/images',$fileName);
            if($emp->avatar){
                Storage::delete('public/images/'.$emp->avatar);
                // $file->storeAs('public/images/',$fileName);
            }
        }else{
            $fileName= $request->emp_avatar;
        }
        $empData=[
            'first_name'=>$request->fname,
            'last_name'=>$request->lname,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'post'=>$request->post,
            'avatar'=>$fileName,
        ];
        $emp->update($empData);
        return response()->json([
            'status'=> 200
        ]);
    }
}
