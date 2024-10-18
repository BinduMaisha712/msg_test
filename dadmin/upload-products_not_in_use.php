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
          <h6 class="h6">Product Upload</h6>
        </div>
         
        <!-- Tab Content Start -->
        <div class="tab-content">
          <!-- Tab Pane Start -->
          <div class="tab-pane fade show active" id="tab01">
            <div class="panel-content">
              <form action="javascript:void(0)" id="form_import" method="post" enctype="multipart/form-data" name="form">                                
             <div class="form-group row">
                  <span class="label-text col-md-3 col-form-label">Upload Products: *</span>
                  <div class="col-md-9">
                    <input type="file" class="form-control form-control-md excel_file" name="file" required>

                                <p>Download Demo excel file from <a href="products.xlsx" download>Here</a></p>
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


            
             <script>
        $(document).ready(function() {

            $("#form_import").submit(function(e) {                
                $("#sub").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Please Wait...');
                var formData = new FormData(this);
                $.ajax({
                    url: "products-import.php",
                    data: formData,
                    method: "POST",
                    processData: false,
                    contentType: false,
                    success: function(data) {
                       // alert(data);
                        data = $.parseJSON(data);
                        if (data.status > 0) {
                            alert("Product Added Successfully!");
                            setTimeout(
                                function() {
                                    location.reload();
                                }, 2000);
                        } else {
                              alert(data.msg);
                            $('.excel_file').val("");
                            $("#sub").html("Submit");
                        }
                    }

                })
            })
        })
    </script>

<?php include('includes/footer.php');
