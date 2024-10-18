<?php include('includes/header.php'); ?>
<style type="text/css">
  .steps {
    display: none;
  }
</style>

<!-- Main Container Start -->
<main class="main--container">
  <!-- Main Content Start -->
  <section class="main--content">
    <div class="panel">
      <div class="panel-content">
        <!-- Form Wizard Start -->
        <form action="" method="post" id="formWizard" class="form--wizard" enctype="multipart/form-data">
          <h3>Add Slider</h3>
          <section>
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <label>
                    <span class="label-text">Select Category / Sub category: *</span>
                    <select name="subcategory" required="" class="form-control">
                      <option value="">----select category/ sub category------</option>
                      <?php
                      $sql = mysqli_query($conn, "select * from category where status='Active'");
                      while ($row = mysqli_fetch_assoc($sql)) {
                        $sel_query = mysqli_query($conn, "SELECT * FROM `subcategory` WHERE cat_id='" . $row['id'] . "' and status='Active'");
                        if (mysqli_num_rows($sel_query) > 0) {
                          while ($data = mysqli_fetch_array($sel_query)) { ?>
                            <option value="<?php echo "subcat_" . $data['id']; ?>">
                              <?php echo $data['sub_cat_name']; ?></option>
                      <?php
                          }
                        } else {
                          echo '<option value="cat_' . $row['id'] . '">' . $row['cat_name'] . '</option>';
                        }
                      } ?>
                    </select>
                  </label><br>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label>
                    <span class="label-text">Slider Image: *</span>
                    <input type="file" onchange="return check()" id="image" name="slider[]" class="form-control" required>
                  </label>
                  <span class="help-block" id="er">Image Dimension Width Between: 1200px and 1450px,
                    Height Between: 700px and 400px & ( png, jpg ,jpeg )</span>
                  <br><br />
                  <script>
                    function check() {
                      var fileUpload = $("#image")[0];
                      var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.jpeg)$");
                      if (regex.test(fileUpload.value.toLowerCase())) {
                        if (typeof(fileUpload.files) !== "undefined") {
                          //Initiate the FileReader object.
                          var reader = new FileReader();
                          //Read the contents of Image File.
                          reader.readAsDataURL(fileUpload.files[0]);
                          reader.onload = function(e) {
                            //Initiate the JavaScript Image object.
                            var image = new Image();
                            //Set the Base64 string return from FileReader as source.
                            image.src = e.target.result;
                            image.onload = function() {
                              //Determine the Height and Width.
                              var height = this.height;
                              var width = this.width;
                              console.log(height);
                              console.log(width);
                              if ((height < 400 || height > 700) && (width < 1200 || width > 1450)) {
                                document.getElementById('er').innerHTML =
                                  '<font color="red">Height must be Between: 700px and 400px and Width must be Between: 1200px and 1450px.</font>';
                                document.getElementById('sub').disabled = true;
                              } else {
                                document.getElementById('er').innerHTML =
                                  'Image Dimension Width: ' + width +
                                  ', height: ' + height;
                                document.getElementById('sub').disabled = false;
                              }
                            };
                          };
                        }
                      } else {
                        document.getElementById('er').innerHTML =
                          '<font color="red">Please select a valid Image file.</font>';
                        document.getElementById('sub').disabled = true;
                      }
                    }
                  </script>
                  <label>
                    <input type="checkbox" name="click" class="form-control" style="height: 15px;margin: 0px; width: 3%;">
                    <span class="label-text">Make Slider Clickable</span>
                  </label><br>
                  <label><button class="btn btn-success btn-md" id="sub" name="submit">Submit</button></label>
                </div>
              </div>
            </div>
          </section>
        </form>
        <!-- Form Wizard End -->
        <?php
        if (isset($_POST['submit'])) {
          //                            print_r($_POST);                            print_r($_FILES);
          $slider_name = ($_FILES["slider"]["name"]);
          $slider_type = ($_FILES["slider"]["tmp_name"]);
          $subcategory = $_POST['subcategory'];
          date_default_timezone_set("Asia/kolkata");
          $date = date("Y-m-d");
          $time = date("H:i:s");
          if (isset($_POST['click'])) {
            $click = 'yes';
          } else {
            $click = 'no';
          }

          $i = 0;
          // print_r($_FILES);
          foreach ($slider_name as $key => $value) {
            // $sn = $i++;
            // $mul_img=strtolower($_FILES["slider"]["tmp_name"][$key]);
            // $width=$height=0;
            // $randomNumber = rand(100000, 999999);
            // $imgName = 'Img_' .$randomNumber ."_". $value;
            $sn = $i++;
            $mul_img = $_FILES["slider"]["tmp_name"][$sn];
            $temp = explode(".", $value);
            $newfilename = $temp[0] . round(microtime(true)) . $key . '.' . end($temp);

            move_uploaded_file($mul_img, "../asset/image/banners/" . $newfilename);

            $test = getimagesize('../asset/image/banners/' . $newfilename);
            $width = $test[0];
            $height = $test[1];

            // (height >700 || height <400) || (width > 1450 || width < 1200)

            if ($width > 1450 || $height > 700 || $width < 1200 || $height < 400) {
              echo '<div id="snackbar">Please Check Image Dimensions....</div>';
              echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
              unlink('../asset/image/banners/' . $newfilename);
            } else {
              $query = mysqli_query($conn, "INSERT INTO `slider`(`image`,`subcat_id`,`click`,`date`,`time`) VALUES ('$newfilename','$subcategory','$click','$date','$time')");

              if ($query) {
                echo '<div id="snackbar">New Slider Added Successfully..</div>';
                echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                // echo"var delay = 1000;setTimeout(function(){ window.location = 'slider-view.php'; }, delay);";
                echo "</script>";
              } else {
                echo 'not added';
              }
            }
          }
        }
        ?>

      </div>
    </div>
  </section>
  <!-- Main Content End -->

  <!-- Main Footer Start -->
  <?php include('includes/footer.php'); ?>

  <!-- Main Footer End -->