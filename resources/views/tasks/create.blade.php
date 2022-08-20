@extends('master')

@section('content')
    <div class="container">
            <h2>Create Task</h2>
        <div class="row">
            <div class="col-sm-4 offset-sm-4">
                <form method="POST" action="{{route('tasks.store')}}">
                    @csrf
                    <div class="form-group mt-2">
                        <label for="adminName">Admin Name</label>
                        <select class="form-control" name="assigned_by_id" id="adminName">
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="title">Title</label>
                        <input class="form-control" type="text" name="title" id="title" placeholder="Title" value="{{old('title')}}">
                    </div>
                    <div class="form-group mt-2">
                            <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3">{{old('description')}}</textarea>
                    </div>
                    <div class="form-group mt-2">
                        <label for="assignedUser">Assigned User</label>
                        <select class="form-control" name="assigned_to_id" id="assignedUser">
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2 col-12">Submit</button>
                </form>
            </div>
        </div>

    </div>


@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#adminName').select2({
                minimumInputLength: 2,
                ajax: {
                    url: '{{ route("api.users.search",['role'=>'admin']) }}',
                    dataType: 'json',
                },
            });

            $('#assignedUser').select2({
                minimumInputLength: 2,
                ajax: {
                    url: '{{ route("api.users.search") }}',
                    dataType: 'json',
                },
            });
        });
    </script>
@endsection
