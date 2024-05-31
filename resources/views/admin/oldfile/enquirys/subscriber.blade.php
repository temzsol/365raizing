@extends('layouts.masteradmin')
@section('body')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Responsive Table</h4>
                <p class="card-title-desc">
                    Create responsive tables by wrapping any <code>.table</code> in <code>.table-responsive</code>
                    to make them scroll horizontally on small devices (under 768px).
                </p>
                
                <div class="table-responsive">
                    
                    {{$page_title}}
                    @if(session('message')) <p style="color:rgb(6, 82, 6); font-weight: 600;">{{session('message')}}</p>@endif
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Set NewsLetter Template
                        </button>
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Created Date</th>
                                <th>Updated Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>@if(!empty($value['name'])){{$value['name']}}@endif</td>
                                <td>{{$value['email']}}</td>
                                <td>@if(!empty($value['mobile'])){{$value['mobile']}}@endif</td>
                                <td>{{date('d-M-Y h:i:s',strtotime($value['created_at']))}}</td>
                                <td>{{date('d-M-Y h:i:s',strtotime($value['updated_at']))}}</td>
                                <td>
                                   <a href="{{url('/admin/subscribers/'.$value['id'])}})" class="text-danger"><i class="bx bx-trash-alt"></i> Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                
            </div>
        </div>
    </div>
</div>

{{-- Modal Section --}}
<!-- Button trigger modal -->
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Set Newsletter</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="post" action="{{url('/admin/newsletters-send')}}">
            @csrf
        <div class="modal-body">
            <label for="id">Enter id of Newsletter<span class="text-danger">*</span></label>
            <input type="text" name="id" class="form-control" required autocomplete="off">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>  
      </div>
    </div>
  </div>
@endsection

@push('footer-section-code')

<script>
    function deletepages(tid){
        if(confirm('Are You sure'))
        {
        $.ajax({
            method:'DELETE',
            url: '{{ url('admin/subscribers/') }}/'+tid,
            data:{
                id: tid,
                _token: '{{ csrf_token() }}'
            },
            success:function(response){
                
                if(response.success)
                {
                    location.reload();
                    swal("Deleted!", "Data Deleted Successfully!", "error");
                    //"{{ url('') }}/admin/pages/"
                    //$('#success').html(response['message']);

                }
                
            }
        });
    }
}
    </script>


@endpush