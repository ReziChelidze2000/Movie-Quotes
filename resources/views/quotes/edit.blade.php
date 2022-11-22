<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quotes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{route('quotes.update',$quote->id)}}" method="post" enctype='multipart/form-data'>
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="text"
                                       value="{{$quote->text}}">
                                @error('text')
                                <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3 col-3">
                                <label for="select" class="form-label">Choose Movie</label>
                                <select class="select form-control form-control-sm"
                                        id="select" name="movie_id">
                                    @foreach($movies as $movie)
                                        <option @if($movie->id === $quote->movie_id) selected @endif
                                        value="{{$movie->id}}">{{$movie->title}}</option>
                                    @endforeach

                                </select>
                                @error('director_id')
                                <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

</x-app-layout>



