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
                        {{-- <a href="{{url('/admin/contents/create')}}"><button class="btn btn-btn-success">Add More</a> --}}
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Page Name</th>
                                <th>Content_id</th>
                                <th>Title</th>
                                <th>Short Description</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $value)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$value->page_name}}</td>
                                <td>{{$value->id}}</td>
                                <td>{{$value->title}}</td>
                                <td>{{$value->short_description}}</td>
                                <td><a href="{{url('/images/pages/'.$value['image'])}}" target="_blank">View Image</a></td>
                                
                                <td><div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                    {{-- <input class="form-check-input" type="checkbox" id="SwitchCheckSizemd{{$value->id}}" @if($value->status==1){{'checked'}} @endif> --}}
                                    
                                    <label class="form-check-label" for="SwitchCheckSizemd{{$value->id}}">@if($value->status==1){{'Active'}}@else {{'Inactive'}} @endif</label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{route('contents.edit',$value->id)}}"><i class="bx bx-pencil"></i> Edit </a>
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