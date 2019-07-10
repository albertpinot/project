@extends('layouts.app')
@section('content')
    <div id="pjax-container" class="flex-user">
        <div>
        {{$utilisateur->name}}
        </div>
        @auth
            @if($utilisateur->id != Auth::id())
                @if(Auth::user()->jeLesSuit->contains($utilisateur->id))
                    <a href="/suivi/{{$utilisateur->id}}"  data-pjax-toggle>arretez de suivre</a>
                @else
                    <a href="/suivi/{{$utilisateur->id}}" data-pjax-toggle>suivre</a>                        
                @endif
            @endif
        @endauth
        <div>
            <span class="bar">subscribers</span><span class="number"> {{$utilisateur->jeLesSuit->count()}} </span>
        </div>
        <div>
            <span class="bar">followers</span><span class="number"> {{$utilisateur->ilsMeSuivent->count()}} </span>
        </div>

    </div>     
    @include("_chansons", ['chansons'=> $utilisateur->chansons])

@endsection