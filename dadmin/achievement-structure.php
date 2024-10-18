<?php
// error_reporting(0);


include("config/connection.php");
include('includes/header.php');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


date_default_timezone_set("Asia/kolkata");
?>
<style type="text/css">
h4,
.h4 {
    font-size: 15px;
}

.miniStats--num {
    margin-top: 2px;
    font-size: 26px;
    line-height: 26px;
    font-weight: 600;
}
</style>
<!-- Main Container Start -->
<main class="main--container">
    <!-- Page Header Start -->
    <!-- Page Header Start -->
    <section class="page--header">
        <div class="container-fluid">
            <form action="" method="post">
                <div class="row">
                    <div class="col-lg-2">
                        <!-- Page Title Start -->
                        <h2 class="page--title h5">Achievement</h2>
                        <!-- Page Title End -->

                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active"><span>Achievement Structure</span></li>
                        </ul>

                    </div>
                    <form action="" method="post" id="form">
                        <div class="col-lg-4">
                            <!-- Page Title Start -->
                            <div class="row form-group">
                                <div class="col-md-3" align="right">
                                </div>
                                <div class="col-md-9">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 text-right">
                            <a class="btn btn-success" href="change-achievement-structure.php">Change Achievement Structure</a>
                        </div>
                    </form>
                </div>
            </form>
        </div>
    </section>
    <!-- Page Header End -->


    <section class="main--content" id="main-content">

        <div class="row gutter-20">
            <?php
            $query=mysqli_query($conn,"SELECT * FROM achievement_structure");
            $sr=1;
            while($data=mysqli_fetch_array($query))
            {
                ?>
            <div class="col-md-4">
                <div class="panel">
                    <!-- Mini Stats Panel Start -->
                    <div class="miniStats--panel">
                        <a href="javascript:;" id="completeorder">
                            <div class="miniStats--header bg-darker">

                                <p class="miniStats--label text-white bg-success">
                                    <i class="fas fa-level-down-alt"></i>
                                    <span>Stage <?php echo $sr ?></span>
                                </p>
                            </div>
                        </a>
                        <div class="miniStats--body">
                            <i class="miniStats--icon fas fa-ticket-alt text-success"></i>
                            <a href="javascript:;" id="completeorder1">
                                <p class="miniStats--caption text-success" style="margin-top: -24px;"> &nbsp;</p>
                                <h3 class="miniStats--title h4"><?php echo $data['min_amount'];?> -
                                    <?php echo $data['max_amount'];?> (Expense)</h3>
                            </a>
                            <p class="miniStats--num text-success"><?php echo $data['achievement'];?></p>
                        </div>
                    </div>
                    <!-- Mini Stats Panel End -->
                </div>

            </div>
            <?php
            $sr++;
            }
            ?>
        </div>
    </section>

    <?php
  include('includes/footer.php');
  ?>