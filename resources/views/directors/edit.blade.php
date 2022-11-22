<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Directors') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{route('directors.update',$director->id)}}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-3">
                                <label for="first_name" class="form-label">Firstname</label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                       value="{{$director->first_name}}">
                                @error('first_name')
                                <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3 col-3">
                                <label for="last_name" class="form-label">Lastname</label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                       value="{{$director->last_name}}">
                                @error('last_name')
                                <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3 col-3">
                                <label for="multiple-select" class="form-label">Movies</label>
                                <select multiple class="multiple-select form-control form-control-sm"
                                        id="multiple-select" name="movies[]">
                                    @foreach($movies as $movie)
                                        <option value="{{$movie->id}}"
                                                @if($movie->director_id === $director->id) selected @endif>{{$movie->title}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

</x-app-layout>



