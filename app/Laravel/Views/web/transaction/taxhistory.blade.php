@extends('web._layouts.main')


@section('content')

<!--team section start-->
<section class="px-120 pt-110 pb-80 gray-light-bg">
    <div class="container">
         
         <div class="row flex-row items-center px-4">
            <h5 class="text-title pb-3"><i class="fa fa-file"></i> E<span class="text-title-two"> CTC APPLICATION HISTORY</span></h5>
            <a href="{{route('web.transaction.create')}}?type=ctc" class="custom-btn badge-primary-2 text-white " style="float: right;margin-left: auto;">Community Tax Certificate</a>
         </div>
          
        <div class="card table-responsive">
        <table class="table table-striped table-font ">
            <thead>
              <tr class="text-center">
                <th class="text-title fs-15 fs-500 p-3">FUll Name</th>
                <th class="text-title fs-15 fs-500 p-3">Application Type</th>
                <th class="text-title fs-15 fs-500 p-3 ">Amount</th>
                <th class="text-title fs-15 fs-500 p-3">Status</th>
                <th class="text-title fs-15 fs-500 p-3">Date</th>
              </tr>
            </thead>
            <tbody>
              @forelse($tax_transactions as $tax_transaction)
              <tr class="text-center">
                <td>{{$tax_transaction->customer->full_name}}</th>
                <td>{{$tax_transaction->transac_type->name}}<br><a href="{{route('web.transaction.show',[$tax_transaction->id])}}">{{$tax_transaction->processing_fee_code}}</a></th>
                <td style="text-align: center;">
                  <div>{{$tax_transaction->amount ?: 0 }}</div>
                  <div>
                    <small><span class="badge badge-pill badge-{{Helper::status_badge($tax_transaction->payment_status)}} p-2">{{Str::upper($tax_transaction->payment_status)}}</span></small>
                  </div>
                  <div class="mt-3">
                    <small><span class="badge badge-pill badge-{{Helper::status_badge($tax_transaction->transaction_status)}} p-2 pt-2">{{Str::upper($tax_transaction->transaction_status)}}</span></small>
                  </div>
                </td>
                <td style="vertical-align: middle;">
                  <div>
                    <span class="badge badge-pill badge-{{Helper::status_badge($tax_transaction->status)}} p-2">{{Str::upper($tax_transaction->status)}}</span>
                  </div>
                </td>
                <td>{{Helper::date_format($tax_transaction->created_at)}}</td>
              </tr>
              @empty
              <tr>
               <td colspan="5" class="text-center"><i>No transaction Records Available.</i></td>
              </tr>
              @endforelse
              
            </tbody>
        </table>
        </div>
        
    </div>

</section>
<!--team section end-->


@stop
@section('page-styles')
<style type="text/css">
    .custom-btn{
        padding: 5px 10px;
        border-radius: 10px;
        height: 37px;
    }
    .custom-btn:hover{
        background-color: #7093DC !important;
        color: #fff !important;
    }
    .btn-status{
        text-align: center;
        border-radius: 10px;
    }
    .table-font th{
        font-size: 16px;
        font-weight: bold;
    }
    .table-font td{
        font-size: 13px;
        font-weight: bold;
    }
</style>
@endsection
