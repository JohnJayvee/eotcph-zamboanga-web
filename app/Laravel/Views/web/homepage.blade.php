@extends('web._layouts.main')


@section('content')



<!--team section start-->
<section class="team-section ptb-120 home-bg ">
    <div class="container">
        @include('web._components.notifications')
        <div class="row ">
            <div class="col-md-4 col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <h5 style="letter-spacing: 3px;"><i class="fa fa-file"></i> E<span class="font-weight-lighter">SUBMISSION</span></h5>
                    </div>
                     <div class="col-lg-12">
                        <a href="#" data-url="{{route('web.transaction.create')}}" class="btn btn-white btn-submission"> <i class="fa fa-laptop"></i> Submit</a>
                    </div>
                    <div class="col-lg-12 pt-4">
                        <h5 style="letter-spacing: 3px;"><i class="fa fa-calculator"></i> E<span class="font-weight-lighter">PAYMENT</span></h5>
                    </div>
                     <form method="GET" action={{ route('web.transaction.payment') }}>
                        <div class="col-lg-12 pt-2">
                           <input type="text" name="code" class="form-control input-transparent" placeholder="Enter Transaction Code">
                        </div>
                        <div class="col-lg-12 pt-4">
                           <button class="btn btn-white" type="submit"><i class="fa fa-money-bill"></i> Pay</button> 
                        </div>
                    </form>
                    <div class="col-lg-12 pt-4">
                        <h5 style="letter-spacing: 3px;"><i class="fa fa-th-large"></i> REQUEST<span class="font-weight-lighter"> EOR</span></h5>
                    </div>
                    <div class="col-lg-12 pt-2">
                       <input type="" name="" class="form-control input-transparent" placeholder="Enter Transaction Code">
                    </div>
                    <div class="col-lg-12 pt-2">
                       <input type="" name="" class="form-control input-transparent" placeholder="Enter Email Address">
                    </div>
                    <div class="col-lg-12 pt-4">
                        <a href="" class="btn btn-white"> <i class="fa fa-file"></i> Request</a>
                    </div>
                </div>
            </div>
           
        </div>
        
    </div>

</section>
<!--team section end-->



@stop
@section('page-styles')
<link rel="stylesheet" href="{{asset('system/vendors/sweet-alert2/sweetalert2.min.css')}}">
<style type="text/css">
    .input-transparent{
        color:#fff;
    }
    
</style>
@endsection
@section('page-scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{asset('system/vendors/sweet-alert2/sweetalert2.min.js')}}"></script>
    <script type="text/javascript">

    $(".btn-submission").on('click', function(){
        var url = $(this).data('url');
        var self = $(this);

        (async () => {

        const {value: type} = await Swal.fire({
            title: 'Please choose a transaction',
            text: 'Are you applying for?',
            input: 'select',
            inputOptions: {
                'e_submission': 'E-Submissions',
                'ctc': 'Community Tax Certificate'
            },
            inputPlaceholder: 'Select Type',
            showCancelButton: true,
          
        })
        if (type) {
            window.location.href = url + "?type="+type;
        }
        })()
                            
    });
      
    </script>
@stop
