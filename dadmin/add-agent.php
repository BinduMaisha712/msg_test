<?php

include ('includes/header.php');


?>
<style>
.table-hover tr:hover {
    cursor: pointer;
}
</style>
<!-- Main Container Start -->
<main class="main--container">
    <!-- Main Content Start -->
    <section class="main--content">
        <div class="panel">
            <!-- Records List Start -->
            <div class="records--list" data-title="Add Agent">
                <form action="ajax/add-agent.php" method="post" class="p-3" enctype="multipart/form-data" id="formadd">
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">First Name: *</span>
                        <div class="col-md-9">
                            <input type="text" name="firstname" class="form-control" id="firstname" required
                                placeholder="Please enter First Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Last Name: *</span>
                        <div class="col-md-9">
                            <input type="text" name="lastname" class="form-control" id="lastname" required
                                placeholder="Please enter Last Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Mobile Number: *</span>
                        <div class="col-md-9">
                            <input type="text" name="mobileno" class="form-control" id="mobileno" required
                                placeholder="Please enter Mobile Number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Email ID: *</span>
                        <div class="col-md-9">
                            <input type="text" name="emailid" class="form-control" id="emailid" required
                                placeholder="Please enter Email ID">
                                <div id="errorNotification" style="display: none;" class="error-notification"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Password: *</span>
                        <div class="col-md-9">
                            <input type="password" name="password" class="form-control" id="password" required
                                placeholder="Please enter Password">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Flat: *</span>
                        <div class="col-md-9">
                            <input class="form-control" name="addflat" placeholder="House number and Flat number " type="text" required>
                                <div id="errorNotification" style="display: none;" class="error-notification"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Street: *</span>
                        <div class="col-md-9">
                            <input class="form-control" name="addstreet" placeholder="Street,Apartment etc" type="text" required>
                                <div id="errorNotification" style="display: none;" class="error-notification"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Locality: *</span>
                        <div class="col-md-9">
                             <input class="form-control" name="addlocality" placeholder="Locality, unit etc. (optional)" type="text" required>
                                <div id="errorNotification" style="display: none;" class="error-notification"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Country: *</span>
                        <div class="col-md-9">
                            <input name="addcountry" type="hidden" value="99">
                          <input class="form-control" type="text" readonly value="India">
                                <div id="errorNotification" style="display: none;" class="error-notification"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">State: *</span>
                        <div class="col-md-9">
                            <select class="select2drop1 form-control" name="addstate" required>
                            <option value="">Please Select State</option>
                                <?php
                                $st_query=mysqli_query($conn, "SELECT * FROM `state_list` WHERE `country_id`='99' order by `state` asc ");
                                while ($state=mysqli_fetch_array($st_query)){
                                ?>
                                    <option value="<?= $state['id']; ?>">
                                        <?= $state['state']; ?></option>

                                <?php
                                }
                                ?>
                            </select>
                                <div id="errorNotification" style="display: none;" class="error-notification"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">City: *</span>
                        <div class="col-md-9">
                            <input name="addcity" placeholder="Town / City" type="text" class="form-control" required>
                                <div id="errorNotification" style="display: none;" class="error-notification"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Zip Code: *</span>
                        <div class="col-md-9">
                            <input name="addzip" placeholder="Postcode / ZIP" type="text" class="form-control" required>
                                <div id="errorNotification" style="display: none;" class="error-notification"></div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <button class="btn-animation w-100 justify-content-center btn btn-primary btn-rounded"
                            name="submit" id="submit" type="submit">Add Agent</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php include('includes/footer.php'); ?>
    <script>
    $("#formadd").on("submit", function(e) {
        e.preventDefault();
        actionUrl = 'ajax/add-agent.php';
        formData = $(this).serialize();

        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                if (data.status == 'success') {
                    window.location.href = 'agent-list.php';
                }
                if (data.status == 'error') {
                   $('#errorNotification').html(data.message).css('color', 'red').show();

                    setTimeout(function() {
                        $('#errorNotification').hide();
                    }, 3000);
                }
                $('#closeModel').click();
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
    </script>