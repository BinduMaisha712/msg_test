<?php include('includes/header.php'); 
 // function homeConfig($id){
 //    $result = array();

 //    $query = 'SELECT * FROM home WHERE id='.$id;
 //    $query1 = mysqli_query($conn,$query);
 //    $result = mysqli_fetch_assoc($query1);

 //    return $result['name'];
 //  }

?>
 <style type="text/css">
    
    .info {
  background-color: #e7f3fe;
  border-left: 6px solid #2196F3;
    margin-bottom: 15px;
  padding: 4px 12px;

}

</style>
<main class="main--container">
  <!-- Main Content Start -->
  <section class="main--content">                
    <div class="panel">
      <!-- Edit Product Start -->
      <div class="records--body">
        <div class="title">
          <h6 class="h6">ProductImages Upload</h6>
        </div>
         
        <!-- Tab Content Start -->
        <div class="tab-content">
          <!-- Tab Pane Start -->
          <div class="tab-pane fade show active" id="tab01">
             <div class="error_msg">

                                </div>
                               
            <div class="panel-content">
              <form action="javascript:void(0)" method="post" enctype="multipart/form-data" name="form" id="image_upload_form">                                
                <div class="form-group row">
                  <span class="label-text col-md-3 col-form-label">Select Image: *</span>
                  <div class="col-md-9">
                                    <input type="file" class="form-control form-control-md images_file" name="files[]" required multiple > 
                </div>
              </div>

                      <div class="row mt-3">
                            <div class="col-md-9 offset-md-3">
                              <button class="btn btn-success" name="submit" id="sub">Submit</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- Tab Pane End -->
                  </div>
                  <!-- Tab Content End -->
                </div>
                <!-- Edit Product End -->
              </div>
            </section>


           <?php include('includes/footer.php');
?>
 <script>
        $(document).ready(function() {
             
            $("#image_upload_form").submit(function(e) {

                $("#sub").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Please Wait...');
                var formData = new FormData(this);
                $.ajax({
                    url: "product-images.php",
                    data: formData,
                    method: "POST",
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        data = $.parseJSON(data);
                        $('.error_msg').empty();
                        if (data.status > 0) {
                            $('.error_msg').append('<div class="alert alert-success" role="alert">' + data.msg + '<p>Download URLs sheet from <a href="'+data.sheet+'">Here!</a></p></div>');
                            if(data.no_error>0){
                                $('.error_msg').append('<div class="alert alert-warning" role="alert">Some errors in images. Download error sheet from <a href="errors.xlsx" download>Here!</p></div>');
                            } 
                            $('.images_file').val("");
                            $("#sub").html("Submit");
        
                        } else {
                            $('.error_msg').append('<div class="alert alert-danger" role="alert">' + data.msg + '</div>');
                            $('.images_file').val("");
                            $("#sub").html("Submit");
                        }
                    }

                })
            })
        })
    </script>
