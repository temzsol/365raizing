@extends('layouts.admin_layout')
@section('body')
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Giftcards Generated</h3>
                   
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Dashboard
                        </li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            {{-- <a href="{{route('medspa-gift.create')}}" class="btn btn-primary">Add More</a>
            <div class="card-header">
                @if(session()->has('error'))
                    {{ session()->get('error') }}
                @endif
                @if(session()->has('success'))
                    {{ session()->get('success') }}
                @endif
            </div> --}}
            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Reciver Name</th>
                    <th>Received From</th>
                    <th>Message</th>
                    <th>Sender's Email</th>
                    <th>Coupon Code</th>
                    <th>Amount</th>
                    <th>Discound</th>
                    <th>Paid Amount</th>
                    <th>Payment Status</th>
                    <th>Transaction Id</th>
                    <th>Generated Time</th>
                    <th>Gift Card Number</th>
                                  </tr>
                </thead>
                 <tbody>
                    @foreach($data as $key => $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $value['recipient_name'] ? $value['recipient_name']:$value['your_name'] }}</td>
                        <td>{{ $value['recipient_name'] ? $value['your_name']:'Self' }}</td>
                        <td>{{ $value['recipient_name'] ? $value['message']:'NULL' }}</td>
                        <td>{{ $value['recipient_name'] ? $value['receipt_email']:'Medspa' }}</td>
                        <td>{{$value['coupon_code'] ? $value['coupon_code']:'----' }}</td>
                        <td>{{ $value['amount'] ?   '$'.$value['amount']:'$ 0' }}</td>
                        <td>{{ $value['discount'] ?   '$'.$value['discount']:'$ 0' }}</td>
                        <td>{{ $value['transaction_amount'] ?   '$'.$value['transaction_amount']:'$ 0' }}</td>
                        
                        <td>
                            @if($value['payment_status']=='succeeded')
                            <span class="badge text-bg-success">{{ucFirst($value['payment_status'])}}</span>
                        @elseif($value['payment_status']=='processing')
                            <span class="badge text-bg-primary">{{ucFirst($value['payment_status'])}}</span>
                        @elseif($value['payment_status']=='amount_capturable_updated')
                            <span class="badge text-bg-warning">{{ucFirst($value['payment_status'])}}</span>
                        @elseif($value['payment_status']=='payment_failed')
                            <span class="badge text-bg-danger">{{ucFirst($value['payment_status'])}}</span>
                        @else
                            <span class="badge text-bg-danger">Incompleted</span>
                        @endif                        
                           </td>
                        <td>{{ $value['transaction_id']}}</td>
                        
                        <td>{{ $value['created_at']  }}</td>
                        <td><a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{$value['id']}}" onclick="cardview({{$value['id']}},'{{$value['transaction_id'] }}')">
                            View Card
                        </a></td>
                        
                        <!-- Button trigger modal -->

  

                       
                    </tr>
                @endforeach
                
                
                </tbody>
            </table>
            <!--end::Row-->               
                <!-- /.Start col -->
            </div>
            <!-- /.row (main row) -->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>


  <!-- Modal -->
  <div class="modal fade deepak" id="staticBackdrop_" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Gift Card Number</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         <h2 id="giftcardsshow"></h2>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  @endsection

  @push('script')
      
<script>

function cardview(id,tid) {
    $('.deepak').attr('id', 'staticBackdrop_' + id);
    $('#staticBackdrop_' + id).modal('show');

    $.ajax({
        url: '{{ route('cardview-route') }}',
        method: "post",
        dataType: "json",
        data: {
            _token: '{{ csrf_token() }}',
            tid: tid,
            user_token: '{{Auth::user()->user_token }}',
        },
        success: function(response) {
            if (response.success) {
                $('#giftcardsshow').empty();
                $.each(response.result, function(index, element) {
                // Create a new element with the giftnumber
                var newElement = $('<div>').html(element.giftnumber);
                
                // Append the new element to #giftcardsshow
                $('#giftcardsshow').append(newElement);
            });
              
            }
        }
    });
}




    </script>
    
  @endpush
