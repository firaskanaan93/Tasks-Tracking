@extends('master')
@section('content')
    <div class="container table-responsive py-5">
        <table id="taskTable" class="table table-bordered table-hover">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Assigned Name</th>
                <th scope="col">Admin Name</th>
            </tr>
            </thead>

        </table>
    </div>

@endsection
@section('script')
    <script type="text/javascript">

        $(document).ready(function(){

            var table =  $('#taskTable').DataTable({

                serverSide: true,
                ordering: false,
                ajax: "{{route('api.tasks.index')}}",
                columns: [
                    { data: 'id' },
                    { data: 'title' },
                    { data: 'description' },
                    { data: 'user_name' },
                    { data: 'admin_name' },
                ]
            });

            setInterval( function () {
                table.ajax.reload( null, false ); // user paging is not reset on reload
            }, 5000 );
        });

    </script>
@endsection
