<?php include('includes/header.php'); ?>
    <style type="text/css">
        .steps{
            display: none;
        }
            .field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}
#mt--10{
    margin-top:10px;
}
.success-msg{
        background: #bfffbf;
    padding: 10px;
    margin-bottom: 10px;
}

    </style>

        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <div class="panel-content" style="padding:10px 20px 10px;">
                    <?php
                            $agent_id = $_SESSION['agent_loginid'];
                            $query2=mysqli_query($conn,"SELECT email FROM agents WHERE id = '$agent_id'");
                            $result = mysqli_fetch_assoc($query2);
                            
                            $query = "SELECT u.id,u.firstname,u.lastname,u.mobile,u.email,u.gender,u.flat,u.street,
                            u.locality,u.city,u.zipcode,u.state,u.country,u.addr_type,u.subscribe 
                            FROM user as u WHERE status='Active' AND agt_id = '".$agent_id."'";
                            $userInfoQuery = mysqli_query($conn, $query);

                            $userInfo = mysqli_fetch_assoc($userInfoQuery);

                            ?>
                                    <form action="" method="POST" id="edit_profile_form" class="formSubmit">
                                        <h3>Edit Profile</h3>
                                        <input type="hidden" name="editProfile" value="editProfile">
                                        <input type="hidden" name="userId" value="<?= $_SESSION['agent_loginid']; ?>">
                                        <div class="fb-form-inner">

                                            <div class="row">

                                                <div class="col-md-4">
                                                    <div class="single-input single-input-half">
                                                        <label for="account-details-firstname">First Name</label>
                                                        <input type="text" name="firstName" value="<?= $userInfo['firstname']; ?>" class="form-control" placeholder="Enter Your First Name" required>
                                                        <div class="err_msg" id="firstNameErrMsg"></div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="single-input single-input-half">
                                                        <label for="account-details-lastname">Last Name</label>
                                                        <input type="text" name="lastName" value="<?= $userInfo['lastname']; ?>" class="form-control" placeholder="Enter Your Last Name" required>
                                                        <div class="err_msg" id="lastNameErrMsg"></div>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="single-input single-input-half">
                                                        <label for="account-details-gender">Gender</label>
                                                        <select class="form-control" name="gender" id="gender">
                                                            <option value="">Please Select gender</option>
                                                            <option value="Male" <?= ($userInfo['gender'] == 'Male') ? 'selected' : ''; ?>>
                                                                Male </option>
                                                            <option value="Female" <?= ($userInfo['gender'] == 'Female') ? 'selected' : ''; ?>>
                                                                Female </option>
                                                        </select>
                                                        <div class="err_msg" id="genderErrMsg"></div>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="single-input single-input-half">
                                                        <label for="account-details-email">Email</label>
                                                        <input type="text" name="emailId" value="<?= $userInfo['email']; ?>" class="form-control" placeholder="Enter Your Email Address" disabled="">
                                                        <div class="err_msg" id="emailIdErrMsg"></div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="single-input single-input-half">
                                                        <label for="account-details-mobile">Contact No</label>
                                                        <input type="text" name="mobileNumber" value="<?= $userInfo['mobile']; ?>" class="form-control" placeholder="Enter Your Contact No." disabled>
                                                        <div class="err_msg" id="mobileNumberErrMsg"></div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="single-input single-input-half">
                                                        <label for="account-details-adressType">Address Type</label>
                                                        <select class="form-control" name="addressType" id="addressType">
                                                            <option value="">Please Select Type</option>
                                                            <option value="Home" <?= ($userInfo['addr_type'] == 'Home') ? 'selected' : ''; ?>>
                                                                Home</option>
                                                            <option value="Office" <?= ($userInfo['addr_type'] == 'Office') ? 'selected' : ''; ?>>
                                                                Office</option>
                                                            <option value="Other" <?= ($userInfo['addr_type'] == 'Other') ? 'selected' : ''; ?>>
                                                                Other</option>

                                                        </select>
                                                        <div class="err_msg" id="addressTypeErrMsg"></div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="single-input single-input-half">
                                                        <label for="account-details-firstname">Street address</label>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="text" name="addressFlat" placeholder="House number and Flat number" value="<?= $userInfo['flat']; ?>" class="form-control">
                                                                <div class="err_msg" id="addressFlatErrMsg"></div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="text" name="addressStreet" placeholder="Street,Apartment etc" value="<?= $userInfo['street']; ?>" class="form-control">
                                                                <div class="err_msg" id="addressStreetErrMsg"></div>
                                                            </div>
                                                            <div class="col-md-12 mt-3">
                                                                <input type="text" name="addressLocality" placeholder="Locality, unit etc. (optional)" value="<?= $userInfo['locality']; ?>" class="form-control">
                                                                <div class="err_msg" id="addressLocalityErrMsg"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6" id="mt--10">
                                                    <select class="form-control" name="addressCountry" id="addressCountry" onchange="getStates(this.value);">
                                                        <option value="99">India</option>
                                                    </select>
                                                    <div class="err_msg" id="addressCountryErrMsg"></div>
                                                </div>

                                                <div class="col-md-6" id="mt--10">
                                                    <select class="form-control" name="addressState" id="addressState">
                                                        <option value="">Please Select State</option>

                                                        <?php $getStates = mysqli_query($conn, "SELECT * FROM state_list");
                                                        while ($state = mysqli_fetch_assoc($getStates)) { ?>
                                                            <option value="<?= $state['id']; ?>" <?= ($userInfo['state'] == $state['id']) ? 'selected' : ''; ?>>
                                                                <?= $state['state']; ?></option>
                                                        <?php   }

                                                        ?>
                                                    </select>
                                                    <div class="err_msg" id="addressStateErrMsg"></div>

                                                </div>

                                                <div class="col-md-8" >
                                                    <div class="single-input single-input-half">
                                                        <label for="account-details-address">Town / City
                                                            <span>*</span></label>
                                                        <input name="addressCity" class="form-control" placeholder="Please enter City Name" type="text" value="<?= $userInfo['city']; ?>">
                                                        <div class="err_msg" id="addressCityErrMsg"></div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="single-input single-input-half">
                                                        <label for="account-details-zipCode">Zip Code
                                                            <span>*</span></label>
                                                        <input name="addressZipCode" class="form-control" type="text" value="<?= $userInfo['zipcode']; ?>" placeholder="Enter zip code">
                                                        <div class="err_msg" id="addressZipCodeErrMsg"></div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 text-left single-input mt-2">
                                                    <div class="text-center" id="edit_profile_formMsg"></div>
                                                    <button type="submit" class="cart-checkout-btn btn btn-primary btn-rounded"><span>SAVE
                                                            CHANGES</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
 
            
        </div>
    </div>
