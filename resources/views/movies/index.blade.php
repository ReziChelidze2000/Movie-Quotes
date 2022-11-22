<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Movies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-success">@if(session()->has('message'))
                        {{session('message')}}
                    @endif</div>
                <div class="p-6 text-gray-900">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Number of quotes</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($data as $item)
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->title}}</td>
                                <td>
                                    {{$item->quotes_count}}
                                </td>
                                <td>
                                    @if(isset($item->image))
                                        <div>
                                            <img src="{{\Illuminate\Support\Facades\Storage::url($item->image)}}"/>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group mr-3" role="group" aria-label="First group">
                                        <form action="{{route('movies.edit',$item->id)}}">
                                            <button type="submit" class="btn btn-secondary active btn-sm">Edit
                                            </button>
                                        </form>

                                        <form action="{{route('movies.destroy',$item->id)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger active btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                        {{$data->links()}}
                        </tbody>
                    </table>
                    <div>
                        <a href="/movies/create" class="btn btn-primary active">Add Movie</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
