@extends('system._layouts.main')

@section('breadcrumbs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('system.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('system.other_customer.index')}}">Customer Management</a></li>
    <li class="breadcrumb-item active" aria-current="page">Customer Details</li>
  </ol>
</nav>
@stop
@section('content')
<div class="row">
  <div class="col-md-5 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Customer Details</h4>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="input_title">Full Name</label>
              <input type="text" class="form-control" id="input_firstname" name="firstname" placeholder="First name" value="{{$other_customer->full_name}}" readonly>
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <label for="input_title">Address</label>
          <input type="text" class="form-control" id="input_address" name="address" placeholder="Address" value="{{$other_customer->address}}" readonly>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="input_title">Email</label>
              <input type="text" class="form-control" id="input_email" name="email" placeholder="Email" value="{{$other_customer->email}}" readonly>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="input_title">Contact Number</label>
              <input type="text" class="form-control" id="input_contact_number" name="contact_number" placeholder="Contact Number" value="{{$other_customer->contact_number}}" readonly>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="input_title">Tin No.</label>
              <input type="text" class="form-control" id="input_tin_no" name="tin_no" placeholder="Tin Number" value="{{$other_customer->tin_no}}" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="input_title">Citizenship</label>
              <input type="text" class="form-control" id="input_citizenship" name="citizenship" placeholder="Citizenship" value="{{$other_customer->citizenship}}" readonly>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="input_title">Gender</label>
               <input type="text" class="form-control" id="input_gender" name="gender" placeholder="gender" value="{{$other_customer->gender}}" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="input_title">Civil Status</label>
              <input type="text" class="form-control" id="input_status" name="status" placeholder="status" value="{{$other_customer->status}}" readonly>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="input_title">Birthday</label>
              <input type="text" class="form-control" id="input_birthday" name="birthday" placeholder="birthday" value="{{$other_customer->birthday}}" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="input_title">Place of Birth</label>
              <input type="text" class="form-control" id="input_place_of_birth" name="place_of_birth" placeholder="place_of_birth" value="{{$other_customer->place_of_birth}}" readonly>
            </div>
          </div>
        </div>
         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="input_title">Height</label>
              <input type="text" class="form-control" id="input_height" name="height" placeholder="height" value="{{$other_customer->gender}}" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="input_title">Weight</label>
              <input type="text" class="form-control" id="input_weight" name="weight" placeholder="weight" value="{{$other_customer->weight}}" readonly>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="input_title">Occupation</label>
          <input type="text" class="form-control" id="input_occupation" name="occupation" placeholder="occupation" value="{{$other_customer->occupation}}" readonly>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-7 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">List of Transaction</h4>
        <span class="float-right mb-2">
          <a href="{{route('system.other_transaction.create',[$other_customer->id])}}?type=violation" class="btn btn-sm btn-primary">Add Violation</a>
          <a href="{{route('system.other_transaction.create',[$other_customer->id])}}?type=ctc" class="btn btn-sm btn-primary">Add CTC</a>
        </span>
        <table class="table table-striped table-responsive">
          <thead>
            <th>Processing Fee Code</th>
            <th>Transaction Type</th>
            <!-- <th>Created By(Processor)</th> -->
            <th>Transaction Status</th>
            <th>Application Status</th>
            <th>Action</th>
          </thead>
          <tbody>
            @forelse($transactions as $transaction)
              <tr>
                <td>{{$transaction->processing_fee_code}}</td>
                <td>{{$transaction->transac_type->name}}</td>
                <!-- <td>{{$transaction->admin ? $transaction->admin->full_name: "--"}}</td> -->
                <th class="text-center">
                  <div>{{$transaction->processing_fee ?: 0 }}</div>
                  <div><small><span class="badge badge-pill badge-{{Helper::status_badge($transaction->payment_status)}} p-2">{{Str::upper($transaction->payment_status)}}</span></small></div>
                  <div><small><span class="badge badge-pill badge-{{Helper::status_badge($transaction->transaction_status)}} p-2 mt-1">{{Str::upper($transaction->transaction_status)}}</span></small></div>
                </th>
                <th class="text-center">
                  <div><small><span class="badge badge-pill badge-{{Helper::status_badge($transaction->status)}} p-2 mt-1">{{Str::upper($transaction->status)}}</span></small></div>
                </th>
                <td >
                  <button type="button" class="btn btn-sm p-0" data-toggle="dropdown" style="background-color: transparent;"> <i class="mdi mdi-dots-horizontal" style="font-size: 30px"></i></button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuSplitButton2">
                    <a class="dropdown-item" href="{{route('system.other_transaction.show',[$transaction->id])}}">View transaction</a>
                    <a class="dropdown-item" href="{{route('system.other_transaction.edit',[$transaction->id])}}?type={{$transaction->type}}">Edit transaction</a>
                   <!--  <a class="dropdown-item action-delete"  data-url="#" data-toggle="modal" data-target="#confirm-delete">Remove Record</a> -->
                  </div>
                </td>
              </tr>
            @empty

            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@stop
