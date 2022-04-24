@extends('members.layoutHome')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mt-50">
            <div class="p-3 mb-2 bg-secondary text-white">
                <h4>Sales Team</h4>
            </div>

        </div>
    </div>
    <div class="col-md-12 back-btn">
        <a class="btn btn-success" href="{{ route('members.create') }}"> Create New Member</a>
        <br>
    </div>
    <br>


    <div class="col-md-12">
        <div>
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
        </div>
        <br>
        <table class="table table-hover table-responsive" id="tableOne">
            <thead>
            <tr>
                <th style="width: 5%;">ID</th>
                <th style="width: 20%;">Name</th>
                <th style="width: 15%;">Email</th>
                <th style="width: 15%;">Telephone</th>
                <th style="width: 15%;">Current Route</th>
                <th style="width: 30%;">Action</th>
            </tr>
            </thead>
            <tbody>
            @if(count($members)==0)
                <tr>
                    <td colspan="6" style="text-align: center;">Data is not available.</td>
                </tr>
            @else
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
                            <div class="row">
                                <form action="{{ route('members.destroy',$member->id) }}" method="POST">

                                    <a href="#" class="btn btn-info" data-toggle="modal" id="mediumButton"
                                       data-target="#mediumModal"
                                       data-attr="{{ route('members.show',$member->id) }}"
                                       data-name="{{ $member->full_name }}">View</a>
                                    <a class="btn btn-primary" href="{{ route('members.edit',$member->id) }}">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>

                                </form>
                            </div>

                        </td>
                    </tr>
                @endforeach
            @endif

            </tbody>

        </table>
        <div class="d-flex justify-content-center">
            {!! $members->links('pagination::bootstrap-4') !!}
        </div>

    </div>

    <!-- medium modal -->
    <div class="modal fade pt-70" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-css">
                <div class="modal-header">
                    <h3 id="mediumTitle"></h3>
                    <button type="button" class="close modal-close-btn" data-dismiss="modal" aria-label="Close">
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
        $(document).on('click', '#mediumButton', function (event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            let name = $(this).attr('data-name');
            $.ajax({
                url: href,
                // return the result
                success: function (result) {
                    $('#mediumModal').modal("show");
                    $('#mediumTitle').html(name).show();
                    $('#mediumBody').html(result).show();
                },
                error: function (jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });
    </script>

@endsection