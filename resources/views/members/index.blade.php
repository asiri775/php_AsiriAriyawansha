@extends('members.layoutHome')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-1">
            <div class="pull-left p-3 mb-2 bg-secondary text-white">
                <h2>Sales Team</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('members.create') }}"> Create New Member</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-warning">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered table-striped table-responsive-stack" id="tableOne">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>Current Route</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($members as $member)
        <tr>
            <td>{{ $member->id }}</td>
            <td>{{ $member->full_name }}</td>
            <td>{{ $member->email_address }}</td>
            <td>
                @foreach ($member->telephones as $telephone)
                {{ $telephone->number }}
                @endforeach
            <td>{{ $member->route->route_name }}</td>
            <td>
                <form action="{{ route('members.destroy',$member->id) }}" method="POST">
                    <a href="#" class="btn btn-info" data-toggle="modal" id="mediumButton" data-target="#mediumModal"
                                data-attr="{{ route('members.show',$member->id) }}" data-name="{{ $member->full_name }}">View</a>
                    <a class="btn btn-primary" href="{{ route('members.edit',$member->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <style>
        #mediumModal{
            padding-top:80px;
        }
    </style>
    <!-- medium modal -->
    <div class="modal fade pt-70" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="mediumTitle"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="mediumBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
         // display a modal (medium modal)
         $(document).on('click', '#mediumButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            let name = $(this).attr('data-name');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#mediumModal').modal("show");
                    $('#mediumTitle').html(name).show();
                    $('#mediumBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });
        </script>
    {!! $members->links() !!}
@endsection