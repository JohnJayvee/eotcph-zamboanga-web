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
              <input type="text" class="form-control {{$errors->first('email') ? 'is-invalid' : NULL}}" id="input_email" name="email" placeholder="Email" value="{{old('email',$customer->email)}}">
              @if($errors->first('email'))
              <p class="mt-1 text-danger">{!!$errors->first('email')!!}</p>
              @endif
              </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="input_title">Contact Number</label>
              <input type="text" class="form-control {{$errors->first('contact_number') ? 'is-invalid' : NULL}}" id="input_contact_number" name="contact_number" placeholder="Contact Number" value="{{old('contact_number',$customer->contact_number)}}">
              @if($errors->first('contact_number'))
              <p class="mt-1 text-danger">{!!$errors->first('contact_number')!!}</p>
              @endif
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="input_title">Tax Certificate Type</label>
              {!!Form::select("ctc_type", $cert_type, old('ctc_type'), ['id' => "input_ctc_type", 'class' => "form-control ".($errors->first('ctc_type') ? 'border-red' : NULL)])!!}
              @if($errors->first('ctc_type'))
              <p class="mt-1 text-danger">{!!$errors->first('ctc_type')!!}</p>
              @endif
            </div>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
              <label for="height" class="text-form">Community Tax Due</label>
              <input type="text" class="form-control" name="basic_community" placeholder="0.00" value="5" id="input_basic_community" readonly>
            </div>
          </div>
        </div>
        <div class="row">
         
          <div class="col-md-6" id="salary">
            <div class="form-group">
              <label for="height" class="text-form">Income From salary</label>
              <input type="text" class="form-control" name="income_salary" placeholder="0.00" value="{{old('income_salary')}}" id="input_income_salary">
              @if($errors->first('income_salary'))
                  <small class="form-text pl-1" style="color:red;">{{$errors->first('income_salary')}}</small>
              @endif
            </div>
          </div>
          <div class="col-md-6" id="business">
            <div class="form-group">
              <label for="height" class="text-form">Gross Sales from business</label>
              <input type="text" class="form-control" name="business_sales" placeholder="0.00" value="{{old('business_sales')}}" id="input_business_sales">
              @if($errors->first('business_sales'))
                  <small class="form-text pl-1" style="color:red;">{{$errors->first('business_sales')}}</small>
              @endif
            </div>
          </div>
          <div class="col-md-6" id="property">
            <div class="form-group" >
              <label for="height" class="text-form">Income from Real Property/ies</label>
              <input type="text" class="form-control" name="income_real_state" placeholder="0.00" value="{{old('income_real_state')}}" id="input_income_real_state">
              @if($errors->first('income_real_state'))
                  <small class="form-text pl-1" style="color:red;">{{$errors->first('income_real_state')}}</small>
              @endif
            </div>
          </div>
           <div class="col-md-6" id="additional_tax">
            <div class="form-group">
              <label for="height" class="text-form">Additional Community Tax</label>
              <input type="text" class="form-control" name="additional_tax" placeholder="0.00" value="{{old('additional_tax')}}" id="input_additional_tax" readonly>
              @if($errors->first('additional_tax'))
                  <small class="form-text pl-1" style="color:red;">{{$errors->first('additional_tax')}}</small>
              @endif
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
              <div class="form-group" >
                <label for="height" class="text-form">SubTotal</label>
                <input type="text" class="form-control" name="subtotal" placeholder="0.00" value="{{old('subtotal')}}" id="input_subtotal" readonly>
                @if($errors->first('subtotal'))
                    <small class="form-text pl-1" style="color:red;">{{$errors->first('subtotal')}}</small>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group" >
                <label for="height" class="text-form">Interest</label>
                <input type="text" class="form-control" name="interest" placeholder="0.00" value="{{old('interest')}}" id="input_interest">
                @if($errors->first('interest'))
                    <small class="form-text pl-1" style="color:red;">{{$errors->first('interest')}}</small>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group" >
                <label for="height" class="text-form">Total Amount to Pay </label>
                <input type="text" class="form-control" name="total_amount" placeholder="0.00" value="{{old('total_amount')}}" id="input_total_amount" readonly>
                @if($errors->first('total_amount'))
                    <small class="form-text pl-1" style="color:red;">{{$errors->first('total_amount')}}</small>
                @endif
              </div>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary mr-2">Proceed</button>

        <a href="{{route('system.other_customer.show',[$customer->id])}}" class="btn btn-light">Return to Customer Recordt</a>
      </form>
    </div>
  </div>
</div>
@stop

@section('page-scripts')
<script type="text/javascript">
   $(function(){
   $('#salary').hide();
    $('#business').hide();
    $('#property').hide();
    $('#basic').hide();

    $('#input_ctc_type').on('change', function(){
        var val = $(this).val();
        var tax = 0;
        if (val == 'salary') {
            $('#salary').fadeIn();
            $('#salary').show();
            $('#business').hide();
            $('#property').hide();
            $('#basic').hide();
        }else if(val == 'business'){
            $('#business').fadeIn();
            $('#business').show();
            $('#salary').hide();
            $('#property').hide();
            $('#basic').hide();
        }else if(val == 'property'){
            $('#property').fadeIn();
            $('#property').show();
            $('#salary').hide();
            $('#business').hide();
            $('#basic').hide();
        }else if(val == 'basic'){
            $('#salary').hide();
            $('#business').hide();
            $('#property').hide();
            $("#input_additional_tax").val(0);
            tax = parseInt($('#input_additional_tax').val()) + 5;
            $('#input_subtotal').val(parseInt(tax));
            $('#input_total_amount').val(parseInt(tax));
        }
    }).change();
        $("#input_income_salary").change(function(){
          var subtotal = 0;
          var total = 0;
          $("#input_income_salary").each(function(){
              if($(this).val() != '')
              {
                  subtotal = parseInt($(this).val()) / 1000;
                  total = subtotal + 5;
              }
          });
          $('#input_additional_tax').val(parseInt(subtotal));
          $('#input_subtotal').val(parseInt(total));
          $('#input_total_amount').val(parseInt(total));
        });
        $("#input_business_sales").change(function(){
          var subtotal = 0;
          var total = 0;
          $("#input_business_sales").each(function(){
              if($(this).val() != '')
              {
                  subtotal = parseInt($(this).val()) / 1000;
                  total = subtotal + 5;
              }
          });
          $('#input_additional_tax').val(parseInt(subtotal));
          $('#input_subtotal').val(parseInt(total));
          $('#input_total_amount').val(parseInt(total));
        });
        $("#input_income_real_state").change(function(){
          var subtotal = 0;
          var total = 0;
          $("#input_income_real_state").each(function(){
              if($(this).val() != '')
              {
                  subtotal = parseInt($(this).val()) / 1000;
                  total = subtotal + 5;
              }
          });
          $('#input_additional_tax').val(parseInt(subtotal));
          $('#input_subtotal').val(parseInt(total));
          $('#input_total_amount').val(parseInt(total));
        });

        $("#input_interest").change(function(){
            var total_amount = 0;
            $("#input_interest").each(function(){
                if($(this).val() != '')
                {
                    total_amount = parseInt($(this).val()) + parseInt($("#input_total_amount").val());
                }
            });
            $('#input_total_amount').val(parseInt(total_amount));
        });
  })
</script>

@endsection