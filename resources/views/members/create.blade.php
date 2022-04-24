@extends('members.layout')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb mt-50">
            <div class="p-3 mb-2 bg-secondary text-white">
                <h4>Add New Sales Representative:</h4>
            </div>

        </div>
    </div>
    <div class="col-md-12 back-btn">
        <a class="btn btn-primary" href="{{ route('members.index') }}"> Back to List</a>
    </div>


    <script>
        $(function () {
            var today = new Date();
            $("#datepicker").datepicker({
                dateFormat: 'yy-mm-dd',
                autoclose: true,
                endDate: "today",
                maxDate: today
            });
        });
    </script>

    <br>

    <form action="{{ route('members.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <div class="row">
                <div class="col-md-1"></div>
                <label class="col-md-2 col-xs-12" for="full_name"><strong>Full Name:</strong></label>
                <input type="text" name="full_name" class="form-control col-md-6 col-xs-12"
                       value="{{ old('full_name') }}"
                       id="full_name" placeholder="Full Name">
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    @if ($errors->has('full_name'))
                        <span class="error-message">{!! $errors->first('full_name') !!}</span>
                    @endif
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-1"></div>
                <label class="col-md-2" for="email_address"><strong>Email Address:</strong></label>
                <input type="email" name="email_address" class="form-control col-md-6" value="{{ old('email_address') }}"
                       id="email_address" placeholder="Email Address">
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    @if ($errors->has('email_address'))
                        <span class="error-message" >{!! $errors->first('email_address') !!}</span>
                    @endif
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-1"></div>
                <label class="col-md-2" for="telephone"><strong>Telephone:</strong></label>
                <input type="text" name="telephone" class="form-control col-md-6" value="{{ old('telephone') }}"
                       id="telephone" placeholder="Telephone">
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    @if ($errors->has('telephone'))
                        <span class="error-message">{!! $errors->first('telephone') !!}</span>
                    @endif
                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-md-1"></div>
                <label class="col-md-2" for="datepicker"><strong>Join Date:</strong></label>
                <input type="text" name="join_date" class="form-control col-md-6" value="{{ old('join_date') }}"
                       id="datepicker" placeholder="Join Date">
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    @if ($errors->has('join_date'))
                        <span class="error-message">{!! $errors->first('join_date') !!}</span>
                    @endif
                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-md-1"></div>
                <label class="col-md-2" for="route_id"><strong>Route:</strong></label>
                <select name="route_id" class="form-control col-md-6">
                    <option value="">- Select-</option>
                    @foreach ( $routes as $route)
                        <option value="{{$route->id}}" <?php  echo ($route->id == old('route_id')) ? 'selected' : '' ?>>{{$route->route_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    @if ($errors->has('route_id'))
                        <span class="error-message">{!! $errors->first('route_id') !!}</span>
                    @endif
                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-md-1"></div>
                <label class="col-md-2" for="comments"><strong>Comments:</strong></label>
                <textarea class="form-control col-md-6" style="height:150px" id="comments" name="comments"
                          placeholder="Comments">{{ old('comments') }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    @if ($errors->has('comments'))
                        <span class="error-message">{!! $errors->first('comments') !!}</span>
                    @endif
                </div>
            </div>


        </div>


        <div class="col-md-12">
            <div class="submit-btn" >
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>


@endsection