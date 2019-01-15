<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;

use DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Input;

class UsersController extends Controller
{
    public function add() {
        $cols = DB::getSchemaBuilder()->getColumnListing("users");  
        $companies = Company::all();
        return view('users.create', compact('cols','companies'));
    }
    public function store(Request $request) {
         $this->validate($request, [          
           'first_name' => 'required|string|max:100',
           'email' => 'email|max:255|unique:users',
           'password' => 'required|max:255',   
           'phone' => 'numeric'
        ]);
         
        $newItem = new User();
        $newItem->first_name = $request->first_name;
        $newItem->last_name = $request->last_name;
        $newItem->email = $request->email;
        $newItem->password = bcrypt($request->password);
        $newItem->phone = $request->phone;
        $newItem->company_id = $request->company_id;
        $newItem->save();
        return back()->with('success',Lang::get('msgs.row_inserted_suucess'));
    }
    public function all() {
        $all = User::with('company')->get();
        return view('users.all', compact('all'));
    }
    public function delete(Request $request) {
        $userId = $request->input('userId');
        User::find($userId)->delete();
    }
    public function edit(User $item) {
        $companies = Company::all();
        $cols = DB::getSchemaBuilder()->getColumnListing("users");  
        return view('users.edit', compact('item','cols','companies'));
    }
    public function update(Request $request,User $item) {
        $item->first_name = $request->first_name;
        $item->last_name = $request->last_name;
        $item->email = $request->email;
        $item->password = bcrypt($request->password);
        $item->phone = $request->phone;
        $item->company_id = $request->company_id;
        $item->active = $request->active;
        $item->save();
        return redirect('users/all')->with('success',Lang::get('msgs.update_success'));
    }
}
