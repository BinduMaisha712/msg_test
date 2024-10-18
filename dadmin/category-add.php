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
      span.select2.select2-container.select2-container--default {
        width: 100% !important;
      }

      .select2-container--default .select2-search--inline .select2-search__field {
        background: transparent;
        border: none;
        outline: 0;
        box-shadow: none;
        /* -webkit-appearance: textfield; */
        width: 120px !important;
      }
    </style>

    <!-- Main Container Start -->
    <main class="main--container">
      <!-- Main Content Start -->
      <section class="main--content">
        <div class="panel">
          <div class="panel-content">

            <!-- Form Wizard Start -->
            <form action="category-add.php" method="post" id="formWizard" class="form--wizard" enctype="multipart/form-data">
              <h3>ADD CATEGORY</h3>
              <div class="info">
                <p><strong>Info!</strong> You can create multiple subcategories with classtype ; If you cannot create subacategory then select classtype which you bind in the category..You can bind upto 3 classtype in a category or subcategory If you cannot add any classtype on category or subcategory then select other classtype</p>
              </div>
              <section>
                <div class="row">

                  <div class="col-md-12">

                    <div class="form-group">
                      <label>
                        <span class="label-text">CATEGORY NAME: *</span>
                        <input type="text" name="cat_name" placeholder="Enter Category Name.." class="form-control" value="<?php if (isset($_POST['cat_name'])) {
                                                                                                                              echo $_POST['cat_name'];
                                                                                                                            } ?>" required>
                      </label>
                    </div>


                    <div class="form-group">
                      <label>
                        <span class="label-text">CATEGORY ICON: </span>
                        <input type="file" name="image" class="form-control" id="image" onchange="check()" value="">
                      </label>
                      <span class="help-block" id="er">Image Dimensions 200*200 & (png, jpg ,jpeg)</span><br><br>

                    </div>
                    <div class="form-group">
                      <label>
                        <span class="label-text">WILL HAVE SUBCATEGORIES : *</span>


                        <div class="col-md-9">

                          <input type="radio" name="isSubcategory" class="" id="isSubcategory1" value="Yes" onclick="getSubcategory();" required="required"> Yes
                          <input type="radio" name="isSubcategory" class="" id="isSubcategory2" value="No" onclick="getClassType();"> No

                          <!-- <div id="metaList"></div> -->



                        </div>
                      </label>
                    </div>
                    <div class="isCategoryHtmlNo" style="display:none;">
                      <div class="form-group"><span class="label-text">SELECT CLASS TYPE: *</span>
                        <div class="field_wrapper form-group">
                          <div class="input-group">
                            <select name="classtype1[]" id="classtypeCat" class="js-example-basic-multiple" multiple required><?php $sel_query = mysqli_query($conn, "SELECT * FROM `classtype` WHERE status='Active'");
                                                                                                                              while ($data = mysqli_fetch_assoc($sel_query)) { ?><option value="<?php echo $data['id']; ?>"> <?php echo $data['name']; ?></option><?php } ?></select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="isCategoryHtmlYes" style="display:none;">
                      <div class="card card-outline-danger p-2" id="div_0">
                        <div class="form-group">
                          <label>
                            <span class="label-text">SUBCATEGORY NAME:</span>
                            <div class="field_wrapper form-group">
                              <div class="input-group">
                                <input type="text" name="sub_cat_name[]" value="<?php if (isset($_POST['sub_cat_name']['0'])) {
                                                                                  echo $_POST['sub_cat_name']['0'];
                                                                                } ?>" class="form-control" />
                                <div class="input-group-append"><a href="javascript:void(0);" class="add_button" title="Add field">
                                </div>
                                <br>

                              </div>
                            </div>
                            <div class="form-group"><span class="label-text">SELECT CLASS TYPE: *</span>
                              <div class="field_wrapper form-group">
                                <div class="input-group">
                                  <select name="classtype[0][]" id="classtype0" multiple class="js-example-basic-multiple classtypesubCat" required><?php $sel_query = mysqli_query($conn, "SELECT * FROM `classtype` WHERE status='Active'");
                                                                                                                                                              while ($data = mysqli_fetch_assoc($sel_query)) { ?>
                                      <option value="<?php echo $data['id']; ?>"> <?php echo $data['name']; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                        </div>
                      </div>
                      <!-- Add Color -->
                      <div class="row pt-2">
                        <div class="col-12 text-right"> <a href="javascript:void(0);" class="add" title="Add" onclick="getSubWithClassType();">&emsp;<span class="btn btn-success">ADD</span></a></div>
                      </div>
                    </div>

                    <label><button type="submit" class="btn btn-success btn-md" id="sub" name="submit">Submit</button></label>

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
                                if (height > 200 || width > 200) {
                                  document.getElementById('er').innerHTML = '<font color="red">Height and Width must be 200px.</font>';
                                  document.getElementById('sub').disabled = true;
                                } else if (height < 200 || width < 200) {
                                  document.getElementById('er').innerHTML = '<font color="red">Height and Width must be 200px.</font>';
                                  document.getElementById('sub').disabled = true;
                                } else {
                                  document.getElementById('er').innerHTML = 'Image Dimensions 200*200';
                                  document.getElementById('sub').disabled = false;
                                }I
                              };
                            }
                          }
                        } else {
                          document.getElementById('er').innerHTML = '<font color="red">Please select a valid Image file.</font>';
                          document.getElementById('sub').disabled = true;
                        }
                      }

                      function getClassType() {
                        $('.isCategoryHtmlNo').css('display', 'block');
                        $('.isCategoryHtmlYes').css('display', 'none');
                      }

                      function getSubcategory() {
                        $('.isCategoryHtmlYes').css('display', 'block');
                        $('.isCategoryHtmlNo').css('display', 'none');

                      }

                      function getSubWithClassType() {
                        // Finding total number of elements added
                        var total_element = $(".card").length;

                        // last <div> with element class id
                        var lastid = $(".card:last").attr("id");
                        var split_id = lastid.split("_");
                        var nextindex = Number(split_id[1]) + 1;

                        var max = 10;
                        // Check total number elements
                        if (total_element < max) {
                          // Adding new div container after last occurance of element class
                          $(".card:last").after('<div class="card card-outline-danger p-2" id="div_' + nextindex + '"> <span class="text-right clickable close-icon removeColorDiv p-2" id="remove_' + nextindex + '" title="Remove" onclick="remove(this.id);" ><i class="fa fa-times"></i></span><div class="form-group"><label><span class="label-text">SUBCATEGORY NAME:</span><div class="field_wrapper  form-group"><div class="input-group"><input type="text" name="sub_cat_name[]" value="" class="form-control"/><div class="input-group-append"><a href="javascript:void(0);" class="add_button" title="Add field"></div><br></div></div><div class="form-group"><span class="label-text">SELECT CLASS TYPE: *</span><div class="field_wrapper form-group"><div class="input-group"><select  name="classtype[' + nextindex + '][]" id="classtype' + nextindex + '" class="js-example-basic-multiple classtypesubCat" multiple required><?php $sel_query = mysqli_query($conn, "SELECT * FROM `classtype` WHERE status='Active'");
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  while ($data = mysqli_fetch_assoc($sel_query)) { ?><option value="<?php echo $data['id']; ?>" > <?php echo $data['name']; ?></option><?php } ?></select></div></div></div></div></div>');

                          // Adding element to <div>
                          //$("#div_" + nextindex).append("<input type='text' placeholder='Enter your skill' id='txt_"+ nextindex +"'>&nbsp;<span id='remove_" + nextindex + "' class='remove'>X</span>");

                        }
                        $(".js-example-basic-multiple").select2({
                          maximumSelectionLength: 10,
                          placeholder: 'Select Class Type'
                        });
                      }

                      function remove(id) {
                        var split_id = id.split("_");
                        var deleteindex = split_id[1];

                        // Remove <div> with id
                        $("#div_" + deleteindex).remove();
                      }
                    </script>

                  </div>
                </div>
              </section>
            </form>
            <!-- Form Wizard End -->
            <?php
            //  echo "<pre>";
            // print_r($_POST);                            
            // print_r($_FILES); 
            if (isset($_POST['submit'])) {

              //   $cat_gst = $_POST['cat_gst'];
              $cat_gst = '';
              $cat_name = addslashes($_POST['cat_name']);
              $isSubcategory = $_POST['isSubcategory'];
              $sel_query = mysqli_query($conn, "SELECT * FROM `category` WHERE cat_name='$cat_name' AND trash='No'");
              if (mysqli_num_rows($sel_query) > 0) {
                //echo "<script>";
                echo '<div id="snackbar">This Category is already added..</div>';
                echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
              } else {

                if (isset($_FILES['image'])){
                  $file_name = $_FILES['image']['name'];
                  if (!empty($file_name)) {
                    $file_size = $_FILES['image']['size'];
                    $file_tmp = $_FILES['image']['tmp_name'];
                    $file_type = $_FILES['image']['type'];
                    // print_r($_FILES);die;
                    if (move_uploaded_file($file_tmp, "../asset/image/category/" . $file_name)) {
                      date_default_timezone_set("Asia/kolkata");
                      $date = date("Y-m-d");
                      $time = date("H:i:s");
                      if ($isSubcategory == 'Yes') {

                        $query = mysqli_query($conn, "INSERT INTO `category`(`classtype_id`,`cat_name`,`cat_image`,`date`,`time`,`isSubcategory`) VALUES ('[]','$cat_name','$file_name','$date','$time','$isSubcategory')");
                      } else {
                        $categoryQuery = "";
                        $categoryQuery = "INSERT INTO `category`(`classtype_id`,`cat_name`,`cat_image`,`date`,`time`,`isSubcategory`) VALUES";

                        $classtypeIds = json_encode($_POST['classtype1']);

                         $categoryQuery .= "('" . $classtypeIds . "','" . $cat_name . "','" . $file_name . "','" . $date . "','" . $time . "','" . $isSubcategory . "')";
                        $query = mysqli_query($conn, $categoryQuery);
                      }
                      if ($query) {
                        $lastid = mysqli_insert_id($conn);

                        if ($isSubcategory == 'Yes') {
                          $subcategoryQuery = "";
                          $subcategoryQuery = "INSERT INTO `subcategory`(`classtype_id`,`cat_id`, `sub_cat_name`,`date`,`time`) VALUES";

                          foreach ($_POST['sub_cat_name'] as $key => $value) {
                            $classtypeIds = json_encode($_POST['classtype'][$key]);

                            $subcategoryQuery .= "('" . $classtypeIds . "','" . $lastid . "','" . addslashes($value) . "','" . $date . "','" . $time . "'),";
                          }
                          $subcategoryQuery = rtrim($subcategoryQuery, ',');
                          $query1 = mysqli_query($conn, $subcategoryQuery);
                        }

                        echo '<div id="snackbar">Category add successfully..</div>';
                        echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                        echo "var delay = 1000;setTimeout(function(){ window.location = 'cat-edit.php?eid=" . $lastid . "'; }, delay);";
                        echo "</script>";
                      } else {
                        echo '<div id="snackbar">Your Category Not Added..</div>';
                        echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
                      }
                    } else {
                      echo '<div id="snackbar">Image Not Uploaded..</div>';
                      echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
                    }
                  } else {
                    date_default_timezone_set("Asia/kolkata");
                    $date = date("Y-m-d");
                    $time = date("H:i:s");
                    if ($isSubcategory == 'No') {
                      $classtypeIds = json_encode($_POST['classtype1']);
                      $query = mysqli_query($conn, "INSERT INTO `category`(`classtype_id`,`cat_name`,`date`,`time`,`isSubcategory`) VALUES ('" . $classtypeIds . "','$cat_name','$date','$time','$isSubcategory')");
                    } else {
                      $categoryQuery = "";
                      $categoryQuery = "INSERT INTO `category`(`classtype_id`, `cat_name`,`date`,`time`,`isSubcategory`) VALUES";
                      $categoryQuery .= "('[]','" . $cat_name . "','" . $date . "','" . $time . "','" . $isSubcategory . "')";
                      $query = mysqli_query($conn, $categoryQuery);
                    }
                    if ($query) {
                      $lastid = mysqli_insert_id($conn);

                      if ($isSubcategory == 'Yes') {
                        $subcategoryQuery = "";
                        $subcategoryQuery = "INSERT INTO `subcategory`(`classtype_id`,`cat_id`, `sub_cat_name`,`date`,`time`) VALUES";

                        foreach ($_POST['sub_cat_name'] as $key => $value) {
                          $classtypeIds = json_encode($_POST['classtype'][$key]);
                          $subcategoryQuery .= "('" . $classtypeIds . "','" . $lastid . "','" . addslashes($value) . "','" . $date . "','" . $time . "'),";
                        }

                        $subcategoryQuery = rtrim($subcategoryQuery, ',');
                        $query1 = mysqli_query($conn, $subcategoryQuery);
                      }
                      echo '<div id="snackbar">Category add successfully..</div>';
                      echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                      echo "var delay = 1000;setTimeout(function(){ window.location = 'cat-edit.php?eid=" . $lastid . "'; }, delay);";
                      echo "</script>";
                    } else {
                      echo '<div id="snackbar">Your Category Not Added..</div>';
                      echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
                    }
                  }
                }
              }
            }


            //     if(isset($_FILES['image'])){
            //        $file_name = $_FILES['image']['name'];
            //         if(!empty($file_name))
            //         {
            //             $file_size =$_FILES['image']['size'];
            //             $file_tmp =$_FILES['image']['tmp_name'];
            //             $file_type=$_FILES['image']['type'];

            //             $sel_query=mysqli_query($conn,"SELECT * FROM `category` WHERE classtype_id=$classtypeId AND cat_name='$_POST[cat_name]' AND trash='No'");
            //             if(mysqli_num_rows($sel_query)>0)
            //             {
            //                 //echo "<script>";
            //                 echo '<div id="snackbar">This Category is already added..</div>';
            //                 echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
            //             }
            //             else
            //             {
            //                 if(move_uploaded_file($file_tmp,"../asset/image/category/".$file_name))
            //                 {

            //                     date_default_timezone_set("Asia/kolkata");
            //                     $date=date("Y-m-d");
            //                     $time=date("H:i:s");
            //                     $query=mysqli_query($conn,"INSERT INTO `category`(`classtype_id`,`cat_name`,`gst`,`cat_image`,`date`,`time`) VALUES ($classtypeId,'$cat_name','$cat_gst','$file_name','$date','$time')");
            //                     if($query)
            //                     {
            //                         $lastid = mysqli_insert_id($conn);

            //                         echo '<div id="snackbar">Category add successfully..</div>';
            //                         echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
            //                         echo"var delay = 1000;setTimeout(function(){ window.location = 'sub-category-add.php'; }, delay);";
            //                         echo "</script>";
            //                     }
            //                     else
            //                     {
            //                         echo '<div id="snackbar">Your Category Not Added..</div>';
            //                         echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
            //                     }
            //                 }
            //                 else{
            //                     echo '<div id="snackbar">Image Not Uploaded..</div>';
            //                         echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
            //                 }
            //             }
            //         }
            //        else
            //        {
            //            $sel_query=mysqli_query($conn,"SELECT * FROM `category` WHERE classtype_id=$classtypeId AND cat_name='$cat_name' AND trash='No' ");
            //            if(mysqli_num_rows($sel_query)>0)
            //            {
            //                //echo "<script>";
            //                echo '<div id="snackbar">This Category is already added..</div>';
            //                echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
            //            }
            //            else
            //            {
            //                date_default_timezone_set("Asia/kolkata");
            //                $date=date("Y-m-d");
            //                $time=date("H:i:s");
            //                $query=mysqli_query($conn,"INSERT INTO `category`(`classtype_id`,`cat_name`,`gst`,`date`,`time`) VALUES ($classtypeId,'$cat_name','$cat_gst','$date','$time')");
            //                if($query)
            //                {
            //                    $lastid = mysqli_insert_id($conn);

            //                    echo '<div id="snackbar">Category add successfully..</div>';
            //                    echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
            //                    echo"var delay = 1000;setTimeout(function(){ window.location = 'sub-category-add.php'; }, delay);";
            //                    echo "</script>";
            //                }
            //                else
            //                {
            //                    echo '<div id="snackbar">Your Category Not Added..</div>';
            //                    echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
            //                }
            //            }
            //        }
            //     }

            //    $sel_query=mysqli_query($conn,"SELECT * FROM `category` WHERE classtype_id=$classtypeId AND cat_name='$cat_name'  AND trash='No' ");
            //    if(mysqli_num_rows($sel_query)>0)
            //    {
            //        //echo "<script>";
            //        echo '<div id="snackbar">This Category is already added..</div>';
            //        echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";


            //    }else
            //    {
            //        date_default_timezone_set("Asia/kolkata");
            //        $date=date("Y-m-d");
            //        $time=date("H:i:s");
            //        $query=mysqli_query($conn,"INSERT INTO `category`(`classtype_id`,`cat_name`,`gst`,`date`,`time`) VALUES ($classtypeId,'$cat_name','$cat_gst','$date','$time')");
            //        if($query)
            //        {
            //            $lastid = mysqli_insert_id($conn);

            //            echo '<div id="snackbar">Category add successfully..</div>';
            //            echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
            //            echo"var delay = 1000;setTimeout(function(){ window.location = 'sub-category-add.php'; }, delay);";
            //            echo "</script>";
            //        }
            //        else
            //        {
            //            echo '<div id="snackbar">Your Category Not Added..</div>';
            //            echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
            //        }
            //    }
            // }

            ?>
          </div>
        </div>
      </section>
      <!-- Main Content End -->

      <!-- Main Footer Start -->
      <?php include('includes/footer.php'); ?>

      <script>
        function delay(callback, ms) {
          var timer = 0;
          return function() {
            var context = $(this),
              args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function() {
              callback.apply(context, args);
              // console.log(context);
            }, ms || 0);
          };
        }

        //       $(document).on('keydown keypress change keyup','input[name=cat_gst]',function(){


        //     if (Number($(this).val()) < 0) $(this).val(0);
        //     if (Number($(this).val()) > 100) $(this).val(100);
        //   });

        $(document).on('change', '.classtypesubCat', function() {
          var value = ($(this).val());
          if (value == null) {

            $('#' + $(this).attr('id') + ' >option').each(function() {

              //   $(this).removeAttr('disabled');  

            })

            $(".js-example-basic-multiple").select2({
              maximumSelectionLength: 3,
              placeholder: 'Select Class Type'
            });
          } else {
            if (value.length > 0) {
              if (Number(value[0]) == 16) {
                $('#' + $(this).attr('id') + ' >option').each(function() {
                  if (Number(this.value) != Number(value[0])) {
                    //   $(this).attr('disabled',true);  
                  }
                })
              } else if (Number(value[0]) != 16) {
                $('#' + $(this).attr('id') + ' >option').each(function() {
                  if (Number(this.value) == 16) {
                    //   $(this).attr('disabled',true);  
                  }
                })
              } else {
                // alert();
                $('#' + $(this).attr('id') + ' >option').each(function() {

                  //   $(this).removeAttr('disabled');  

                })
              }
              $(".js-example-basic-multiple").select2({
                maximumSelectionLength: 3,
                placeholder: 'Select Class Type'
              });
            }
          }

        });

        $(document).on('change', '#classtypeCat', function() {
          var value = ($(this).val());
          if (value == null) {

            $('#classtypeCat >option').each(function() {

              //   $(this).removeAttr('disabled');  

            })

            $(".js-example-basic-multiple").select2({
              maximumSelectionLength: 3,
              placeholder: 'Select Class Type'
            });
          } else {
            if (value.length > 0) {
              if (Number(value[0]) == 16) {
                $('#classtypeCat >option').each(function() {
                  if (Number(this.value) != Number(value[0])) {
                    //   $(this).attr('disabled',true);  
                  }
                })
              } else if (Number(value[0]) != 16) {
                $('#classtypeCat >option').each(function() {
                  if (Number(this.value) == 16) {
                    //   $(this).attr('disabled',true);  
                  }
                })
              } else {
                // alert();
                $('#classtypeCat >option').each(function() {

                  //   $(this).removeAttr('disabled');  

                })
              }
              $(".js-example-basic-multiple").select2({
                maximumSelectionLength: 3,
                placeholder: 'Select Class Type'
              });
            }
          }

        });
        $(document).ready(function() {
          $(".js-example-basic-multiple").select2({
            maximumSelectionLength: 3,
            placeholder: 'Select Class Type'
          });
          // $('.js-example-basic-multiple').select2();


        });
      </script>

      <!-- Main Footer End -->