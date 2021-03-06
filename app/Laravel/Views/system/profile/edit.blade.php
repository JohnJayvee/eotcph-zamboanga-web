@extends('system._layouts.main')

@section('breadcrumbs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('system.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('system.profile.index')}}">My Profile</a></li>
    <li class="breadcrumb-item active" aria-current="page">Update Personal</li>
  </ol>
</nav>
@stop

@section('content')
<div class="col-6 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Update Personal Form</h4>
      <p class="card-description">
        Fill up the <strong class="text-danger">* required</strong> fields.
      </p>
      <form class="create-form" method="POST">
        @include('system._components.notifications')
        {!!csrf_field()!!}
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="input_personal_email">Email Address</label>
              <input type="email" class="form-control lowercase {{$errors->first('personal_email') ? 'is-invalid' : NULL}}" id="input_personal_email" name="personal_email" placeholder="" value="{{old('personal_email',$employee->personal_email)}}">
              @if($errors->first('personal_email'))
              <p class="mt-1 text-danger">{!!$errors->first('personal_email')!!}</p>
              @endif
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="input_contact_number">Contact Number</label>
              <input type="text" class="form-control {{$errors->first('contact_number') ? 'is-invalid' : NULL}}" id="input_contact_number" name="contact_number" placeholder="" value="{{old('contact_number',$employee->contact_number)}}" data-inputmask-alias="0\9999999999">
              @if($errors->first('contact_number'))
              <p class="mt-1 text-danger">{!!$errors->first('contact_number')!!}</p>
              @endif
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="input_residence_address">Residence Address</label>
          <textarea name="residence_address" id="input_residence_address" cols="30" rows="5" class="form-control uppercase {{$errors->first('residence_address') ? 'is-invalid' : NULL}}">{{old('residence_address',$employee->residence_address)}}</textarea>
          @if($errors->first('residence_address'))
          <p class="mt-1 text-danger">{!!$errors->first('residence_address')!!}</p>
          @endif
        </div>

        <button type="submit" class="btn btn-primary mr-2">Update Record</button>
        <a href="{{route('system.profile.index')}}" class="btn btn-light">Return to My Profile</a>
      </form>
    </div>
  </div>
</div>
@stop

@section('page-styles')
@stop

@section('page-scripts')
<script src="{{asset('system/vendors/inputmask/jquery.inputmask.bundle.js')}}"></script>
<script src="{{asset('system/js/inputmask.js')}}"></script>
@stop