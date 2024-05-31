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
                    <h3 class="mb-0">Redeem Page</h3>
                   
                </div>
                <div class="sucess"></div>
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
            <form method="get" action="{{ route('giftcard-search') }}">
                <div style="display: flex; flex-direction: row; align-items: center;">
                    <label for="name" style="margin-right: 10px;">Gift Card Holder Name:</label>
                    <input type="text" id="name" name="name" placeholder="Enter Gift Card Holder Name" style="margin-right: 20px;">
            
                    <label for="email" style="margin-right: 10px;">Gift Card Holder Email:</label>
                    <input type="email" id="email" name="email" placeholder="Enter Gift Card Holder Email" style="margin-right: 20px;">
            
                    <label for="giftcardnumber" style="margin-right: 10px;">Gift Card Number:</label>
                    <input type="text" id="giftcardnumber" name="giftcardnumber" placeholder="FEMS-2024-8147" style="margin-right: 20px;">
            
                    <input type="hidden" name="user_token" value="{{ Auth::user()->user_token }}">
            
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
            
            
            
            @isset($getdata)
            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Gift Card Holder Name</th>
                    <th>Gift Card Holder Email </th>
                    <th>Gift Card Number</th>
                    <th>Gift Card Amount</th>
                    {{-- <th>Created Time</th> --}}
                    <th>Action</th>
                                  </tr>
                </thead>
                 <tbody>
                    @foreach($getdata as $key => $value)

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $value['recipient_name'] ? $value['recipient_name']:$value['your_name'] }}</td>
                        <td>{{ $value['gift_send_to'] }}</td>
                        <td>{{ $value['giftnumber'] }}</td>
                        <td>{{ '$'.$value['total_amount'] }}</td>
                        {{-- <td>{{ date('M-d-Y h:i:s', strtotime($value['updated_at'])) }}</td> --}}

                        <td><a type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#redeem_{{$value['user_id']}}" onclick="modalopen({{$value['user_id']}},'{{$value['giftnumber']}}','{{$value['total_amount']}}')">
                           Redeem
                        </a>|<a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Statment_{{$value['user_id']}}" onclick="Statment({{$value['user_id']}},'{{$value['giftnumber']}}')">
                            View Statment
                        </a></td>
                        
                        <!-- Button trigger modal -->

  

                       
                    </tr>
                @endforeach
                
                
                </tbody>
            </table>
            @endif
            <!--end::Row-->               
                <!-- /.Start col -->
            </div>
            <!-- /.row (main row) -->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>


  <!--  Redeem Modal -->
  <div class="modal fade deepak" id="redeem_" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Gift Card Number</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="get" action="{{route('giftcard-search') }}">
                <div style="display: flex; flex-direction: column;">
                    <label for="giftnumber_" style="margin-right: 10px;">Gift Number:</label>
                    <input  class="giftnumber_"type="text" id="giftnumber_" name="giftnumber" value="" style="margin-right: 20px;" readonly>

                    <label for="amount_" style="margin-right: 10px;">Amount:</label>
                    <input  type="number" id="amount_" class="amount_" min="1" max="" name="amount" style="margin-right: 20px;">
            
                    <label for="comments_" style="margin-right: 10px;">Comments</label>
                    <textarea class="form-control comments_" name="comments" id="comments_" style="margin-right: 20px;"></textarea>
            
                    <input type="hidden" class="user_token" name="user_token" value="{{ Auth::user()->user_token }}">
                    <input type="hidden" class="user_id" id="user_id_" name="user_id" value="">
            
                    <button type="button" class="btn btn-primary mt-3 redeembutton" id="" onclick="redeemgiftcard(event)">Redeem</button>
                </div>
            </form>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  {{--  For Statment Mpdal --}}

  <div class="modal fade Statment" id="Statment_" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Gift Card History</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table class="statment_view table table-striped">
               
            </table>
            
            
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
    function Statment(id,giftcardnumber){
    $('.Statment').attr('id', 'Statment_' + id);

    $.ajax({
        url: '{{ route('giftcardstatment') }}',
        method: "post",
        dataType: "json",
        data: {
            _token: '{{ csrf_token() }}',
            gift_card_number: giftcardnumber,
            user_token: '{{Auth::user()->user_token}}',
        },
        success: function(response) {
    console.log(response);
    if(response.status == 200) {
        $('#Statment_' + id).modal('show');

        // Clear the content of the statment_view element
        $('.statment_view').empty();

        // Create the table header
        var tableHeader = `
            <tr>
                <th>Sl No.</th>
                <th>Transaction Number</th>
                <th>Card Number</th>
                <th>Date</th>
                <th>Message</th>
                <th>Amount</th>
            </tr>
        `;
        // Append the table header to statment_view
        $('.statment_view').append(tableHeader);

        // Iterate over each element in the response.result array
        $.each(response.result, function(index, element) {
            // Create a new row for each element
            var newRow = `
                <tr>
                    <td>${index + 1}</td>
                    <td>${element.transaction_id}</td>
                    <td>${element.giftnumber}</td>
                    <td>${element.updated_at}</td>
                    <td>${element.comments}</td>
                    <td>${element.amount}</td>
                </tr>
            `;
            // Append the new row to statment_view
            $('.statment_view').append(newRow);
        });
        var totalamount = `
        <tr><td></td><td></td><td></td><td></td><td colspan="2"><hr></td></tr>
                <tr><td></td><td></td><td></td><td></td>
                    <th>Total Amount</th>
                    <td><b>${response.TotalAmount}</b></td>
                </tr>
            `;
            $('.statment_view').append(totalamount);
    } else {
        $('#Statment_' + id).modal('show');
        $('.statment_view').html(response.error);
    }
}

    });
    }



