@extends('system._layouts.main')

@section('breadcrumbs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('system.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('system.department.index')}}">Customer Management</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add New Customer</li>
  </ol>
</nav>
@stop

@section('content')
<div class="col-md-10 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Customer Create Form</h4>
      <p class="card-description">
        Fill up the <strong class="text-danger">* required</strong> fields.
      </p>
      <form class="create-form" method="POST" enctype="multipart/form-data">
        @include('system._components.notifications')
        {!!csrf_field()!!}
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="input_title">First Name</label>
              <input type="text" class="form-control {{$errors->first('firstname') ? 'is-invalid' : NULL}}" id="input_firstname" name="firstname" placeholder="First name" value="{{old('firstname')}}">
              @if($errors->first('firstname'))
              <p class="mt-1 text-danger">{!!$errors->first('firstname')!!}</p>
              @endif
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="input_title">Middle Name</label>
              <input type="text" class="form-control {{$errors->first('middlename') ? 'is-invalid' : NULL}}" id="input_middlename" name="middlename" placeholder="First name" value="{{old('middlename')}}">
              @if($errors->first('middlename'))
              <p class="mt-1 text-danger">{!!$errors->first('middlename')!!}</p>
              @endif
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="input_title">Last Name</label>
              <input type="text" class="form-control {{$errors->first('lastname') ? 'is-invalid' : NULL}}" id="input_lastname" name="lastname" placeholder="Last name" value="{{old('lastname')}}">
              @if($errors->first('lastname'))
              <p class="mt-1 text-danger">{!!$errors->first('lastname')!!}</p>
              @endif
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <label for="input_title">Address</label>
          <input type="text" class="form-control {{$errors->first('address') ? 'is-invalid' : NULL}}" id="input_address" name="address" placeholder="Address" value="{{old('address')}}">
          @if($errors->first('address'))
          <p class="mt-1 text-danger">{!!$errors->first('address')!!}</p>
          @endif
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="input_title">Contact Number</label>
              <input type="text" class="form-control {{$errors->first('contact_number') ? 'is-invalid' : NULL}}" id="input_contact_number" name="contact_number" placeholder="Contact Number" value="{{old('contact_number')}}">
              @if($errors->first('contact_number'))
              <p class="mt-1 text-danger">{!!$errors->first('contact_number')!!}</p>
              @endif
              </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="input_title">Email</label>
              <input type="text" class="form-control {{$errors->first('email') ? 'is-invalid' : NULL}}" id="input_email" name="email" placeholder="Email" value="{{old('email')}}">
              @if($errors->first('email'))
              <p class="mt-1 text-danger">{!!$errors->first('email')!!}</p>
              @endif
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="input_title">Tin No.</label>
              <input type="text" class="form-control {{$errors->first('tin_no') ? 'is-invalid' : NULL}}" id="input_tin_no" name="tin_no" placeholder="Tin Number" value="{{old('tin_no')}}">
              @if($errors->first('tin_no'))
              <p class="mt-1 text-danger">{!!$errors->first('tin_no')!!}</p>
              @endif
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="input_title">Citizenship</label>
              <input type="text" class="form-control {{$errors->first('citizenship') ? 'is-invalid' : NULL}}" id="input_citizenship" name="citizenship" placeholder="Citizenship" value="{{old('citizenship')}}">
              @if($errors->first('citizenship'))
              <p class="mt-1 text-danger">{!!$errors->first('citizenship')!!}</p>
              @endif
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="input_title">Gender</label>
              {!!Form::select("gender", $genders, old('gender'), ['id' => "input_gender", 'class' => "custom-select mb-2 mr-sm-2 ".($errors->first('gender') ? 'is-invalid' : NULL)])!!}
              @if($errors->first('gender'))
              <p class="mt-1 text-danger">{!!$errors->first('gender')!!}</p>
              @endif
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="input_title">Civil Status</label>
              {!!Form::select("status", $civil_status, old('status'), ['id' => "input_status", 'class' => "custom-select mb-2 mr-sm-2 ".($errors->first('status') ? 'is-invalid' : NULL)])!!}
              @if($errors->first('status'))
              <p class="mt-1 text-danger">{!!$errors->first('status')!!}</p>
              @endif
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="input_title">Birthday</label>
              <input type="text" class="form-control datepicker {{$errors->first('birthday') ? 'is-invalid' : NULL}}" id="input_birthday" name="birthday" placeholder="yyyy-mm-dd" value="{{old('birthday')}}">
              @if($errors->first('birthday'))
                <p class="mt-1 text-danger">{!!$errors->first('birthday')!!}</p>
              @endif
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="input_title">Place of Birth</label>
              <input type="text" class="form-control {{$errors->first('place_of_birth') ? 'is-invalid' : NULL}}" id="input_place_of_birth" name="place_of_birth" placeholder="Place of Birth" value="{{old('place_of_birth')}}">
              @if($errors->first('place_of_birth'))
              <p class="mt-1 text-danger">{!!$errors->first('place_of_birth')!!}</p>
              @endif
            </div>
          </div>
        </div>
         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="input_title">Height</label>
              <input type="text" class="form-control {{$errors->first('height') ? 'is-invalid' : NULL}}" id="input_height" name="height" placeholder="Height" value="{{old('height')}}">
              @if($errors->first('height'))
              <p class="mt-1 text-danger">{!!$errors->first('height')!!}</p>
              @endif
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="input_title">Weight</label>
              <input type="text" class="form-control {{$errors->first('weight') ? 'is-invalid' : NULL}}" id="input_weight" name="weight" placeholder="Weight" value="{{old('weight')}}">
              @if($errors->first('weight'))
              <p class="mt-1 text-danger">{!!$errors->first('weight')!!}</p>
              @endif
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="input_title">Occupation</label>
          <input type="text" class="form-control {{$errors->first('occupation') ? 'is-invalid' : NULL}}" id="input_occupation" name="occupation" placeholder="Occupation" value="{{old('occupation')}}">
          @if($errors->first('occupation'))
          <p class="mt-1 text-danger">{!!$errors->first('occupation')!!}</p>
          @endif
        </div>

        <button type="submit" class="btn btn-primary mr-2">Create Record</button>
        <a href="{{route('system.department.index')}}" class="btn btn-light">Return to Local Record list</a>
      </form>
    </div>
  </div>
