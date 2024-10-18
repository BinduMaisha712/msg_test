    <?php include('includes/header.php'); ?>
    <style type="text/css">
      .steps {
        display: none;
      }
    </style>
    <style type="text/css">
      .info {
        background-color: #e7f3fe;
        border-left: 6px solid #2196F3;
        margin-bottom: 15px;
        padding: 4px 12px;

      }
.select2-container .select2-selection--multiple,
span.select2.select2-container.select2-container--default{
    width: 100% !important;
}
      .select2-container--default .select2-search--inline .select2-search__field {
        background: transparent;
        border: none;
        outline: 0;
        box-shadow: none;
        -webkit-appearance: textfield;
        width: 120px !important;
      }

      
    </style>

<?php 
$msg_id = $_GET['id'];
$msDetails = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM contact_form WHERE id = '$msg_id'"));

?>
    <!-- Main Container Start -->
    <main class="main--container">
      <!-- Main Content Start -->
      <section class="main--content">
        <div class="panel">
          <div class="panel-content">

            <!-- Form Wizard Start -->
      
              <h3>MESSAGE</h3>
              
              <section>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>
                        <span class="label-text">USER NAME: *</span>
                        <input type="text" readonly  class="form-control" value="<?= $msDetails['name'];?>" >
                      </label>
                    </div>
                    </div>
                    <div class="col-md-6">
                     <div class="form-group">
                      <label>
                        <span class="label-text">EMAIL: *</span>
                        <input type="text" readonly class="form-control" value="<?= $msDetails['email'];?>" >
                      </label>
                    </div>
                    </div>
                      

                </div>
                 <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>
                        <span class="label-text">PHONE: *</span>
                        <input type="text" readonly class="form-control" value="<?= $msDetails['phone'];?>" >
                      </label>
                    </div>
                    </div>
                    <div class="col-md-6">
                     <div class="form-group">
                      <label>
                        <span class="label-text">SUBJECT: *</span>
                        <input type="text" readonly class="form-control" value="<?= $msDetails['subject'];?>" >
                      </label>
                    </div>
                    </div>
                      

                </div>
                 <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>
                        <span class="label-text">MESSAGE: *</span>
                       
                        <textarea readonly cols="30" class="form-control" rows="10"><?= $msDetails['message'];?></textarea>
                        
                      </label>
                    </div>
                    </div>
                    <div class="col-md-6">
                     <div class="form-group">
                      <label>
                        <span class="label-text">DATE & TIME: *</span>
                        <input type="text" readonly class="form-control" value="<?= $msDetails['datentime'];?>" >
                      </label>
                    </div>
                    </div>
                      

                </div>
              </section>
         
            
          </div>
        </div>
      </section>
      <!-- Main Content End -->

      <!-- Main Footer Start -->
      <?php include('includes/footer.php'); ?>

      <!-- Main Footer End -->