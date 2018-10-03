<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Owner;
use App\Models\Admin\Property;
use App\Models\Admin\Service;
use App\Models\User;
use App\Models\Request as RequstModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminRequestController extends Controller
{
    public function index(){
        // $properties = Property::where('user_id', '<>', 1)->where('status', 0)->orderBy('created_at','desc')->get();
        // $owners = Owner::where('status', 0)->get();
        // $services = Service::where('user_id', '<>', 1)->where('status', 0)->orderBy('created_at','desc')->get();
        // $users = User::where('id', '<>', 1)->where('is_active', 0)->orderBy('created_at','desc')->get();
        $callbacks = RequstModel::where('callback', 1)->orderBy('status', 'asc')->orderBy('created_at', 'desc')->paginate(10);
        $register_interests = RequstModel::where('register_interest', 1)->orderBy('status', 'asc')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.request', compact('callbacks', 'register_interests'));
    }

    public function changeStatus(Request $request, $id)
    {
        if($request->ajax()) {
            $req = RequstModel::findOrFail($id);
            $req->status = $request->value;
            $req->touch();
            $req->save();
            return response()->json('Status successfuly changed', 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    public function delete($id)
    {
        $req = RequstModel::findOrFail($id);
        $req->delete();
    }
}
