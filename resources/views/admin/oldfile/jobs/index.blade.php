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
                                <th>Post Name</th>
                                <th>Experience </th>
                                <th>Total Vacancy</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $value)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$value->postion}}</td>
                                <td>{{$value->experience}}</td>
                                <td>{{$value->vaccancy}}</td>
                                <td>
                                    <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                    <label class="form-check-label" for="SwitchCheckSizemd{{$value->id}}">@if($value->status==1){{'Active'}}@else {{'Inactive'}} @endif</label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{route('jobs.edit',$value->id)}}"><i class="bx bx-pencil"></i> Edit </a> | <span>
                                        <form method="post" action="{{route('jobs.destroy',$value->id)}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are You sure')"><i class="bx bx-trash-alt"></i></button>
                                    
                                </form>
                                </span>
                                </td>
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$datas->links('vendor.pagination.simple-bootstrap-4')}}
                
            </div>
        </div>
    </div>
</div>
@endsection

@push('footer-section-code')

<script>
    function deleteblogs(tid){
        if(confirm('Are You sure'))
        {
        $.ajax({
            method:'DELETE',
            url: '{{ url('admin/blogs/') }}/'+tid,
            data:{
                id: tid,
                _token: '{{ csrf_token() }}'
            },
            success:function(response){
                
                if(response.success)
                {
                    location.reload();
                    swal("Deleted!", "Data Deleted Successfully!", "error");
                    //"{{ url('') }}/admin/blogs/"
                    //$('#success').html(response['message']);

                }
                
            }
        });
    }
}
    </script>


@endpush