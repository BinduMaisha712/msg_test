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
            <div class="panel-content p-4">
                <!-- Form Wizard Start -->
                <h3 style="border-bottom: 1px solid #ddd;">CHANGE ACHIEVEMENT STRUCTURE</h3>
                <?php
                $query = "SELECT min_amount, max_amount, achievement, redemption, conversion,img FROM achievement_structure WHERE id = 1";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $min_amt1 = $row['min_amount'];
                    $max_amt1 = $row['max_amount'];
                    $achievement1 = $row['achievement'];
                    $redemption1 = $row['redemption'];
                    $conversion1 = $row['conversion'];
                    $img1 = $row['img'];
                } else {
                    // If no records found, initialize variables with default values or leave them empty
                    $min_amt1 = '';
                    $max_amt1 = '';
                    $achievement1 = '';
                    $redemption1 = '';
                    $conversion1 = '';
                    $img1 = '';
                }
                $query2 = "SELECT min_amount, max_amount, achievement, redemption, conversion,img FROM achievement_structure WHERE id = 2";
                $result2 = mysqli_query($conn, $query2);
                if ($result2 && mysqli_num_rows($result2) > 0) {
                    $row = mysqli_fetch_assoc($result2);
                    $min_amt2 = $row['min_amount'];
                    $max_amt2 = $row['max_amount'];
                    $achievement2 = $row['achievement'];
                    $redemption2 = $row['redemption'];
                    $conversion2 = $row['conversion'];
                    $img2 = $row['img'];
                } else {
                    // If no records found, initialize variables with default values or leave them empty
                    $min_amt2 = '';
                    $max_amt2 = '';
                    $achievement2 = '';
                    $redemption2 = '';
                    $conversion2 = '';
                    $img2 = '';
                }
                $query3 = "SELECT min_amount, max_amount, achievement, redemption, conversion,img FROM achievement_structure WHERE id = 3";
                $result3 = mysqli_query($conn, $query3);
                if ($result3 && mysqli_num_rows($result3) > 0) {
                    $row = mysqli_fetch_assoc($result3);
                    $min_amt3 = $row['min_amount'];
                    $max_amt3 = $row['max_amount'];
                    $achievement3 = $row['achievement'];
                    $redemption3 = $row['redemption'];
                    $conversion3 = $row['conversion'];
                    $img3 = $row['img'];
                } else {
                    // If no records found, initialize variables with default values or leave them empty
                    $min_amt3 = '';
                    $max_amt3 = '';
                    $achievement3 = '';
                    $redemption3 = '';
                    $conversion3 = '';
                    $img3 = '';
                }
                $query4 = "SELECT min_amount, max_amount, achievement, redemption, conversion,img FROM achievement_structure WHERE id = 4";
                $result4 = mysqli_query($conn, $query4);
                if ($result4 && mysqli_num_rows($result4) > 0) {
                    $row = mysqli_fetch_assoc($result4);
                    $min_amt4 = $row['min_amount'];
                    $max_amt4 = $row['max_amount'];
                    $achievement4 = $row['achievement'];
                    $conversion4 = $row['conversion'];
                    $redemption4 = $row['redemption'];
                    $img4 = $row['img'];
                } else {
                    // If no records found, initialize variables with default values or leave them empty
                    $min_amt4 = '';
                    $max_amt4 = '';
                    $achievement4 = '';
                    $redemption4 = '';
                    $conversion4 = '';
                    $img4 = '';
                }
                $query5 = "SELECT min_amount, max_amount, achievement, redemption, conversion,img FROM achievement_structure WHERE id = 5";
                $result5 = mysqli_query($conn, $query5);
                if ($result5 && mysqli_num_rows($result5) > 0) {
                    $row = mysqli_fetch_assoc($result5);
                    $min_amt5 = $row['min_amount'];
                    $max_amt5 = $row['max_amount'];
                    $achievement5 = $row['achievement'];
                    $redemption5 = $row['redemption'];
                    $conversion5 = $row['conversion'];
                    $img5 = $row['img'];
                } else {
                    // If no records found, initialize variables with default values or leave them empty
                    $min_amt5 = '';
                    $max_amt5 = '';
                    $achievement5 = '';
                    $redemption5 = '';
                    $conversion5 = '';
                    $img5 = '';
                }
                $query6 = "SELECT min_amount, max_amount, achievement, redemption, conversion,img FROM achievement_structure WHERE id = 6";
                $result6 = mysqli_query($conn, $query6);
                if ($result6 && mysqli_num_rows($result6) > 0) {
                    $row = mysqli_fetch_assoc($result6);
                    $min_amt6 = $row['min_amount'];
                    $max_amt6 = $row['max_amount'];
                    $achievement6 = $row['achievement'];
                    $redemption6 = $row['redemption'];
                    $conversion6 = $row['conversion'];
                    $img6 = $row['img'];
                } else {
                    // If no records found, initialize variables with default values or leave them empty
                    $min_amt6 = '';
                    $max_amt6 = '';
                    $achievement6 = '';
                    $redemption6 = '';
                    $conversion6 = '';
                    $img6 = '';
                }
                $query7 = "SELECT min_amount, max_amount, achievement, redemption, conversion,img FROM achievement_structure WHERE id = 7";
                $result7 = mysqli_query($conn, $query7);
                if ($result7 && mysqli_num_rows($result7) > 0) {
                    $row = mysqli_fetch_assoc($result7);
                    $min_amt7 = $row['min_amount'];
                    $max_amt7 = $row['max_amount'];
                    $achievement7 = $row['achievement'];
                    $redemption7 = $row['redemption'];
                    $conversion7 = $row['conversion'];
                    $img7 = $row['img'];
                } else {
                    // If no records found, initialize variables with default values or leave them empty
                    $min_amt7 = '';
                    $max_amt7 = '';
                    $achievement7 = '';
                    $redemption7 = '';
                    $conversion7 = '';
                    $img7 = '';
                }
                ?>
                <section class="">
                    <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm1()" id="form1">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <label for="min1" class="label-text col-form-label">Min Amount</label>
                                <input type="number" value="<?php echo $min_amt1; ?>" required class="form-control" name="min1" id="min1">
                            </div>
                            <div class="col-2">
                                <label for="max1" class="label-text col-form-label">Max Amount</label>
                                <input type="number" value="<?php echo $max_amt1; ?>" required class="form-control" name="max1" id="max1">
                            </div>
                            <div class="col-2">
                                <label for="dis1" class="label-text col-form-label">Achievement Name</label>
                                <input type="text" required value="<?php echo $achievement1; ?>" class="form-control" name="dis1" id="dis1">
                            </div>
                            <div class="col-2">
                                <label for="red1" class="label-text col-form-label">Redemption Rate (in %)</label>
                                <input type="text" required value="<?php echo $redemption1; ?>" class="form-control" name="red1" id="red1">
                            </div>
                            <div class="col-2">
                                <label for="con1" class="label-text col-form-label">Conversion Rate (in %)</label>
                                <input type="text" required value="<?php echo $conversion1; ?>" class="form-control" name="con1" id="con1">
                            </div>
                            <div class="col-1">
                                <label for="img1" class="label-text col-form-label">Image</label>
                                <input type="file" name="img1" id="img1" class="form-control" onchange="return validateForm11()" <?php echo ($img1 ? "" : "required") ?>>
                                    <img src="<?php echo $img1;?>" alt="Achievement Image" width="70" id="imgview1">
                            </div>
                            <div class="col-1 text-center">
                                <label>
                                    <button class="btn btn-success btn-md" id="sub1">Submit</button>
                                </label>
                            </div>
                        </div>
                    </form>
                    <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm2()" id="form2">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <label for="min2" class="label-text col-form-label">Min Amount</label>
                                <input type="number" value="<?php echo $min_amt2; ?>" required class="form-control" name="min2" id="min2">
                            </div>
                            <div class="col-2">
                                <label for="max2" class="label-text col-form-label">Max Amount</label>
                                <input type="number" value="<?php echo $max_amt2; ?>" required class="form-control" name="max2" id="max2">
                            </div>
                            <div class="col-2">
                                <label for="dis2" class="label-text col-form-label">Achievement Name</label>
                                <input type="text" required value="<?php echo $achievement2; ?>" class="form-control" name="dis2" id="dis2">
                            </div>
                            <div class="col-2">
                                <label for="red2" class="label-text col-form-label">Redemption Rate (in %)</label>
                                <input type="text" required value="<?php echo $redemption2; ?>" class="form-control" name="red2" id="red2">
                            </div>
                            <div class="col-2">
                                <label for="con2" class="label-text col-form-label">Conversion Rate (in %)</label>
                                <input type="text" required value="<?php echo $conversion2; ?>" class="form-control" name="con2" id="con2">
                            </div>
                            <div class="col-1">
                                <label for="img2" class="label-text col-form-label">Image</label>
                                <input type="file" name="img2" id="img2" class="form-control" onchange="return validateForm12()" <?php echo ($img2 ? "" : "required") ?>>
                                <img src="<?php echo $img2; ?>" alt="Achievement Image" width="50" id="imgview2">
                            </div>
                            <div class="col-1 text-center">
                                <label>
                                    <button class="btn btn-success btn-md" id="sub2">Submit</button>
                                </label>
                            </div>
                        </div>
                    </form>
                    <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm3()" id="form3">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <label for="min3" class="label-text col-form-label">Min Amount</label>
                                <input type="number" value="<?php echo $min_amt3; ?>" required class="form-control" name="min3" id="min3">
                            </div>
                            <div class="col-2">
                                <label for="max3" class="label-text col-form-label">Max Amount</label>
                                <input type="number" value="<?php echo $max_amt3; ?>" required class="form-control" name="max3" id="max3">
                            </div>
                            <div class="col-2">
                                <label for="dis3" class="label-text col-form-label">Achievement Name</label>
                                <input type="text" required value="<?php echo $achievement3; ?>" class="form-control" name="dis3" id="dis3">
                            </div>
                            <div class="col-2">
                                <label for="red3" class="label-text col-form-label">Redemption Rate (in %)</label>
                                <input type="text" required value="<?php echo $redemption3; ?>" class="form-control" name="red3" id="red3">
                            </div>
                            <div class="col-2">
                                <label for="con3" class="label-text col-form-label">Conversion Rate (in %)</label>
                                <input type="text" required value="<?php echo $conversion3; ?>" class="form-control" name="con3" id="con3">
                            </div>
                            <div class="col-1">
                                <label for="img3" class="label-text col-form-label">Image</label>
                                <input type="file" name="img3" id="img3" class="form-control" onchange="return validateForm13()" <?php echo ($img3 ? "" : "required") ?>>
                                <img src="<?php echo $img3; ?>" alt="Achievement Image" width="50" id="imgview3">
                            </div>
                            <div class="col-1 text-center">
                                <label>
                                    <button class="btn btn-success btn-md" id="sub3">Submit</button>
                                </label>
                            </div>
                        </div>
                    </form>
                    <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm4()" id="form4">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <label for="min4" class="label-text col-form-label">Min Amount</label>
                                <input type="number" value="<?php echo $min_amt4; ?>" required class="form-control" name="min4" id="min4">
                            </div>
                            <div class="col-2">
                                <label for="max4" class="label-text col-form-label">Max Amount</label>
                                <input type="number" value="<?php echo $max_amt4; ?>" required class="form-control" name="max4" id="max4">
                            </div>
                            <div class="col-2">
                                <label for="dis4" class="label-text col-form-label">Achievement Name</label>
                                <input type="text" required value="<?php echo $achievement4; ?>" class="form-control" name="dis4" id="dis4">
                            </div>
                            <div class="col-2">
                                <label for="red4" class="label-text col-form-label">Redemption Rate (in %)</label>
                                <input type="text" required value="<?php echo $redemption4; ?>" class="form-control" name="red4" id="red4">
                            </div>
                            <div class="col-2">
                                <label for="con4" class="label-text col-form-label">Conversion Rate (in %)</label>
                                <input type="text" required value="<?php echo $conversion4; ?>" class="form-control" name="con4" id="con4">
                            </div>
                            <div class="col-1">
                                <label for="img4" class="label-text col-form-label">Image</label>
                                <input type="file" name="img4" id="img4" class="form-control" onchange="return validateForm14()" <?php echo ($img4 ? "" : "required") ?>>
                                <img src="<?php echo $img4; ?>" alt="Achievement Image" width="50" id="imgview4">
                            </div>
                            <div class="col-1 text-center">
                                <label>
                                    <button class="btn btn-success btn-md" id="sub4">Submit</button>
                                </label>
                            </div>
                        </div>
                    </form>
                    <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm5()" id="form5">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <label for="min5" class="label-text col-form-label">Min Amount</label>
                                <input type="number" value="<?php echo $min_amt5; ?>" required class="form-control" name="min5" id="min5">
                            </div>
                            <div class="col-2">
                                <label for="max5" class="label-text col-form-label">Max Amount</label>
                                <input type="number" value="<?php echo $max_amt5; ?>" required class="form-control" name="max5" id="max5">
                            </div>
                            <div class="col-2">
                                <label for="dis5" class="label-text col-form-label">Achievement Name</label>
                                <input type="text" required value="<?php echo $achievement5; ?>" class="form-control" name="dis5" id="dis5">
                            </div>
                            <div class="col-2">
                                <label for="red5" class="label-text col-form-label">Redemption Rate (in %)</label>
                                <input type="text" required value="<?php echo $redemption5; ?>" class="form-control" name="red5" id="red5">
                            </div>
                            <div class="col-2">
                                <label for="con5" class="label-text col-form-label">Conversion Rate (in %)</label>
                                <input type="text" required value="<?php echo $conversion5; ?>" class="form-control" name="con5" id="con5">
                            </div>
                            <div class="col-1">
                                <label for="img5" class="label-text col-form-label">Image</label>
                                <input type="file" name="img5" id="img5" class="form-control" onchange="return validateForm15()" <?php echo ($img5 ? "" : "required") ?>>
                                <img src="<?php echo $img5; ?>" alt="Achievement Image" width="50" id="imgview5">
                            </div>
                            <div class="col-1 text-center">
                                <label>
                                    <button class="btn btn-success btn-md" id="sub5">Submit</button>
                                </label>
                            </div>
                        </div>
                    </form>
                    <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm6()" id="form6">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <label for="min6" class="label-text col-form-label">Min Amount</label>
                                <input type="number" value="<?php echo $min_amt6; ?>" required class="form-control" name="min6" id="min6">
                            </div>
                            <div class="col-2">
                                <label for="max6" class="label-text col-form-label">Max Amount</label>
                                <input type="number" value="<?php echo $max_amt6; ?>" required class="form-control" name="max6" id="max6">
                            </div>
                            <div class="col-2">
                                <label for="dis6" class="label-text col-form-label">Achievement Name</label>
                                <input type="text" required value="<?php echo $achievement6; ?>" class="form-control" name="dis6" id="dis6">
                            </div>
                            <div class="col-2">
                                <label for="red6" class="label-text col-form-label">Redemption Rate (in %)</label>
                                <input type="text" required value="<?php echo $redemption6; ?>" class="form-control" name="red6" id="red6">
                            </div>
                            <div class="col-2">
                                <label for="con6" class="label-text col-form-label">Conversion Rate (in %)</label>
                                <input type="text" required value="<?php echo $conversion6; ?>" class="form-control" name="con6" id="con6">
                            </div>
                            <div class="col-1">
                                <label for="img6" class="label-text col-form-label">Image</label>
                                <input type="file" name="img6" id="img6" class="form-control" onchange="return validateForm16()" <?php echo ($img6 ? "" : "required") ?>>
                                <img src="<?php echo $img6; ?>" alt="Achievement Image" width="50" id="imgview6">
                            </div>
                            <div class="col-1 text-center">
                                <label>
                                    <button class="btn btn-success btn-md" id="sub6">Submit</button>
                                </label>
                            </div>
                        </div>
                    </form>
                    <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm7()" id="form7">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <label for="min7" class="label-text col-form-label">Min Amount</label>
                                <input type="number" value="<?php echo $min_amt7; ?>" required class="form-control" name="min7" id="min7">
                            </div>
                            <div class="col-2">
                                <label for="max7" class="label-text col-form-label">Max Amount</label>
                                <input type="number" value="<?php echo $max_amt7; ?>" required class="form-control" name="max7" id="max7">
                            </div>
                            <div class="col-2">
                                <label for="dis7" class="label-text col-form-label">Achievement Name</label>
                                <input type="text" required value="<?php echo $achievement7; ?>" class="form-control" name="dis7" id="dis7">
                            </div>
                            <div class="col-2">
                                <label for="red7" class="label-text col-form-label">Redemption Rate (in %)</label>
                                <input type="text" required value="<?php echo $redemption7; ?>" class="form-control" name="red7" id="red7">
                            </div>
                            <div class="col-2">
                                <label for="con7" class="label-text col-form-label">Conversion Rate (in %)</label>
                                <input type="text" required value="<?php echo $conversion7; ?>" class="form-control" name="con7" id="con7">
                            </div>
                            <div class="col-1">
                                <label for="img7" class="label-text col-form-label">Image</label>
                                <input type="file" name="img7" id="img7" class="form-control" onchange="return validateForm17()" <?php echo ($img7 ? "" : "required") ?>>
                                <img src="<?php echo $img7; ?>" alt="Achievement Image" width="50" id="imgview7">
                            </div>
                            <div class="col-1 text-center">
                                <label>
                                    <button class="btn btn-success btn-md" id="sub7">Submit</button>
                                </label>
                            </div>
                        </div>
                    </form>
                </section>
                <!-- Form Wizard End -->
            </div>
        </div>
    </section>
    <!-- Main Content End -->
    <?php
    // Assuming you have established a database connection and stored it in $conn

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if all fields are filled
        if (isset($_POST['min1']) && isset($_POST['max1']) && isset($_POST['dis1'])) {
            // Retrieve form values
            $min1 = $_POST['min1'];
            $max1 = $_POST['max1'];
            $dis1 = $_POST['dis1'];
            $red1 = $_POST['red1'];
            $con1 = $_POST['con1'];

            if (isset($_FILES['img1']['name']) && !empty($_FILES['img1']['tmp_name'])) {
                
                $file_name = $_FILES['img1']['name'];
                $file_tmp = $_FILES['img1']['tmp_name'];
                $file_destination = '../asset/image/achievement/' . $file_name;
                if (move_uploaded_file($file_tmp, $file_destination)) {
                    $query = mysqli_query($conn, "UPDATE achievement_structure SET min_amount = $min1, max_amount = $max1, achievement = '$dis1' , redemption= $red1, conversion= $con1 , img = '$file_destination' WHERE id = 1");
                    if ($query) {
                        echo "<script>window.location.href= 'change-achievement-structure.php'</script>";
                    } else {
                        echo "Error:" . mysqli_error($conn);
                    }
                } else {
                    echo "File upload failed for Form 1.";
                }
            } else {
                $query = mysqli_query($conn, "UPDATE achievement_structure SET min_amount = $min1, max_amount = $max1, achievement = '$dis1' , redemption= $red1, conversion= $con1 WHERE id = 1");
                if ($query) {
                    echo "<script>window.location.href= 'change-achievement-structure.php'</script>";
                } else {
                    echo "Error:" . mysqli_error($conn);
                }
            }
        }
        if (isset($_POST['min2']) && isset($_POST['max2']) && isset($_POST['dis2'])) {
            // Retrieve form values
            $min2 = $_POST['min2'];
            $max2 = $_POST['max2'];
            $dis2 = $_POST['dis2'];
            $red2 = $_POST['red2'];
            $con2 = $_POST['con2'];

            if (isset($_FILES['img2']['name']) && !empty($_FILES['img2']['tmp_name'])) {
                
                $file_name = $_FILES['img2']['name'];
                $file_tmp = $_FILES['img2']['tmp_name'];
                $file_destination = '../asset/image/achievement/' . $file_name;
                if (move_uploaded_file($file_tmp, $file_destination)) {
                    $query = mysqli_query($conn, "UPDATE achievement_structure SET min_amount = $min2, max_amount = $max2, achievement = '$dis2' , redemption= $red2, conversion= $con2 , img = '$file_destination' WHERE id = 2");
                    if ($query) {
                        echo "<script>window.location.href= 'change-achievement-structure.php'</script>";
                    } else {
                        echo "Error:" . mysqli_error($conn);
                    }
                } else {
                    echo "File upload failed for Form 2.";
                }
            } else {
                $query = mysqli_query($conn, "UPDATE achievement_structure SET min_amount = $min2, max_amount = $max2, achievement = '$dis2' , redemption= $red2, conversion= $con2 WHERE id = 2");
                if ($query) {
                    echo "<script>window.location.href= 'change-achievement-structure.php'</script>";
                } else {
                    echo "Error:" . mysqli_error($conn);
                }
            }
        }
        if (isset($_POST['min3']) && isset($_POST['max3']) && isset($_POST['dis3'])) {
            // Retrieve form values
            $min3 = $_POST['min3'];
            $max3 = $_POST['max3'];
            $dis3 = $_POST['dis3'];
            $red3 = $_POST['red3'];
            $con3 = $_POST['con3'];

            if (isset($_FILES['img3']['name']) && !empty($_FILES['img3']['tmp_name'])) {
                
                $file_name = $_FILES['img3']['name'];
                $file_tmp = $_FILES['img3']['tmp_name'];
                $file_destination = '../asset/image/achievement/' . $file_name;
                if (move_uploaded_file($file_tmp, $file_destination)) {
                    $query = mysqli_query($conn, "UPDATE achievement_structure SET min_amount = $min3, max_amount = $max3, achievement = '$dis3' , redemption= $red3, conversion= $con3 , img = '$file_destination' WHERE id = 3");
                    if ($query) {
                        echo "<script>window.location.href= 'change-achievement-structure.php'</script>";
                    } else {
                        echo "Error:" . mysqli_error($conn);
                    }
                } else {
                    echo "File upload failed for Form 3.";
                }
            } else {
                $query = mysqli_query($conn, "UPDATE achievement_structure SET min_amount = $min3, max_amount = $max3, achievement = '$dis3' , redemption= $red3, conversion= $con3 WHERE id = 3");
                if ($query) {
                    echo "<script>window.location.href= 'change-achievement-structure.php'</script>";
                } else {
                    echo "Error:" . mysqli_error($conn);
                }
            }
        }
        if (isset($_POST['min4']) && isset($_POST['max4']) && isset($_POST['dis4'])) {
            // Retrieve form values
            $min4 = $_POST['min4'];
            $max4 = $_POST['max4'];
            $dis4 = $_POST['dis4'];
            $red4 = $_POST['red4'];
            $con4 = $_POST['con4'];

            if (isset($_FILES['img4']['name']) && !empty($_FILES['img4']['tmp_name'])) {
                
                $file_name = $_FILES['img4']['name'];
                $file_tmp = $_FILES['img4']['tmp_name'];
                $file_destination = '../asset/image/achievement/' . $file_name;
                if (move_uploaded_file($file_tmp, $file_destination)) {
                    $query = mysqli_query($conn, "UPDATE achievement_structure SET min_amount = $min4, max_amount = $max4, achievement = '$dis4' , redemption= $red4, conversion= $con4 , img = '$file_destination' WHERE id = 4");
                    if ($query) {
                        echo "<script>window.location.href= 'change-achievement-structure.php'</script>";
                    } else {
                        echo "Error:" . mysqli_error($conn);
                    }
                } else {
                    echo "File upload failed for Form 4.";
                }
            } else {
                $query = mysqli_query($conn, "UPDATE achievement_structure SET min_amount = $min4, max_amount = $max4, achievement = '$dis4' , redemption= $red4, conversion= $con4 WHERE id = 4");
                if ($query) {
                    echo "<script>window.location.href= 'change-achievement-structure.php'</script>";
                } else {
                    echo "Error:" . mysqli_error($conn);
                }
            }
        }
        if (isset($_POST['min5']) && isset($_POST['max5']) && isset($_POST['dis5'])) {
            // Retrieve form values
            $min5 = $_POST['min5'];
            $max5 = $_POST['max5'];
            $dis5 = $_POST['dis5'];
            $red5 = $_POST['red5'];
            $con5 = $_POST['con5'];

            if (isset($_FILES['img5']['name']) && !empty($_FILES['img5']['tmp_name'])) {
                
                $file_name = $_FILES['img5']['name'];
                $file_tmp = $_FILES['img5']['tmp_name'];
                $file_destination = '../asset/image/achievement/' . $file_name;
                if (move_uploaded_file($file_tmp, $file_destination)) {
                    $query = mysqli_query($conn, "UPDATE achievement_structure SET min_amount = $min5, max_amount = $max5, achievement = '$dis5' , redemption= $red5, conversion= $con5 , img = '$file_destination' WHERE id = 5");
                    if ($query) {
                        echo "<script>window.location.href= 'change-achievement-structure.php'</script>";
                    } else {
                        echo "Error:" . mysqli_error($conn);
                    }
                } else {
                    echo "File upload failed for Form 5.";
                }
            } else {
                $query = mysqli_query($conn, "UPDATE achievement_structure SET min_amount = $min5, max_amount = $max5, achievement = '$dis5' , redemption= $red5, conversion= $con5 WHERE id = 5");
                if ($query) {
                    echo "<script>window.location.href= 'change-achievement-structure.php'</script>";
                } else {
                    echo "Error:" . mysqli_error($conn);
                }
            }
        }
        if (isset($_POST['min6']) && isset($_POST['max6']) && isset($_POST['dis6'])) {
            // Retrieve form values
            $min6 = $_POST['min6'];
            $max6 = $_POST['max6'];
            $dis6 = $_POST['dis6'];
            $red6 = $_POST['red6'];
            $con6 = $_POST['con6'];

            if (isset($_FILES['img6']['name']) && !empty($_FILES['img6']['tmp_name'])) {
                
                $file_name = $_FILES['img6']['name'];
                $file_tmp = $_FILES['img6']['tmp_name'];
                $file_destination = '../asset/image/achievement/' . $file_name;
                if (move_uploaded_file($file_tmp, $file_destination)) {
                    $query = mysqli_query($conn, "UPDATE achievement_structure SET min_amount = $min6, max_amount = $max6, achievement = '$dis6' , redemption= $red6, conversion= $con6 , img = '$file_destination' WHERE id = 6");
                    if ($query) {
                        echo "<script>window.location.href= 'change-achievement-structure.php'</script>";
                    } else {
                        echo "Error:" . mysqli_error($conn);
                    }
                } else {
                    echo "File upload failed for Form 6.";
                }
            } else {
                $query = mysqli_query($conn, "UPDATE achievement_structure SET min_amount = $min6, max_amount = $max6, achievement = '$dis6' , redemption= $red6, conversion= $con6 WHERE id = 6");
                if ($query) {
                    echo "<script>window.location.href= 'change-achievement-structure.php'</script>";
                } else {
                    echo "Error:" . mysqli_error($conn);
                }
            }
        }
        if (isset($_POST['min7']) && isset($_POST['max7']) && isset($_POST['dis7'])) {
            // Retrieve form values
            $min7 = $_POST['min7'];
            $max7 = $_POST['max7'];
            $dis7 = $_POST['dis7'];
            $red7 = $_POST['red7'];
            $con7 = $_POST['con7'];

            if (isset($_FILES['img7']['name']) && !empty($_FILES['img7']['tmp_name'])) {
                
                $file_name = $_FILES['img7']['name'];
                $file_tmp = $_FILES['img7']['tmp_name'];
                $file_destination = '../asset/image/achievement/' . $file_name;
                if (move_uploaded_file($file_tmp, $file_destination)) {
                    $query = mysqli_query($conn, "UPDATE achievement_structure SET min_amount = $min7, max_amount = $max7, achievement = '$dis7' , redemption= $red7, conversion= $con7 , img = '$file_destination' WHERE id = 7");
                    if ($query) {
                        echo "<script>window.location.href= 'change-achievement-structure.php'</script>";
                    } else {
                        echo "Error:" . mysqli_error($conn);
                    }
                } else {
                    echo "File upload failed for Form 7.";
                }
            } else {
                $query = mysqli_query($conn, "UPDATE achievement_structure SET min_amount = $min7, max_amount = $max7, achievement = '$dis7' , redemption= $red7, conversion= $con7 WHERE id = 7");
                if ($query) {
                    echo "<script>window.location.href= 'change-achievement-structure.php'</script>";
                } else {
                    echo "Error:" . mysqli_error($conn);
                }
            }
        }
    }

    ?>

    <!-- Main Footer Start -->
    <?php include('includes/footer.php'); ?>
    <script>
        function validateForm1() {
            var min1 = document.getElementById("min1").value;
            var max1 = document.getElementById("max1").value;

            if (parseInt(min1) >= parseInt(max1)) {
                alert("Min Amount 1 should be less than Max Amount 1.");
                return false;
            }
        }

        function validateForm11() {
            var imgInput = document.getElementById("img1");
            var imgView = document.getElementById("imgview1");

            if (imgInput.files.length > 0) {
                // Show image preview
                var reader = new FileReader();
                reader.onload = function(e) {
                    imgView.src = e.target.result;
                };
                reader.readAsDataURL(imgInput.files[0]);
            }

            // Validation passed
            return true;
        }

        function validateForm2() {
            var max1 = document.getElementById("max1").value;
            var min2 = document.getElementById("min2").value;
            var max2 = document.getElementById("max2").value;

            if (parseInt(min2) <= parseInt(max1) || parseInt(min2) >= parseInt(max2)) {
                alert("Min Amount 2 should be greater than Max Amount 1 and less than Max Amount 2.");
                return false;
            }
            return true;
        }

        function validateForm12() {
            var imgInput = document.getElementById("img2");
            var imgView = document.getElementById("imgview2");

            if (imgInput.files.length > 0) {
                // Show image preview
                var reader = new FileReader();
                reader.onload = function(e) {
                    imgView.src = e.target.result;
                };
                reader.readAsDataURL(imgInput.files[0]);
            }

            // Validation passed
            return true;
        }

        function validateForm3() {
            var max2 = document.getElementById("max2").value;
            var min3 = document.getElementById("min3").value;
            var max3 = document.getElementById("max3").value;

            if (parseInt(min3) <= parseInt(max2) || parseInt(min3) >= parseInt(max3)) {
                alert("Min Amount 3 should be greater than Max Amount 2 and less than Max Amount 3.");
                return false;
            }
            return true;
        }

        function validateForm13() {
            var imgInput = document.getElementById("img3");
            var imgView = document.getElementById("imgview3");

            if (imgInput.files.length > 0) {
                // Show image preview
                var reader = new FileReader();
                reader.onload = function(e) {
                    imgView.src = e.target.result;
                };
                reader.readAsDataURL(imgInput.files[0]);
            }
            // Validation passed
            return true;
        }

        function validateForm4() {
            var max3 = document.getElementById("max3").value;
            var min4 = document.getElementById("min4").value;
            var max4 = document.getElementById("max4").value;

            if (parseInt(min4) <= parseInt(max3) || parseInt(min4) >= parseInt(max4)) {
                alert("Min Amount 4 should be greater than Max Amount 3 and less than Max Amount 4.");
                return false;
            }
            return true;
        }

        function validateForm14() {
            var imgInput = document.getElementById("img4");
            var imgView = document.getElementById("imgview4");

            if (imgInput.files.length > 0) {
                // Show image preview
                var reader = new FileReader();
                reader.onload = function(e) {
                    imgView.src = e.target.result;
                };
                reader.readAsDataURL(imgInput.files[0]);
            }
            // Validation passed
            return true;
        }

        function validateForm15() {
            var imgInput = document.getElementById("img5");
            var imgView = document.getElementById("imgview5");

            if (imgInput.files.length > 0) {
                // Show image preview
                var reader = new FileReader();
                reader.onload = function(e) {
                    imgView.src = e.target.result;
                };
                reader.readAsDataURL(imgInput.files[0]);
            }
            // Validation passed
            return true;
        }

        function validateForm6() {
            var max5 = document.getElementById("max5").value;
            var min6 = document.getElementById("min6").value;
            var max6 = document.getElementById("max6").value;

            if (parseInt(min6) <= parseInt(max5) || parseInt(min6) >= parseInt(max6)) {
                alert("Min Amount 6 should be greater than Max Amount 5 and less than Max Amount 6.");
                return false;
            }
            return true;
        }

        function validateForm16() {
            var imgInput = document.getElementById("img6");
            var imgView = document.getElementById("imgview6");

            if (imgInput.files.length > 0) {
                // Show image preview
                var reader = new FileReader();
                reader.onload = function(e) {
                    imgView.src = e.target.result;
                };
                reader.readAsDataURL(imgInput.files[0]);
            }
            // Validation passed
            return true;
        }

        function validateForm7() {
            var max6 = document.getElementById("max6").value;
            var min7 = document.getElementById("min7").value;
            var max7 = document.getElementById("max7").value;

            if (parseInt(min7) <= parseInt(max6) || parseInt(min7) >= parseInt(max7)) {
                alert("Min Amount 7 should be greater than Max Amount 6 and less than Max Amount 7.");
                return false;
            }
            return true;
        }

        function validateForm17() {
            var imgInput = document.getElementById("img7");
            var imgView = document.getElementById("imgview7");

            if (imgInput.files.length > 0) {
                // Show image preview
                var reader = new FileReader();
                reader.onload = function(e) {
                    imgView.src = e.target.result;
                };
                reader.readAsDataURL(imgInput.files[0]);
            }
            // Validation passed
            return true;
        }
    </script>
    <!-- Main Footer End -->