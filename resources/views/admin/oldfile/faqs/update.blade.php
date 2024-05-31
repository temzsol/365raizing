@extends('layouts.masteradmin')
@section('body')
<div class="page-content">
<div class="row">
    <div class="col-12">
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        
        <form method="post" enctype="multipart/form-data" action="{{url('admin/faqs/'.$faq->id)}}" id="validation">
            @method('PUT')
        
        @csrf
            <div class="card">
               
                <center><h2>{{$page_title}}<h2></center>
                         
                <div class="card-body">
                    <div class="faq">
                        <div class="mb-3 row">
                            <label for="question-0" class="col-md-2 col-form-label">Question<span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" findex="1"  name="question" placeholder="Enter Question" id="question-0" required value="{{isset($faq)? $faq->question:''}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="answer-0" class="col-md-2 col-form-label">Answer<span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input class="form-control" type="text"  name="answer" placeholder="Enter Answer" id="answer-0" required value="{{isset($faq)? $faq->answer:''}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label" for="status">Fetured Status</label>
                            <div class="col-md-10">
                                <select class="form-select" name="fetured">
                                    <option @if(isset($page) && $page->fetured=='1') selected="selected" @endif value="1">Show</option>
                                    <option @if(isset($page) && $page->fetured=='0') selected="selected" @endif value="0">Hide</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="append-faq"></div> 
                    <div class="mb-3 row">
                        <label for="example-tel-input" class="col-md-2 col-form-label"></label>
                        <div class="col-md-10">
                           
                            <button type="sumbit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </div>
                
            </div>
        </form>
    </div> <!-- end col -->
</div>
</div>

@endsection

@push('footer-section-code')

    {{--  For appending Section Faq --}}
<script>

        $(document).ready(function(){
        jQuery("#form-validation").validate({
        errorElement:'row',
        rules: {
        // RULES //
        },
        messages: {
        // MESSAGES //
        }
         });
        });
        </script>


@endpush

