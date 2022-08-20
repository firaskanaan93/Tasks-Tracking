@extends('master')
@section('content')
    <div class="container table-responsive py-5">
        <table id="statisticsTable" class="table table-bordered table-hover">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Tasks count</th>
            </tr>
            </thead>
            <tbody id="statisticsBody">
            @foreach($users as $index => $user)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->tasks_count }}</td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>

@endsection
@section('script')
    <script type="text/javascript">

        $(document).ready(function(){
            var statisticsBody = $('#statisticsBody');
            setInterval( function () {
                $.ajax({
                    url: '{{route('tasks.statistics')}}',
                    type: 'get',
                    success:function(data){
                        var html  = '';
                        $.each(data.results,function( index, user ) {
                            html += `<tr>
                        <th scope="row">${index + 1 }</th>
                        <td>${user.name}</td>
                        <td>${user.tasks_count}</td>
                        </tr>`
                        });
                        statisticsBody.empty();
                        statisticsBody.html(html);

                    }
                    })
            }, 5000 );
        });

    </script>
@endsection
