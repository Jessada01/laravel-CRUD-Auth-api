<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;

class StudentController extends Controller
{
    public function Create(Request $request)
    {
        $student = new student;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->department = $request->department;
        $student->section = $request->section;
        $result = $student->save();

        if($result)
        {
            return ["Result"=>"Data has been saved"];
        }else{
            return ["Result"=>"Data save failed"];
        }

    }

    public function UpdataData(Request $request,$id)
    {
        $student = student::find($id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->department = $request->department;
        $student->section = $request->section;
        $result = $student->save();

        if($result)
        {
            return ["Result"=>"Data has been updete"];
        }else{
            return ["Result"=>"Data update failed"];
        }
    }

    public function Delete($id)
    {
        $student = Student::find($id);
        $result = $student->delete();

        if($result)
        {
            return ["Result"=>"Data has been delete"];
        }else{
            return ["Result"=>"Data delete failed"];
        }
    }


    public function Read() //$id
    {
        return student::all();

        /*
        $student = Student::find($id);
        if($student)
        {
            return ["student"=>$student];
        }else{
            return ["Result"=>"No student found!"];
        }
        */
        
    }

}
