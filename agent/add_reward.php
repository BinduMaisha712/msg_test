<?php
session_start();
include("config/connection.php");
include '../dadmin/functions/common.php';
if (!isset($_SESSION['agentLoginStatus']) || !$_SESSION['agentLoginStatus']) { ?>
<script>
window.location.href = '../agent-account.php';
</script>
<?php }
include('includes/header.php');

date_default_timezone_set("Asia/kolkata");
?>
<style>
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
                    <div class="col-lg-10">
                        <!-- Page Title Start -->
                        <h2 class="page--title h5">Reward</h2>
                        <!-- Page Title End -->
                       
                    </div>
                    <div class="col-lg-2">
                        <!-- Button trigger modal -->
                        <a class="btn btn-success" href="your-rewards.php">
                             Reward List
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </section>



    <!-- Page Header End -->
    <style>
    .shadow-card {
        padding: 5px;
        min-height: 150px;
        border-radius: 20px;
        background: white;
        box-shadow: 20px 20px 60px #bebebe,
            -20px -20px 60px #ffffff;
    }
    </style>

    <section class="main--content" id="main-content">

        <div class="row gutter-20">
            <div class="col-md-12">
                <div class="panel">
                    <!-- Mini Stats Panel Start -->
                    <div class="miniStats--panel">
          
                        
                    </div>
                    <!-- Mini Stats Panel End -->
                </div>

            </div>


        </div>
    </section>

    <?php
    include('includes/footer.php');?>