@extends('members.layout')
@section('content')
    <div class="row">
    <div class="col-lg-12 margin-tb mt-50">
        <div class="pull-left p-3 mb-2 bg-secondary text-white">
                <h4>Edit Sales Representative:</h4>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('members.index') }}"> Back to List</a>
            </div>
        </div>
    </div>
    <script>
    $( function() {
        var today = new Date();
        $("#datepicker").datepicker({
            dateFormat: 'yy-mm-dd',
            autoclose:true,
            endDate: "today",
            maxDate: today
        });
    } );
    </script>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('members.update',$member->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group row">
        <label for="full_name" class="col-sm-2 col-form-label"><strong>Full Name:</strong></label>
        <div class="col-sm-6">
            <input type="text" name="full_name" value="{{ $member->full_name }}" class="form-control" id="full_name" placeholder="Full Name">
        </div>
    </div>
    <div class="form-group row">
        <label for="email_address" class="col-sm-2 col-form-label"><strong>Email Address:</strong></label>
        <div class="col-sm-6">
            <input type="text" name="email_address" value="{{ $member->email_address }}" class="form-control" id="email_address" placeholder="Email Address">
        </div>
    </div>
    <div class="form-group row">
        <label for="telephone" class="col-sm-2 col-form-label"><strong>Telephone:</strong></label>
        <div class="col-sm-6">
           @foreach ($member->telephones as $telephone)
                    <input type="text" name="telephone" value="{{ $telephone->number }}" id="telephone" class="form-control" placeholder="Telephone">
           @endforeach
        </div>
    </div>
    <div class="form-group row">
        <label for="datepicker" class="col-sm-2 col-form-label"><strong>Join Date:</strong></label>
        <div class="col-sm-6">
            <input type="text" name="join_date" value="{{ $member->join_date }}" class="form-control" id="datepicker" placeholder="Join Date">
        </div>
    </div>
    <div class="form-group row">
        <label for="datepicker" class="col-sm-2 col-form-label"><strong>Route:</strong></label>
        <div class="col-sm-6">
            <select name="route_id" class="form-control"> 
                <option value="">- Select- </option>
                @foreach ( $routes as $route)
                <option value="{{$route->id}}" <?php  echo ($route->id==$member->route_id)?'selected':'' ?>>{{$route->route_name}}</option>
                @endforeach

            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="comments" class="col-sm-2 col-form-label"><strong>Comments:</strong></label>
        <div class="col-sm-6">
            <textarea class="form-control" style="height:150px" id="comments" name="comments" placeholder="Comments">{{ $member->comments }}</textarea>
        </div>
    </div>
    <div class="form-group row">
    <div class="col-sm-6"></div>
        <div class="col-sm-6">
        <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
    </form>
@endsection