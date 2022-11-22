@extends('guest.layout')


@section('content')

    <div class="content">
        <div class="image">
            <img src="{{\Illuminate\Support\Facades\Storage::url($movie->image)}}" alt="no image"/>
        </div>
        <div class="quote">{{$quote->text}}</div>
        <div class="director"><a href="movies/{{$movie->id}}">@if(isset($director))
                    {{$director->first_name . $director->last_name}}
                @else
                    No director
                @endif</a></div>
    </div>

@endsection
