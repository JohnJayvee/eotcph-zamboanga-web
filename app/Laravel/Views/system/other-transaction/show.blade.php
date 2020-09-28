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
  @if($transaction->type == 2)
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
      <div class="card-body" style="border-bottom: 3px dashed #E3E3E3;">
        <div class="row">
          <div class="col-md-6">
            <p class="text-title fw-500">Applying For: <span class="text-black">{{$transaction->type ? Str::title($transaction->transac_type->name) : "N/A"}} [{{$transaction->code}}]</span></p>
            <p class="text-title fw-500">Email Address: <span class="text-black">{{$transaction->email}}</span></p>
            <p class="fw-500" style="color: #DC3C3B;">Amount: Php {{Helper::money_format($transaction->amount)}}  [{{$transaction->processing_fee_code}}]</p>
          </div>
          <div class="col-md-6">
            <p class="text-title fw-500">Contact Number: <span class="text-black">+63{{$transaction->customer->contact_number}}</span></p>
            <p class="text-title fw-500">Payment Status: <span class="text-black">{{Str::title($transaction->payment_status)}}</span></p>
            <p class="text-title fw-500">Transaction Status: <span class="text-black">{{Str::title($transaction->transaction_status)}}</span></p>
          </div>
        </div> 
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <p class="text-title fw-500">Community Tax Certificate Type: <span class="text-black">{{ $ctc ? Helper::tax($ctc->tax_type) : ""}}</span></p>
            <p class="text-title fw-500">Additional Community tax: <span class="text-black">Php {{Helper::money_format($ctc->additional_tax)}}</span></p>
            <p class="text-title fw-500">Subtotal: <span class="text-black">Php {{Helper::money_format($ctc->subtotal)}}</span></p>
            <p class="text-title fw-500">Total Amount to Pay: <span class="text-black">Php {{Helper::money_format($ctc->total_amount)}}</span></p>
          </div>
          <div class="col-md-6">
            <p class="text-title fw-500">Community Tax Due: <span class="text-black">PHP 5.00</span></p>
            <p class="text-title fw-500">Declared Amount: <span class="text-black">Php {{Helper::money_format(Helper::tax_amount($ctc->transaction_id))}}</span></p>
            <p class="text-title fw-500">Interest: <span class="text-black">Php {{Helper::money_format($ctc->interest) ?: "0.00"}}</p>
          </div>
         
        </div> 
      </div>
    </div>
    <a data-url="{{route('system.other_transaction.process',[$transaction->id])}}?status_type=approved" data-toggle="modal" data-target="#confirm-process" class="btn btn-primary mt-4 border-5 text-white action-process {{$transaction->status == 'approved' ? "isDisabled" : ""}}"><i class="fa fa-check-circle"></i> Approve Transactions</a>
    <a  data-url="{{route('system.other_transaction.process',[$transaction->id])}}?status_type=declined" data-toggle="modal" data-target="#confirm-process" class="btn btn-danger mt-4 border-5 text-white action-process {{$transaction->status == 'approved' ? "isDisabled" : ""}}""><i class="fa fa-times-circle"></i> Decline Transactions</a>
  </div>
  @endif
   @if($transaction->type == 1)
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
      <div class="card-body" style="border-bottom: 3px dashed #E3E3E3;">
        <div class="row">
          <div class="col-md-6">
            <p class="text-title fw-500">Applying For: <span class="text-black">{{$transaction->type ? Str::title($transaction->transac_type->name) : "N/A"}} [{{$transaction->code}}]</span></p>
            <p class="text-title fw-500">Email Address: <span class="text-black">{{$transaction->email}}</span></p>
            <p class="fw-500" style="color: #DC3C3B;">Amount: Php {{Helper::money_format($transaction->amount)}}  [{{$transaction->processing_fee_code}}]</p>
          </div>
          <div class="col-md-6">
            <p class="text-title fw-500">Contact Number: <span class="text-black">+63{{$transaction->customer->contact_number}}</span></p>
            <p class="text-title fw-500">Payment Status: <span class="text-black">{{Str::title($transaction->payment_status)}}</span></p>
            <p class="text-title fw-500">Transaction Status: <span class="text-black">{{Str::title($transaction->transaction_status)}}</span></p>
          </div>
        </div> 
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <p class="text-title fw-500">Driver's Name: <span class="text-black">{{ $violator->customer->full_name}}</span></p>
            <p class="text-title fw-500">Violations: <span class="text-black">{{ $violator->violation_name}}</span></p>
            <p class="text-title fw-500">Place of Violation: <span class="text-black">{{ $violator->place_of_violation}}</span></p>
          </div>
          <div class="col-md-6">
            <p class="text-title fw-500">Private Individual Name: <span class="text-black">{{ $violator->private_full_name}}</span></p>
            <p class="text-title fw-500">Date and Time: <span class="text-black">{{ Helper::date_format($violator->date_time)}}</span></p>
            <p class="text-title fw-500">Number of Offense: <span class="text-black">{{ Helper::number_of_offense($violator->customer_id)}}</span></p>
          </div>
         
        </div> 
      </div>
    </div>
  </div>
  @endif
</div>
@stop

@section('page-modals')
<div id="confirm-process" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm your action</h5>
      </div>

      <div class="modal-body">
        <h6 class="text-semibold">Processing Record...</h6>
        <p>You are about to process a record, this action can no longer be undone, are you sure you want to proceed?</p>

        <hr>

        <h6 class="text-semibold">What is this message?</h6>
        <p>This dialog appears everytime when the chosen action could hardly affect the system. Usually, it occurs when the system is issued a delete command.</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <a href="#" class="btn btn-sm btn-primary" id="btn-confirm-process">Process</a>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="checkImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">              
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button> 
        <img src="" class="imagepreview" alt="bank_chalan" id="thanks" style="width: 100%;" >
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