</div>
@stop

@section('page-styles')
<link rel="stylesheet" href="{{asset('system/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" href="{{asset('system/vendors/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}">
<style type="text/css" media="screen">
  .datetimepicker.dropdown-menu{
    width: 40%;
  } 
  .datetimepicker.dropdown-menu table{ width: 100%; } 
  .datetimepicker table tr td.active:active, .datetimepicker table tr td.active:hover:active, .datetimepicker table tr td.active.disabled:active, .datetimepicker table tr td.active.disabled:hover:active, .datetimepicker table tr td.active.active, .datetimepicker table tr td.active:hover.active, .datetimepicker table tr td.active.disabled.active, .datetimepicker table tr td.active.disabled:hover.active,
  .datetimepicker table tr td span.active:active, .datetimepicker table tr td span.active:hover:active, .datetimepicker table tr td span.active.disabled:active, .datetimepicker table tr td span.active.disabled:hover:active, .datetimepicker table tr td span.active.active, .datetimepicker table tr td span.active:hover.active, .datetimepicker table tr td span.active.disabled.active, .datetimepicker table tr td span.active.disabled:hover.active { background: #3bb001; }
</style>
@stop

@section('page-scripts')
<script src="{{asset('system/vendors/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
<script src="{{asset('system/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('system/vendors/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
<script type="text/javascript">
  $(function(){
    $(".editor").each(function(){
        CKEDITOR.replace(this);
    });
    $('.datepicker').datepicker({
     
      format : "yyyy-mm-dd"
    });

    $(".datetimepicker").datetimepicker({
      format : "yyyy-mm-dd hh:ii",
      autoclose: true,
      todayBtn: true,
      minuteStep: 15,
    })

  })
</script>
@stop