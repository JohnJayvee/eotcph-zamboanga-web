@extends('system._layouts.main')

@section('breadcrumbs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('system.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('system.department.index')}}">Tax Certificate Management</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add New Other Tax Certificate</li>
  </ol>
</nav>
@stop

@section('content')
<div class="col-md-8 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Tax Certificate Create Form</h4>
      <p class="card-description">
        Fill up the <strong class="text-danger">* required</strong> fields.
      </p>
      <form class="create-form" method="POST" enctype="multipart/form-data" action={{ route('system.other_transaction.store') }}>
        @include('system._components.notifications')
        {!!csrf_field()!!}
        <input type="hidden" name="type" value="{{$type}}">
        <input type="hidden" name="customer_id" value="{{$customer_id}}">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" placeholder="First Name" value="{{Str::title($customer->full_name)}}" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tin No.</label>
              <input type="text" class="form-control" placeholder="First Name" value="{{Str::title($customer->tin_no)}}" readonly>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Address</label>
              <input type="text" class="form-control" placeholder="First Name" value="{{Str::title($customer->address)}}" readonly>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="input_title">Email</label>
              <input type="text" class="form-control {{$errors->first('email') ? 'is-invalid' : NULL}}" id="input_email" name="email" placeholder="Email" value="{{old('email')}}">
              @if($errors->first('email'))
              <p class="mt-1 text-danger">{!!$errors->first('email')!!}</p>
              @endif
              </div>
          </div>
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
              <label for="input_title">Community Tax Certificate Amount</label>
              <input type="text" class="form-control {{$errors->first('cert_amount') ? 'is-invalid' : NULL}}" id="input_cert_amount" name="cert_amount" placeholder="Certificate Amount" value="{{old('cert_amount')}}">
              @if($errors->first('cert_amount'))
              <p class="mt-1 text-danger">{!!$errors->first('cert_amount')!!}</p>
              @endif
            </div>
          </div>
        </div>
        <label>Income Salary</label>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" class="form-control {{$errors->first('income_salary') ? 'is-invalid' : NULL}}" id="input_income_salary" name="income_salary" placeholder="0.00" value="{{old('income_salary')}}">
              @if($errors->first('income_salary'))
              <p class="mt-1 text-danger">{!!$errors->first('income_salary')!!}</p>
              @endif
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" class="form-control {{$errors->first('income_salary_two') ? 'is-invalid' : NULL}}" id="input_income_salary_two" name="income_salary_two" placeholder="0.00" value="{{old('income_salary_two')}}">
              @if($errors->first('income_salary_two'))
              <p class="mt-1 text-danger">{!!$errors->first('income_salary_two')!!}</p>
              @endif
            </div>
          </div>
        </div>
        <label>Gross Sales From Bussiness</label>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" class="form-control {{$errors->first('business_sales') ? 'is-invalid' : NULL}}" id="input_business_sales" name="business_sales" placeholder="0.00" value="{{old('business_sales')}}">
              @if($errors->first('business_sales'))
              <p class="mt-1 text-danger">{!!$errors->first('business_sales')!!}</p>
              @endif
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" class="form-control {{$errors->first('business_sales_two') ? 'is-invalid' : NULL}}" id="input_business_sales_two" name="business_sales_two" placeholder="0.00" value="{{old('business_sales_two')}}">
              @if($errors->first('business_sales_two'))
              <p class="mt-1 text-danger">{!!$errors->first('business_sales_two')!!}</p>
              @endif
            </div>
          </div>
        </div>
        <label>Income From Real Property/ies</label>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" class="form-control {{$errors->first('income_real_state') ? 'is-invalid' : NULL}}" id="input_income_real_state" name="income_real_state" placeholder="0.00" value="{{old('income_real_state')}}">
              @if($errors->first('income_real_state'))
              <p class="mt-1 text-danger">{!!$errors->first('income_real_state')!!}</p>
              @endif
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" class="form-control {{$errors->first('income_real_state_two') ? 'is-invalid' : NULL}}" id="input_income_real_state_two" name="income_real_state_two" placeholder="0.00" value="{{old('income_real_state_two')}}">
              @if($errors->first('income_real_state_two'))
              <p class="mt-1 text-danger">{!!$errors->first('income_real_state_two')!!}</p>
              @endif
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Sub-Total</label>
              <input type="text" class="form-control {{$errors->first('subtotal') ? 'is-invalid' : NULL}}" id="input_subtotal" name="subtotal" placeholder="0.00" value="{{old('subtotal')}}">
              @if($errors->first('subtotal'))
              <p class="mt-1 text-danger">{!!$errors->first('subtotal')!!}</p>
              @endif
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Interest</label>
              <input type="text" class="form-control {{$errors->first('interest') ? 'is-invalid' : NULL}}" id="input_interest" name="interest" placeholder="0.00" value="{{old('interest')}}">
              @if($errors->first('interest'))
              <p class="mt-1 text-danger">{!!$errors->first('interest')!!}</p>
              @endif
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Total Tax Due</label>
              <input type="text" class="form-control {{$errors->first('total_tax_due') ? 'is-invalid' : NULL}}" id="input_total_tax_due" name="total_tax_due" placeholder="0.00" value="{{old('total_tax_due')}}">
              @if($errors->first('total_tax_due'))
              <p class="mt-1 text-danger">{!!$errors->first('total_tax_due')!!}</p>
              @endif
            </div>
          </div>
        </div>
        
        <button type="submit" class="btn btn-primary mr-2">Proceed</button>

        <a href="{{route('system.department.index')}}" class="btn btn-light">Return to Tax Certificate list</a>
      </form>
    </div>
  </div>
</div>
@stop

