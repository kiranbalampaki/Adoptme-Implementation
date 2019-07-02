<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Pet;
use App\Channel;
use App\User;
use App\Message;
use App\Order;
use App\Product;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $currentuserid = Auth::user()->id;
        // $channels = Channel::where('first_user','=',$currentuserid)->
        //                     orWhere('second_user','=',$currentuserid)->
        //                     orderBy('id','desc')->take(4)->get();

        $messages = Message::where('sender','=',$currentuserid)->
                            orWhere('receiver','=',$currentuserid)->
                            groupBy('channel_id')->
                            orderBy('created_at','desc')->take(4)->get();

        $users = User::all();
        return view('user.profile', compact('messages', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd(request()->all());
        $data = request()->validate([
            'image'    =>  'required|image|max:2048'
        ]);

        $user = User::findOrFail(Auth::id());
        $image=$request->image;
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('../assets/uploads/profilepictures'), $new_name);
        $img = '../assets/uploads/profilepictures'.$new_name;

        $user->profile_picture=$img;

        $user->save();

        return redirect()->back();
    }

    public function petindex(){
        $currentuserid = Auth::user()->id;
        $pets = Pet::where('user_id','=',$currentuserid)->get();
        $messages = Message::where('sender','=',$currentuserid)->
        orWhere('receiver','=',$currentuserid)->
        groupBy('channel_id')->
        orderBy('created_at','desc')->take(4)->get();

        $users = User::all();    
        return view('user.petindex', compact('pets', 'users', 'messages'));
    }

    public function purchaseindex(){
        $currentuserid = Auth::user()->id;
        $purchases = Order::where('user_id','=',$currentuserid)->get();
        $messages = Message::where('sender','=',$currentuserid)->
        orWhere('receiver','=',$currentuserid)->
        groupBy('channel_id')->
        orderBy('created_at','desc')->take(4)->get();

        $users = User::all();
        $products = Product::all();    
        return view('user.purchases', compact('purchases', 'users', 'messages','products'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $currentuserid = Auth::user()->id;
        $messages = Message::where('sender','=',$currentuserid)->
        orWhere('receiver','=',$currentuserid)->
        groupBy('channel_id')->
        orderBy('created_at','desc')->take(4)->get();

        return view('user.editprofile', compact('user','messages'));
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

        $user = User::findOrFail($id);
        $user->firstname = $request->first_name; 
        $user->lastname = $request->last_name; 

        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('assets/uploads/profilepictures'), $new_name);
        
            $user->profile_picture=$new_name;
        
        $user->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
