<!DOCTYPE html>
<html>
<head>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
</head>
<body>
     
<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
            Form Submit Test
        </div>
        <div class="card-body">
  
            <table class="table table-bordered mt-3">
                <tr>
                    <th colspan="3">
                        List Of Datas
                        <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#careerModal">
                          Create New
                        </button>
                    </th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Contact No</th>
                </tr>
                @foreach($career_data as $c_data)
                <tr>
                    <td>{{ $c_data->id }}</td>
                    <td>{{ $c_data->name }}</td>
                    <td>{{ $c_data->contact_no }}</td>
                </tr>
                @endforeach
            </table>
  
        </div>
    </div>
</div>
  
<!-- Modal -->
<div class="modal fade" id="careerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- <form > -->
        <form action="{{ route('careers.store') }}" method="POST" id="form_submit" enctype="multipart/form-data">
            @csrf
  
            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>
    
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
            </div>
  
            <div class="mb-3">
                <label for="contact_no" class="form-label">Contact No:</label>
                <input type="text" id="contact_no" name="contact_no" class="form-control" placeholder="Contact No" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Email" required>
            </div>

            <div class="mb-3">
                <label for="experience" class="form-label">Experience:</label>
                <input type="text" id="experience" name="experience" class="form-control" placeholder="Experience" required>
            </div>

            <div class="mb-3">
                <label for="skill_sets" class="form-label">Skill Sets:</label>
                <input type="text" id="skill_sets" name="skill_sets" class="form-control" placeholder="Skill Sets" required>
            </div>
            <div class="mb-3">
                <label for="current_organization" class="form-label">current organization:</label>
                <input type="text" id="current_organization" name="current_organization" class="form-control" placeholder="current organization" required>
            </div>
            <div class="mb-3">
                <label for="remarks" class="form-label">Remarks:</label>
                <input type="text" id="remarks" name="remarks" class="form-control" placeholder="Remarks" required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="resume">Resume:</label>
                <input 
                    type="file" 
                    name="resume" 
                    id="inputfile"
                    class="form-control">
                <span class="text-danger" id="file-input-error"></span>
            </div>
     
            <div class="mb-3 text-center">
                <button class="btn btn-success btn-submit">Submit</button>
            </div>
    
        </form>
      </div>
    </div>
  </div>
</div>
     
</body>
  
<script type="text/javascript">
      
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  
    $('#form_submit').submit(function(e) {
    
        e.preventDefault();
     
        
        let formData = new FormData(this);
           $('#file-input-error').text('');
     
        $.ajax({
           type:'POST',
           url:"{{ route('careers.store') }}",
           data:formData,
           contentType: false,
            processData: false,
           success:function(data){
                if($.isEmptyObject(data.error)){
                    alert(data.success);
                    location.reload();
                }else{
                    printErrorMsg(data.error);
                }
           }
        });
    
    });
  
    function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }
  
</script>
  
</html>