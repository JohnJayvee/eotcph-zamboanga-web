@extends('system._layouts.main')

@section('content')
<div class="row px-5 py-4">
  <div class="col-12">
    @include('system._components.notifications')
    <div class="row ">
      <div class="col-md-6">
        <h5 class="text-title text-uppercase">{{$page_title}}</h5>
      </div>
      <div class="col-md-6 ">
        <p class="text-dim  float-right">EOR-PHP Processor Portal / Transactions / Transaction Details</p>
      </div>
    </div>
  </div>
  <div class="col-12 pt-4">
    <div class="card card-rounded shadow-sm">
      <div class="card-body" style="border-bottom: 3px dashed #E3E3E3;">
        <div class="row">
          <div class="col-md-1 text-center">
            <img src="{{asset('system/images/default.jpg')}}" class="rounded-circle" width="100%">
          </div>
          <div class="col-md-11 d-flex">
            <p class="text-title fw-500 pt-3">Application by: <span class="text-black">{{Str::title($transaction->customer->full_name)}}</span></p>
            <p class="text-title fw-500 pl-3" style="padding-top: 15px;">|</p>
            <p class="text-title fw-500 pt-3 pl-3">Application Sent: <span class="text-black">{{ Helper::date_format($transaction->created_at)}}</span></p>
          </div>
        </div> 
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <p class="text-title fw-500">Applying For: <span class="text-black">{{$transaction->type ? Str::title($transaction->transac_type->name) : "N/A"}} [{{$transaction->code}}]</span></p>
            <p class="text-title fw-500">Email Address: <span class="text-black">{{$transaction->email}}</span></p>
          </div>
          <div class="col-md-6">
            <p class="text-title fw-500">Contact Number: <span class="text-black">+63{{$transaction->customer->contact_number}}</span></p>
            <p class="text-title fw-500">Payment Status: <span class="text-black">{{Str::title($transaction->payment_status)}}</span></p>
          </div>
          <div class="col-md-6">
             <p class="fw-500" style="color: #DC3C3B;">Amount: Php {{Helper::money_format($transaction->processing_fee)}}  [{{$transaction->processing_fee_code}}]</p>
          </div>
        </div> 
      </div>
    </div>
  </div>
</div>
@stop



@section('page-styles')
<link rel="stylesheet" href="{{asset('system/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
<style type="text/css" >
  .input-daterange input{ background: #fff!important; }  
  .isDisabled{
    color: currentColor;
    display: inline-block;  /* For IE11/ MS Edge bug */
    pointer-events: none;
    text-decoration: none;
    cursor: not-allowed;
    opacity: 0.5;
  }
</style>
@stop

@section('page-scripts')
<script src="{{asset('system/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript">
  $(function(){
    $('.input-daterange').datepicker({
      format : "yyyy-mm-dd"
    });

    $(".action-process").on("click",function(){
      var btn = $(this);
      $("#btn-confirm-process").attr({"href" : btn.data('url')});
    });

    $('#checkImage').on('show.bs.modal', function (e) {
      var img = $(e.relatedTarget).data('myimage');
      //alert(img);
      $("#thanks").attr("src", img);
    });  
  })
</script>
@stop