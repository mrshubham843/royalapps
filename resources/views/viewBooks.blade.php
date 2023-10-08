@extends('layouts.master')

@section('content')
    <div class="card">
        {{-- @php
            if (!empty($books)) {
                $authorDetail = $books[0]->author;
            } else {
                $authorDetail = '';
            }
        @endphp --}}

        {{-- <div class="jumbotron">
            <h1>Navbar example</h1>
            <p class="lead">This example is a quick exercise to illustrate how fixed to top navbar works. As you scroll, it
                will remain fixed to the top of your browser’s viewport.</p>
            <a class="btn btn-sm btn-primary" href="/docs/4.3/components/navbar/" role="button">View navbar docs »</a>
        </div> --}}
    </div>
    <div class="card">
        <h1>List of Books</h1>

        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Release Date</th>
                        <th>ISBN</th>
                        <th>Formate</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr class="row_{{ $book['id'] }}">

                            <td>{{ $book['id'] }}</td>
                            <td>{{ $book['title'] }}</td>
                            <td>{{ $book['release_date'] }}</td>
                            <td>{{ $book['isbn'] }}</td>
                            <td>{{ $book['format'] }}</td>
                            <td><button type="button" class="btn btn-primary  deleteBook"
                                    data-id="{{ $book['id'] }}">Delete</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="display:inline-flex">
            <a type="button" class="btn btn-dark" href="{{ route('addBook') }}"
                style="    width: 20%;
    margin: auto;">Add
                Book</a>

            <a type="button" class="btn btn-dark" href="{{ route('listAuthors') }}"
                style="    width: 20%;
    margin: auto;">View Authors</a>
        </div>


    </div>
    <script>
        $(document).ready(function() {
            $('.deleteBook').on('click', function() {
                var id = $(this).attr('data-id');
                $.ajax({
                    type: "GET",
                    url: $('#base_path').val() + '/deleteBook/' + id,
                    data: {},
                    success: function(res) {
                        if (res) {
                            $('.row_' + id).hide();
                        } else {}
                    }
                });
            });
        });
    </script>
@endsection
