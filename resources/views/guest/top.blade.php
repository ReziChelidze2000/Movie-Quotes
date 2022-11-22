@extends('guest.layout')


@section('content')

    <div>
        <table class="table">
            <thead>
            <tr class="d-flex">
                <th class="col-2">Firstname</th>
                <th class="col-2">Lastname</th>
                <th class="col-6">Quotes</th>
            </tr>
            </thead>
            <tbody>


            @foreach($data as $item)
                <tr class="d-flex">
                    <td class="col-2">{{$item->first_name}}</td>
                    <td class="col-2">{{$item->last_name}}</td>
                    <td class="col-6">
                        <ul>
                            @foreach($item->quotes as $quote)
                                <li>{{$quote->text}}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

@endsection
