<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Channel;
use App\Message;
use App\User;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentuserid = Auth::user()->id;
        $channels = Channel::where('first_user','=',$currentuserid)->
                            orWhere('second_user','=',$currentuserid)->
                            get();
        $users = User::all();
        return view('messages.index', compact('channels','users'));
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
        // dd(request()->all());
        $request->validate([
            'sender'    =>  'required',
            'receiver'     =>  'required',
            'message'    =>  'required',
            'channel_id' => 'required'
        ]);

        $message = new Message();
        $message->receiver = $request->receiver;
        $message->sender = $request->sender;
        $message->message = $request->message;
        $message->channel_id = $request->channel_id;

        // $story->user_id = $request->user()->id;

        $message->save();
        // Session::flast('success','Successfully done bro.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $channel = Channel::find($id);
        $currentuserid = Auth::user()->id;
        $channels = Channel::where('first_user','=',$currentuserid)->
                            orWhere('second_user','=',$currentuserid)->
                            orderBy('id','desc')->
                            get();
        $messages= Message::where('channel_id','=',$id)->orderBy('created_at')->get();
        $users = User::all();
        return view('messages.show', compact('channel','channels','messages','users'));
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
        //
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
