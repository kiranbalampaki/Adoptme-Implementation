@extends('messages.dashboard')

@section('content')
<div class="content">
		<div class="contact-profile">
            @if ($channel->first_user == Auth::user()->id)
                <?php $img = \App\User::where(['id' => $channel->second_user])->pluck('profile_picture')->first() ?>
            @else
                <?php $img = \App\User::where(['id' => $channel->first_user])->pluck('profile_picture')->first() ?>
            @endif
            @if ($img!=null)
                  <img src="{{asset('assets/uploads/profilepictures/'.$img)}}" alt="" />
            @else
                  <img src="https://i.stack.imgur.com/HQwHI.jpg" alt="" />
            @endif
            @if ($channel->first_user == Auth::user()->id)
                <p class="name">{{ \App\User::where(['id' => $channel->second_user])->pluck('firstname')->first() }}
                                {{ \App\User::where(['id' => $channel->second_user])->pluck('lastname')->first() }}
                </p>
            @else
                <p class="name">{{ \App\User::where(['id' => $channel->first_user])->pluck('firstname')->first() }}
                                {{ \App\User::where(['id' => $channel->first_user])->pluck('lastname')->first() }}
                </p>
            @endif
		</div>
		<div class="messages pb-3" id="messages">
			<ul>
            @foreach($messages as $message)
                @if ($message->sender==Auth::user()->id)
                    <li class="replies">
                    <?php $img = \App\User::where(['id' => $channel->first_user])->pluck('profile_picture')->first() ?>
                    @if ($img!=null)
                        <img src="{{asset('assets/uploads/profilepictures/'.$img)}}" alt="" />
                    @else
                        <img src="https://i.stack.imgur.com/HQwHI.jpg" alt="" />
                    @endif
                        <p>{{$message->message}}</p><br>
                    </li>
                        <small class="float-right mr-5" style="font-size:12px;">{{ date('h:m A', strtotime($message->created_at)) }}</small>
                @else
                    <li class="sent">
                    <?php $img = \App\User::where(['id' => $channel->second_user])->pluck('profile_picture')->first() ?>
                    @if ($img!=null)
                        <img src="{{asset('assets/uploads/profilepictures/'.$img)}}" alt="" />
                    @else
                        <img src="https://i.stack.imgur.com/HQwHI.jpg" alt="" />
                    @endif 
                    
                        <p>{{$message->message}}</p>
                    </li>
                    <small class="float-left ml-5" style="font-size:12px;">{{ date('h:i A', strtotime($message->created_at)) }}</small>
                @endif
            @endforeach
			</ul>
		</div>
		<div class="message-input">
			<div class="wrap">
                <form action="{{route('messages.store')}}" method="POST">
                {{ csrf_field() }}
                <?php
                    if ($channel->first_user==Auth::user()->id){
                        $receiver=$channel->second_user;
                    }
                    else{
                        $receiver=$channel->first_user;
                    }
                ?>
                <input type="text" name="receiver" value="{{$receiver}}" hidden>
                <input type="text" name="sender" value="{{Auth::user()->id}}" hidden>
                <input type="text" name="channel_id" value="{{$channel->id}}" hidden>
                <input type="text" name="message" placeholder="Write your message..." />
                <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                </form>
			</div>
		</div>
	</div>
@endsection