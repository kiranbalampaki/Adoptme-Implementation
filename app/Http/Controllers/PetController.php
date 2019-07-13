<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Pet;
use Session;
use File;
use App\Channel;
use App\User;
use App\Message;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pets = Pet::where('is_adopted','FALSE')->orderBy('id','desc')->get();
        if(!empty($request->type)){
            $pets=Pet::where('type', '=', $request->type)->get();
        }
        // if (($request->has('type')) || ($request->has('gender'))) {
        //     $pets = Pet::where('type',$request->type)->where('gender',$request->gender)->orderBy('id','desc')->get();
        // }
        // $fields = ['type', 'gender','age','size','color'];
        // foreach($fields as $field){
        //     if(!empty($request->$field)){
                
        //     }
        // }
        return view('pets.index')->with('pets', $pets);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $currentuserid = Auth::user()->id;
        $pets = Pet::where('user_id','=',$currentuserid)->get();
        $messages = Message::where('sender','=',$currentuserid)->
        orWhere('receiver','=',$currentuserid)->
        groupBy('channel_id')->
        orderBy('created_at','desc')->take(4)->get();

        $users = User::all();    
        return view('pets.create', compact('users', 'messages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(request()->all());        
        $request->validate([
            'type'    =>  'required',
            'image'    =>  'required|image|max:2048',
            'name'     =>  'required',
            'gender'     =>  'required',
            'age'     =>  'required',
            'size'     =>  'required',
            'color'     =>  'required',
            'details'     =>  'required',
        ]);

        $image = $request->file('image');

        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('assets/uploads/pets'), $new_name);

        $pet = new Pet();
        $pet->type = $request->type;
        $pet->pet_photo = $new_name;
        $pet->name = $request->name;
        $pet->gender = $request->gender;
        $pet->age = $request->age;
        $pet->size = $request->size;
        $pet->color = $request->color;
        $pet->is_vaccinated = $request->input('is_vaccinated') ? true : false;
        $pet->is_dewormed = $request->input('is_dewormed') ? true : false;
        $pet->details = $request->details;
        $pet->user_id = $request->user()->id;
        
        $pet->save();
        return redirect()->route('petindex')->with('success','Pet added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pet = Pet::find($id);
        return view('pets.show')->with('pet',$pet);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd(request()->all());
        $pet = Pet::findOrFail($id);
        $pet->is_adopted = $request->input('is_adopted') ? true : false;
        $pet->save();
        return redirect()->back()->with('success','Status updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);
        
        $pet->delete();

        return redirect()->back()->with('success','Pet deleted successfully!');   
    }
}
