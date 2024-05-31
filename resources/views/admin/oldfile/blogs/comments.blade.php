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
                                <th>Blog Title</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Comments</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $value)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$value->title}}</td>
                                <td>{{$value->name}}</td>
                                <td><a href="{{url('/images/blogs/'.$value['image'])}}" target="_blank">View Image</a></td>
                                <td><a data-bs-toggle="modal" href="javascript:void(0)" data-bs-target="#comments{{$value->id}}">view Comments @if($value->read_status==0)<i class="fa fa-eye" style="font-size:15px;"></i></i>@endif</a></td>
                                
                                <td>
                                    <form method="post" action="{{route('blogs-comments.destroy',$value->id)}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are You sure')"><i class="bx bx-trash-alt"></i></button>
                                    
                                </form>
                                </td>
                            </tr>
                            {{-- modal section --}}
                                                       
                            <!-- Modal -->
                            <div class="modal fade" id="comments{{$value->id}}" tabindex="-1" aria-labelledby="comments{{$value->id}}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="comments{{$value->id}}Label">{{$value->name}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <b><p>Comments</p></b>
                                        {{$value->comments}}
                                    </div>
                                    <hr>
                                    <b><p>Give Answer</p></b>
                                    <form action="{{url('admin/blogs-comments/'.$value->id)}}" method="post">
                                        @method('PUT')
                                        @csrf
                                        <textarea cols="4" rows="3" name="answer">{{$value->answer}}</textarea>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Reply</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                          {{-- modal section end --}}
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



@endpush