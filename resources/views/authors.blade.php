@extends('layouts.master')

@section('content')
    <div class="card">
        <h1>List of authors</h1>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>FirstName</th>
                        <th>LastName</th>
                        <th>Birthdate</th>
                        <th>Gender</th>
                        <th>Place of birth</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($authors as $author)
                        <tr class="row_{{ $author['id'] }}">

                            <td>{{ $author['id'] }}</td>
                            <td>{{ $author['first_name'] }}</td>
                            <td>{{ $author['last_name'] }}</td>
                            <td>{{ $author['birthday'] }}</td>
                            <td>{{ $author['gender'] }}</td>
                            <td>{{ $author['place_of_birth'] }}</td>
                            <td><a type="button" class="btn btn-primary viewBook"
                                    href="{{ route('viewBooks') }}/{{ $author['id'] }}" data-id="{{ $author['id'] }}">View
                                    Books</a></td>
                            <td><button type="button" class="btn btn-primary deleteAuthor"
                                    data-id="{{ $author['id'] }}">Delete</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.deleteAuthor').on('click', function() {
                var id = $(this).attr('data-id');
                $.ajax({
                    type: "GET",
                    url: $('#base_path').val() + '/deleteAuthor/' + id,
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
