<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class CompaniesController extends Controller
{
    public function add() {
        $cols = DB::getSchemaBuilder()->getColumnListing("companies");  
        return view('companies.create', compact('cols'));
    }
    public function store(Request $request) {
         $this->validate($request, [          
           'name' => 'required|string|max:100',
           'email' => 'email|max:255|unique:users',   
           'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
        ]);
         
        $fileName = time().'.'.$request->file('logo')->getClientOriginalExtension();
        $request->file('logo')->move(base_path().'/public/uploads/',$fileName);          
        
        $newItem = new Company();
        $newItem->name = $request->name;        
        $newItem->email = $request->email;
        $newItem->logo = $fileName;
        $newItem->website = $request->website;       
        $newItem->save();
        
        $name = 'Mayada';
        Mail::to('engmaiada@yahoo.com')->send(new SendMailable($name));
   
        return back()->with('success',Lang::get('msgs.row_inserted_suucess'));
    }
    public function all() {
        $all = Company::all();
        return view('companies.all', compact('all'));
    }
    public function delete(Request $request) {
        $itemID = $request->input('itemId');
        Company::find($itemID)->delete();
    }
    public function edit(Company $item) {
        $cols = DB::getSchemaBuilder()->getColumnListing("companies");  
        return view('companies.edit', compact('item','cols'));
    }
    public function update(Request $request, Company $item) {
        $fileName = time().'.'.$request->file('logo')->getClientOriginalExtension();
        $request->file('logo')->move(base_path().'/public/uploads/',$fileName);
        
        $item->name = $request->name;        
        $item->email = $request->email;
        $item->logo = $fileName;
        $item->website = $request->website;   
        $item->save();
        return redirect('companies/all')->with('success',Lang::get('msgs.update_success'));
    }
}
