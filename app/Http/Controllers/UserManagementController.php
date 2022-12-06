<?php

namespace App\Http\Controllers;

use App\Models\EmailValidation;
use App\Models\User;
use App\Models\UserManagementModel;
use Egulias\EmailValidator\EmailValidator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index(){
        $user = User::all();
        $teacher = UserManagementModel::all();

        return view('page.usermanagement.index', compact('teacher', 'user'));
    }

    //adding teacher
    public function add(){
        return view('page.usermanagement.add');
    }

    //validating email
    public function validate_email(Request $request){
       
        $data = EmailValidation::select('email')->where('email', $request->id)->take(100)->get();
        return response()->json($data);
    }

    //add teacher
    public function add_teacher(Request $request){
        $user = new User();
        $user->email = $request->email;
        $user->scope = "Teacher";
        $user->user_status_id = "1";
        $user->password = Hash::make($request->password);
        $user->save();

        $teacher = new UserManagementModel();
        $teacher->id = $user->id;
        $teacher->firstname = $request->firstname;
        $teacher->middlename = $request->middlename;
        $teacher->lastname = $request->lastname;
        $teacher->id_number = $request->id_number;
        $teacher->save();
        return redirect('/usermanagement');
    }


    //update teacher
    public function update_teacher($id){
        $user = User::all()->where('id', $id);
        $teacher = UserManagementModel::all()->where('id', $id);
        return view('page.usermanagement.update', compact('user', 'teacher'));
    }

    //update process

    public function updated_teacher(Request $request){
        $id = $request->id;

        $data = User::find($id);
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->updated_at = now();
        $data->save();


        $librarian_data = UserManagementModel::find($id);
        $librarian_data->firstname = $request->firstname;
        $librarian_data->middlename = $request->middlename;
        $librarian_data->lastname = $request->lastname;
        $librarian_data->id_number = $request->id_number;
        $librarian_data->updated_at = now();
        $librarian_data->save();
        return redirect('/usermanagement');
    }

    //disable account
    public function disable_account(Request $request){
        $id = $request->id;
        $data = User::find($id);
        $data->user_status_id = '2';
        $data->updated_at = now();
        $data->save();

        $librarian_data = UserManagementModel::find($id);
        $librarian_data->updated_at = now();
        $librarian_data->save();
        return redirect('/usermanagement');
    }
}   
