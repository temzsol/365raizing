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
        <div class="card">
            <div class="card-body">
                @if(isset($blog))
                <form action="save_data.php" method="POST" enctype="multipart/form-data">
                
                    @method('PUT')
                @else
                <form action="save_data.php" method="POST" enctype="multipart/form-data">
                @endif
                @csrf
               
                    <div class="card-body card-block">

                      <div class="form-group">
                          <label for="brand" class=" form-control-label">Brand</label>
                          <select name="brand" id="brand" class="form-control-sm form-control" onchange="employee_fetch(this.value)" required>
                              <option value="#">Please select Brand first</option>
                              <?php

                                  $sql = "SELECT id, bname FROM brand";
                                  $result= mysqli_query($obj->run, $sql);
                                  while($row=mysqli_fetch_array($result))
                                  { ?>
                                      <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                             <?php }
                              ?>
                          </select>
                      </div>

                      <div class="form-group">
                          <label class="form-control-label">Task Title</label>
                          <input type="text" id="t_title" class="form-control" name="t_title" required>
                      </div>

                      <!--<div class="form-group">
                          <label for="deadline" class="form-control-label">Deadline</label>
                          <input type="date" id="deadline" class="form-control" name="d_deadline" required>
                      </div>-->

                      <div class="form-group">
                          <label>Upload task related documents/images (if any)</label>
                          <input type="file" name="t_file" multiple="multiple" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="tdetail" class="form-control-label">Task Detail</label>
                          <textarea name="tdetail" id="tdetail" rows="5" placeholder="Detail..." class="form-control"></textarea>
                      </div>
                      <div class="form-group">
                          <input type="submit" name="mtask_submit" value="Submit" class="form-control btn btn-primary" style="margin-top: 15px; border-radius: 6px; width: 130px;"/>
                      </div>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
</div>

@endsection

@push('footer-section-code')
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $('#summernote').summernote({
      placeholder: 'Hello stand alone ui',
      tabsize: 2,
      height: 120,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });
  </script>
  
<script>
    var id = $('#gid').val();
    if(id!='' && id!= null)
    {
        $('#image_upload').hide();
    }
    else{

        $('#image_upload').show();
    }

function hideimage(){
    $('#image_upload').show();
    $('#image_hide').hide();
}
    </script>




<script>
    $("#form-validation").validate({
            rules:{
                title:{
                    required: true,
                    maxlength: 255
                },
                written_by:{
                    required: true,
                    maxlength: 255
                },
                
                description:{
                    required:true,
                    minlength:255
                }

            },
            message:{
                title:{
                    required:"Please Enter title Name",
                    maxlength:"Text not morethen 50"
                },
                written_by:{
                    required:" Please Enter Writter Name",
                    maxlength:"Text not morethen 20"
                },
               
                description:{
                    required:"Please Add Description",
                    maxlength:"Text Minimum 255"
                }
            }   
        });



    function addtags(){
        var index_value=$('#tags-0').attr('findindex');
        index_value=parseInt(index_value)+1;

        var append_section ='<div class="mb-3 row repet_section_row">';
                       append_section +='<label for="example-search-input" class="col-md-2 col-form-label"></label>';
                        append_section +='<div class="col-md-5" >';
                            append_section +='<input class="form-control" type="text" findindex="'+index_value+'" id="tags-'+index_value+'" name="tags[]"><br>';
                        append_section +='</div>';
                        append_section +='<div class="col-md-5" >';
                            append_section +='<button class="btn btn-danger remove" type="button">Remove</button>';
                        append_section +='</div>';
                        append_section +='</div>';
                         $('.repet_section').append(append_section);
                     }
        $(document).on('click','.remove', function(){
        $(this).parents('.repet_section_row').remove();
        });
    </script>

@endpush

