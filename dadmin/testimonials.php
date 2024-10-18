<?php
include ('includes/header.php');
?>



<style>
    .newccj{
        padding:2px 10px;
    }
</style>
        <!-- Main Container Start -->
        <main class="main--container">
                <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list" data-title="">
                        <table id="recordsListView" >
                            <thead>
                                <tr>
                                <th>S.NO</th>
                                <th>Name</th>
                                <th>Content </th>
                                <th width="140">Created at</th>
                                <th width="110">Status</th>
                                <th width="90">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                $testimonial = mysqli_query($conn, "SELECT * FROM `testimonial` where `trash`='0' ORDER BY `id` DESC");
                            
                            $i = "1";
                            while ($testimonialdata = mysqli_fetch_array($testimonial)) {
                            ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $testimonialdata['name']; ?></td>
                                    <td><?= $testimonialdata['content']; ?></td>
                                    <td><?= $testimonialdata['date_time']; ?></td>
                                    <td>
                                        <div class="form-group">
                                            <select name="testiSts" class="form-control testiSts ct newccj" data-id="<?= $testimonialdata['id']; ?>">
                                                <option value="1" <?= ($testimonialdata['status'] == '1') ? 'selected' : ''; ?>>Active</option>
                                                <option value="0" <?= ($testimonialdata['status'] == '0') ? 'selected' : ''; ?>>Inactive</option>
                                            </select>
                                        </div>
                                    </td>
                                        <td >
                                            <div class="d-flex">
                                                <a href="edit-testimonial.php?<?= $urltoken . $urltoken ?>&&testi=<?= $testimonialdata['id']; ?>&&<?= $urltoken . $urltoken ?>" class="mx-1 btn btn-primary"><i class="fa fa-md fa-edit"></i> </a>
                                                <a href="javascript:;" class="mx-1 btn btn-danger testDltBtn" data-id="<?= $testimonialdata['id']; ?>"><i class="fa fa-md fa-trash"></i> </a>
                                            </div>
                                        </td>

                                </tr>
                            <?php
                            };
                            ?>


                        </tbody>
                        </table>
                    </div>
                    <!-- Records List End -->
                </div>
            </section>
            <!-- Main Content End -->

<!-- Main Footer Start -->
<?php include('includes/footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            
<script>
$(document).on("change", ".testiSts", function () {
    var testiid = $(this).attr("data-id");
    var sts = $(this).val();
    $.ajax({
        url: "ajax/testimonial.php",
        type: "POST",
        async: false,
        data: {
            testiid: testiid,
            sts: sts,
            formType: "ststesti",
        },
        success: function (data) {
            data = JSON.parse(data);
            if (data.status) {
                swicon = "success";
                msg = data.message;
                srbSweetAlret(msg, swicon);
                window.setTimeout(function () {
                    location.reload();
                }, 300);
            } else {
                swicon = "warning";
                msg = data.message;
                srbSweetAlret(msg, swicon);
            }
        },
    });
});

// Delete Blog

$(document).on("click", ".testDltBtn", function () {
    var testid = $(this).attr("data-id");
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "ajax/testimonial.php",
                type: "POST",
                async: false,
                data: {
                    testid: testid,
                    formType: "dltTest",
                },
                success: function (data) {
                    data = JSON.parse(data);
                     console.log('evt');
                    if (data.status) {
                        console.log('sfsdf');
                        swicon = "success";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                       setTimeout(() => {
                            window.location.reload(); // Reload the page
                        }, 3500);
                    } else {
                        swicon = "warning";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                    }
                },
            });
        }
    });

});

</script>
     <script>
        function srbSweetAlret(msg, swicon) {
    msg = msg;
    swicon = swicon;
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: swicon,
        title: msg
    })
}
    </script>
