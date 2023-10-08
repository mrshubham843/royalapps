@extends('layouts.master')

@section('content')
    <div class="card" style="width: 50%;margin: auto;">

        <h1>Add Book</h1>


        <div class="card-body">
            <form action="{{ url('/saveBook') }}" method="post" name="saveBook">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="Enter email" required>

                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <textarea class="form-control" name="description"></textarea>

                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">ISBN</label>
                    <input type="text" name="isbn" class="form-control" id="isbn" aria-describedby="emailHelp"
                        placeholder="Enter isbn" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Formate</label>
                    <input type="text" name="formate" class="form-control" id="formate" aria-describedby="emailHelp"
                        placeholder="Enter formate" required>

                </div>
                <div class="form-group">
                    <label for=" ">Select Author</label>
                    <div class=" " aria-labelledby="dropdownMenuButton">
                        <select class="form-control" name="selectAuthor">
                            @foreach ($authors as $author)
                                <option value="{{ $author['id'] }}">
                                    {{ $author['first_name'] . ' ' . $author['last_name'] }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <a type="button" class="btn btn-dark" href="{{ route('listAuthors') }}"
            style="    width: 20%;
    margin: auto;">View Authors</a>

    </div>
@endsection