</section>
<!-- Main Content End -->

<!-- Main Footer Start -->
<?php include('includes/footer.php'); ?>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

                                   <script>

    $("input").keyup(function () {
    $("#" + this.name + "ErrMsg").html("<div class='err_msg' id='" + this.name + "ErrMsg'></div>");
});

$(document).ready(function () {
    $("#edit_profile_form").submit(function (event) {
        event.preventDefault();

        // Serialize the form data
        var formData = $(this).serialize();

        // AJAX request
        $.ajax({
            type: "POST",
            url: "ajax/edit_profile.php",
            data: formData,
            dataType: 'json', // Specify the expected data type
            success: function (response) {
                if (response.status === 'success') {
                    showAlert('success', response.result);
                } else if (response.status === 'formMsg') {
                    showAlert('error', response.result);
                } else if (response.status === 'failed') {
                    // Handle input errors
                    // You can iterate through response.errMessage and display each error
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    // Function to show alert with auto-hide
    function showAlert(type, message) {
        var alertClass = (type === 'success') ? 'success-msg' : 'error-msg';
        $("#edit_profile_formMsg").html('<div class="' + alertClass + '">' + message + '</div>');
        
        // Auto-hide after 3 seconds (adjust the time as needed)
        setTimeout(function () {
            $("#edit_profile_formMsg").fadeOut('slow');
        }, 3000);
    }
});


</script>
