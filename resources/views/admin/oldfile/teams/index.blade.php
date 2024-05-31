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
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Member Name</th>
                                <th>Image</th>
                                <th>Designation</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teams as $value)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$value->name}}</td>
                                <td><a href="{{url('/images/teams/'.$value['image'])}}" target="_blank">View Image</a></td>
                                <td>{{$value['designation']}}</td>
                                <td><div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                    {{-- <input class="form-check-input" type="checkbox" id="SwitchCheckSizemd{{$value->id}}" @if($value->status==1){{'checked'}} @endif> --}}
                                    
                                    <label class="form-check-label" for="SwitchCheckSizemd{{$value->id}}">@if($value->status==1){{'Active'}}@else {{'Inactive'}} @endif</label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{route('teams.edit',$value->id)}}"><i class="bx bx-pencil"></i> Edit </a> | <a href="javascript:void(0);"  onClick="deleteteams('{{$value->id}}')" class="text-danger"><i class="bx bx-trash-alt"></i> Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$teams->links('vendor.pagination.simple-bootstrap-4')}}
                
            </div>
        </div>
    </div>
</div>
@endsection

@push('footer-section-code')

<script>
    function deleteteams(tid){
        if(confirm('Are You sure'))
        {
        $.ajax({
            method:'DELETE',
            url: '{{ url('admin/teams/') }}/'+tid,
            data:{
                id: tid,
                _token: '{{ csrf_token() }}'
            },
            success:function(response){
                
                if(response.success)
                {
                    location.reload();
                    swal("Deleted!", "Data Deleted Successfully!", "error");
                    //"{{ url('') }}/admin/teams/"
                    //$('#success').html(response['message']);

                }
                
            }
        });
    }
}
    </script>


@endpush