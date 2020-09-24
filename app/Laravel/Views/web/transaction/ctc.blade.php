@extends('web._layouts.main')


@section('content')

<!--team section start-->
<section class="px-120 pt-110 pb-80 gray-light-bg">
    <div class="container">
        <div class="row flex-row items-center px-4">
            <h5 class="text-title pb-3"><i class="fa fa-file"></i><span class="text-title-two"> Community Tax Certifcate</span></h5>
            <a href="{{route('web.transaction.ctc_history')}}" class="custom-btn badge-primary-2 text-white " style="float: right;margin-left: auto;">CTC Application History</a>
        </div>
        @include('web._components.notifications')
        <div class="card">
            <form method="POST" action="{{route('web.transaction.other_store')}}" enctype="multipart/form-data">
            {!!csrf_field()!!}
                <div class="card-body px-5 py-0">
                    <h5 class="text-title text-uppercase pt-5">Application information</h5>
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="text-form pb-2">First Name</label>
                                <input type="text" class="form-control form-control-sm" name="firstname" value="{{old('firstname',Auth::guard('customer')->user()->fname) }}" readonly>
                                
                            </div>
                        </div>
                         <div class="col-sm-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="text-form pb-2">Middle Name</label>
                                <input type="text" class="form-control form-control-sm" name="middlename" value="{{old('middlename',Auth::guard('customer')->user()->mname) }}" readonly>
                              
                            </div>
                        </div>
                         <div class="col-sm-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="text-form pb-2">Last Name</label>
                                <input type="text" class="form-control form-control-sm "  name="lastname" value="{{old('lastname',Auth::guard('customer')->user()->lname) }}" readonly>
                               
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="text-form pb-2">Emal</label>
                                <input type="text" class="form-control form-control-sm {{ $errors->first('email') ? 'is-invalid': NULL  }}"  placeholder="Tin Number" name="email" value="{{$other_customer ? $other_customer->email : Auth::guard('customer')->user()->email }}">
                                @if($errors->first('email'))
                                    <small class="form-text pl-1" style="color:red;">{{$errors->first('email')}}</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="text-form pb-2">Contact Number</label>
                                <input type="text" class="form-control form-control-sm {{ $errors->first('contact_number') ? 'is-invalid': NULL }}"  placeholder="contact_number" name="contact_number" value="{{$other_customer ? $other_customer->contact_number : Auth::guard('customer')->user()->contact_number }}">
                                @if($errors->first('contact_number'))
                                    <small class="form-text pl-1" style="color:red;">{{$errors->first('contact_number')}}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                  	<div class="row">
                  		<div class="col-sm-12 col-md-6 col-lg-6">
                  			<div class="form-group">
                                <label for="exampleInputEmail1" class="text-form pb-2">Region/Municipality/Barangay</label>
                                <input type="text" class="form-control form-control-sm"   name="region_address" value="{{old('region_address',Auth::guard('customer')->user()->regional_address)}}" readonly>
                            </div>
                  		</div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="text-form pb-2">Address</label>
                                <input type="text" class="form-control form-control-sm {{ $errors->first('address') ? 'is-invalid': NULL  }}" name="address" value="{{old('address',Auth::guard('customer')->user()->address)}}" readonly>
                               
                            </div>
                        </div>
                      
                  	</div>
                  	<div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="text-form pb-2">Tin Number</label>
                                <input type="text" class="form-control form-control-sm {{ $errors->first('tin_no') ? 'is-invalid': NULL  }}"  placeholder="Tin Number" name="tin_no" value="{{$other_customer ? $other_customer->tin_no : Auth::guard('customer')->user()->tin_no }}">
                                @if($errors->first('tin_no'))
                                    <small class="form-text pl-1" style="color:red;">{{$errors->first('tin_no')}}</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="text-form pb-2">Citizenship</label>
                                <input type="text" class="form-control form-control-sm {{ $errors->first('citizenship') ? 'is-invalid': NULL }}"  placeholder="Citizenship" name="citizenship" value="{{old('citizenship', $other_customer ? $other_customer->citizenship : '')}}">
                                @if($errors->first('citizenship'))
                                    <small class="form-text pl-1" style="color:red;">{{$errors->first('citizenship')}}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="text-form pb-2">Gender</label>
                              	{!!Form::select("gender", $genders, old('gender',$other_customer ? $other_customer->gender : ""), ['id' => "input_gender", 'class' => "form-control form-control-sm classic ".($errors->first('gender') ? 'border-red' : NULL)])!!}
                                @if($errors->first('gender'))
                                    <small class="form-text pl-1" style="color:red;">{{$errors->first('gender')}}</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="text-form pb-2">Civil Status</label>
                                {!!Form::select("status", $civil_status, old('status',$other_customer ? $other_customer->status : ""), ['id' => "input_status", 'class' => "form-control form-control-sm classic ".($errors->first('status') ? 'border-red' : NULL)])!!}
                                @if($errors->first('status'))
                                    <small class="form-text pl-1" style="color:red;">{{$errors->first('status')}}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="text-form pb-2">Birthdate</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control datepicker {{ $errors->first('birthdate') ? 'is-invalid': NULL  }} br-right-white p-2" name="birthdate" placeholder="YYYY-MM-DD" value="{{ $other_customer ? $other_customer->birthday : Auth::guard('customer')->user()->birthdate }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text text-title fw-600"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                                @if($errors->first('birthdate'))
                                    <small class="form-text pl-1" style="color:red;">{{$errors->first('birthdate')}}</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="text-form pb-2">Place of Birth</label>
                                <input type="text" class="form-control form-control-sm {{ $errors->first('place_of_birth') ? 'is-invalid': NULL  }}"  placeholder="Place of Birth" name="place_of_birth" value="{{old('place_of_birth',$other_customer ? $other_customer->place_of_birth:'')}}">
                                @if($errors->first('place_of_birth'))
                                    <small class="form-text pl-1" style="color:red;">{{$errors->first('place_of_birth')}}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="height" class="text-form pb-2">Height(cm)</label>
                                <input type="text" class="form-control form-control-sm" name="height" placeholder="Height" value="{{old('height',$other_customer ? $other_customer->height :'')}}">
                                @if($errors->first('height'))
                                    <small class="form-text pl-1" style="color:red;">{{$errors->first('height')}}</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="height" class="text-form pb-2">Weight(kg)</label>
                                <input type="text" class="form-control form-control-sm" name="weight" placeholder="Weight" value="{{old('weight',$other_customer ? $other_customer->weight :'')}}">
                                @if($errors->first('weight'))
                                    <small class="form-text pl-1" style="color:red;">{{$errors->first('weight')}}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="height" class="text-form pb-2">Occupation</label>
                                <input type="text" class="form-control form-control-sm" name="occupation" placeholder="occupation" value="{{old('occupation',$other_customer ? $other_customer->occupation :'')}}">
                                @if($errors->first('occupation'))
                                    <small class="form-text pl-1" style="color:red;">{{$errors->first('occupation')}}</small>
                                @endif
                            </div>
                        </div>
                         <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="height" class="text-form pb-2">Tax Certificate Type</label>
                                {!!Form::select("ctc_type", $cert_type, old('ctc_type'), ['id' => "input_ctc_type", 'class' => "form-control form-control-sm classic ".($errors->first('ctc_type') ? 'border-red' : NULL)])!!}
                                @if($errors->first('ctc_type'))
                                    <small class="form-text pl-1" style="color:red;">{{$errors->first('ctc_type')}}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="height" class="text-form pb-2">Community Tax Due</label>
                                <input type="text" class="form-control form-control-sm" name="basic_community" placeholder="0.00" value="5" id="input_basic_community" readonly>
                            </div>
                        </div>
                        
                        <div class="col-md-6" id="salary">
                            <div class="form-group">
                                <label for="height" class="text-form pb-2 input-tax">Income From salary</label>
                                <input type="text" class="form-control form-control-sm" name="income_salary" placeholder="0.00" value="{{old('income_salary')}}" id="input_income_salary">
                                @if($errors->first('income_salary'))
                                    <small class="form-text pl-1" style="color:red;">{{$errors->first('income_salary')}}</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6" id="business">
                            <div class="form-group">
                                <label for="height" class="text-form pb-2 input-tax">Gross Sales from business</label>
                                <input type="text" class="form-control form-control-sm" name="business_sales" placeholder="0.00" value="{{old('business_sales')}}" id="input_business_sales">
                                @if($errors->first('business_sales'))
                                    <small class="form-text pl-1" style="color:red;">{{$errors->first('business_sales')}}</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6" id="property">
                            <div class="form-group" >
                                <label for="height" class="text-form pb-2 input-tax">Income from Real Property/ies</label>
                                <input type="text" class="form-control form-control-sm" name="income_real_state" placeholder="0.00" value="{{old('income_real_state')}}" id="input_income_real_state">
                                @if($errors->first('income_real_state'))
                                    <small class="form-text pl-1" style="color:red;">{{$errors->first('income_real_state')}}</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6" id="additional_tax">
                            <div class="form-group">
                                <label for="height" class="text-form pb-2 input-tax">Additional Community Tax</label>
                                <input type="text" class="form-control form-control-sm" name="additional_tax" placeholder="0.00" value="{{old('additional_tax')}}" id="input_additional_tax" readonly>
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
                                <label for="height" class="text-form pb-2">SubTotal</label>
                                <input type="text" class="form-control form-control-sm" name="subtotal" placeholder="0.00" value="{{old('subtotal')}}" id="input_subtotal" readonly>
                                @if($errors->first('subtotal'))
                                    <small class="form-text pl-1" style="color:red;">{{$errors->first('subtotal')}}</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" >
                                <label for="height" class="text-form pb-2">Total Amount to Pay <code class="fs-12">(The total amount to pay may vary based on interest.)</code></label>
                                <input type="text" class="form-control form-control-sm" name="total_amount" placeholder="0.00" value="{{old('total_amount')}}" id="input_total_amount" readonly>
                                @if($errors->first('total_amount'))
                                    <small class="form-text pl-1" style="color:red;">{{$errors->first('total_amount')}}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                        
                    <button class="btn badge badge-primary-2 text-white px-4 py-2 fs-14 mb-5" type="submit"><i class="fa fa-paper-plane pr-2"></i>  Send Application</button>
                </div>
                 
            </form>
        </div>
        
    </div>

</section>
<!--team section end-->
@stop

@section('page-styles')
<link rel="stylesheet" href="{{asset('system/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
<style type="text/css">
.card-body select:focus,input:focus{
    border: solid 2px !important;
    border-color: black !important;
}

.card-body input{
    text-transform: capitalize;
}
.custom-btn{
    padding: 5px 10px;
    border-radius: 10px;
    height: 37px;
}
.custom-btn:hover{
    background-color: #7093DC !important;
    color: #fff !important;
}
</style>
@endsection
@section('page-scripts')
<script src="{{asset('system/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript">
   
    $(function(){
        $('.datepicker').datepicker({
          format : "yyyy-mm-dd",
          maxViewMode : 2,
          autoclose : true,
          zIndexOffset: 9999
        });
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

        
    })


</script>

@endsection
