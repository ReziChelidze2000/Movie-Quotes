<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Movies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{route('movies.update',$movie->id)}}" method="post" enctype='multipart/form-data'>
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{$movie->title}}">
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3 col-3">
                                <label for="image" class="form-label">Upload new image</label>
                                <input type="file" class="form-control" id="image" name="image"
                                       value="">
                                @error('image')
                                <div class="alert alert-danger">{{$message}}</div> @enderror
                            </div>

                            <div class="mb-3 col-3">
                                <label for="multiple-select" class="form-label">Director</label>
                                <select class="select form-control form-control-sm"
                                        id="multiple-select" name="director_id">
                                    <option value="">-----</option>

                                    @foreach($directors as $director)
                                        <option @if($director->id === $movie->director_id) selected @endif
                                        value="{{$director->id}}">{{$director->first_name . $director->last_name}}</option>
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