function modalopen(id,giftcardnumber,amount) {
    $('.deepak').attr('id', 'redeem_' + id);
    $('.user_id').attr('id', 'user_id_' + id);
    $('#user_id_'+id).val(id);

    // for Giftcard value set 
    $('.giftnumber_').attr('id', 'giftnumber_' + id);
    $('#giftnumber_' + id).val(giftcardnumber);

    $('.redeembutton').attr('id', 'redeembutton' + id);
    $('#redeembutton' + id).attr('id',id);
    
    $('.amount_').attr('id', 'amount_' + id);
    $('#amount_'+id).attr('max', amount);
    $('.comments_').attr('id', 'comments_' + id);
    // for Giftcard value set
    $('#redeem_' + id).modal('show');
}
function redeemgiftcard(event) {
    var id = event.target.id;
    var amountInput = $('#amount_' + id);
    var enteredAmount = amountInput.val();
    var isValid = true;

    // Check if the entered amount is a valid number and within the specified range
    if (isNaN(enteredAmount) || enteredAmount < parseInt(amountInput.attr('min')) || enteredAmount > parseInt(amountInput.attr('max'))) {
        amountInput.addClass('is-invalid'); // Add Bootstrap's 'is-invalid' class for styling
        alert('Please Check Input Amount');
        isValid = false;
    } else {
        amountInput.removeClass('is-invalid'); // Remove 'is-invalid' class if the input is valid
    }

    // Proceed with AJAX request only if input is valid
    if (isValid) {
        $.ajax({
            url: '{{ route('giftcardredeem') }}',
            method: "post",
            dataType: "json",
            data: {
                _token: '{{ csrf_token() }}',
                amount: enteredAmount,
                gift_card_number: $('#giftnumber_' + id).val(),
                comments: $('#comments_' + id).val(),
                user_token: '{{ Auth::user()->user_token }}',
                user_id: $('#user_id_' + id).val(),
            },
            success: function(response) {
                console.log(response.success);
                if (response.success) {
                    $("#redeem_" + id).hide();
                    $('.sucess').empty();
                    $('.sucess').html('<h2 class="text-success">' + response.success + '</h2>');
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                } else {
                    $('.sucess').empty();
                    $('.sucess').html('<h2 class="text-error">' + response.error + '</h2>');
                }
            }
        });
    }
}





    </script>
    
  @endpush
