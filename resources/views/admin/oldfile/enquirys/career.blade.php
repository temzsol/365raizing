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
                                <th>Job Position</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>DOB</th>
                                <th>Exprience</th>
                                <th>Qualification</th>
                                <th>Role</th>
                                <th>Current Salary</th>
                                <th>Expected Salary</th>
                                <th>Message</th>
                                <th>Attachment</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$value->job_position}}</td>
                                <td>{{$value->name}}</td>
                                <td>{{$value->email}}</td>
                                <td>{{$value->phone}}</td>
                                <td>{{$value->dob}}</td>
                                <td>{{$value->exprience}}</td>
                                <td>{{$value->qualification}}</td>
                                <td>{{$value->role}}</td>
                                <td>{{$value->current_salary}}</td>
                                <td>{{$value->expected_salary}}</td>
                                <td>{{$value->message}}</td>
                                <td>{{$value->attachment}}</td>
                                <td>{{date('d-M-Y',strtotime($value->created_at))}}</td>
                                <td>
                                   <a href="{{url('admin/career/'.$value->id)}}" class="text-danger"><i class="bx bx-trash-alt"></i> Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$data->links('vendor.pagination.simple-bootstrap-4')}}
                
            </div>
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
            url: '{{ url('admin/career/') }}/'+tid,
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