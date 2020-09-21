@extends('system._layouts.main')

@section('content')
<div class="row p-3">
  <div class="col-12">
    @include('system._components.notifications')
    <div class="row ">
      <div class="col-md-6">
        <h5 class="text-title text-uppercase">{{$page_title}}</h5>
      </div>
      <div class="col-md-6 ">
        <p class="text-dim  float-right">EOR-PHP Processor Portal / Local Customer</p>
      </div>
    </div>
  
  </div>

  <div class="col-12 ">
    <form>
      <div class="row">
        
        <div class="col-md-3 p-2">
          <div class="form-group has-search">
            <span class="fa fa-search form-control-feedback"></span>
            <input type="text" class="form-control form-control-lg" placeholder="Search">
          </div>
        </div>
      </div>
    </form>
  </div>
  <div class="col-md-12">
    <h4 class="pb-4">Record Data
      <span class="float-right">
        <a href="{{route('system.other_transaction.index')}}" class="btn btn-sm btn-primary">View All Local Transactions</a>
        <a href="{{route('system.other_customer.create')}}" class="btn btn-sm btn-primary">Add New</a>
      </span>
    </h4>
    <div class="table-responsive shadow fs-15">
      <table class="table table-striped">
        <thead>
          <tr>
            <th class="text-title fs-15 fs-500 p-3">Full Name</th>
            <th class="text-title fs-15 fs-500 p-3">Address</th>
            <th class="text-title fs-15 fs-500 p-3">Contact Number</th>
            <th class="text-title fs-15 fs-500 p-3">Email</th>
            <th class="text-title fs-15 fs-500 p-3">Created At</th>
          </tr>
        </thead>
        <tbody>
          @forelse($other_customers as $other_customer)
            <th><a href="{{route('system.other_customer.show',[$other_customer->id])}}">{{$other_customer->full_name}}</a></th>
            <th>{{$other_customer->address}}</th>
            <th>{{$other_customer->contact_number}}</th>
            <th>{{$other_customer->email}}</th>
            <th>{{Helper::date_format($other_customer->created_at)}}</th>
          @empty

          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@stop

@section('page-modals')
<div id="confirm-delete" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm your action</h5>
      </div>

      <div class="modal-body">
        <h6 class="text-semibold">Deleting Record...</h6>
        <p>You are about to delete a record, this action can no longer be undone, are you sure you want to proceed?</p>

        <hr>

        <h6 class="text-semibold">What is this message?</h6>
        <p>This dialog appears everytime when the chosen action could hardly affect the system. Usually, it occurs when the system is issued a delete command.</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <a href="#" class="btn btn-sm btn-danger" id="btn-confirm-delete">Delete</a>
      </div>
    </div>
  </div>
</div>
@stop

@section('page-scripts')
<script src="{{asset('system/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript">
  $(function(){
   

    $(".action-delete").on("click",function(){
      var btn = $(this);
      $("#btn-confirm-delete").attr({"href" : btn.data('url')});
    });

  })
</script>
@stop