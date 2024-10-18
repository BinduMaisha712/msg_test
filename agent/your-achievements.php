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
        <!-- Main Content Start -->
        <section class="main--content">
            <div class="panel">
                <!-- Edit Product Start -->
                <div class="records--body">
                    <div class="title">
                        <h6 class="h6">Your Achievement</h6>
                    </div>
                    <!-- Tab Content Start -->
                    <div class="tab-content">
                        <!-- Tab Pane Start -->
                        <div class="tab-pane fade show active" id="tab01">
                            <div class="panel-content">
                                <div class="row">
                                <?php
                                    $agent_id = $_SESSION['agent_loginid'];
                                    // $query = mysqli_query($conn, "SELECT * FROM agent_achievement WHERE `agent_id` = $agent_id GROUP BY agent_achievement ORDER BY id DESC");
                                    // modified logic
                                    $spent_amt = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `spent_amt` FROM `agents` WHERE `id` = '$agent_id';"))['spent_amt'];
                                    $query = mysqli_query($conn, "SELECT `achievement`, `img` FROM `achievement_structure` WHERE `min_amount` < '$spent_amt';");
                                    $sr=1;
                                    while($data=mysqli_fetch_array($query))
                                { 
                                    if ($data['achievement'] != "") {
                                    ?>
                                    <div class="col-lg-4">
                                        <div class="card mb-4">
                                            <div class="card-head">
                                                <?php echo $data['achievement']; ?>
                                            </div>
                                            <?php 
                                                // $img = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM achievement_structure WHERE `achievement` ='" . $data['achievement'] . "'"))['img'];
                                                $img = $data['img'];
                                            ?>
                                            <div class="card-body" style="background: url('<?php echo $img; ?>') no-repeat center center; background-size: cover;width: 100%; height:10rem;">
                                                <!--<img src="<?php //echo $img; ?>" alt="Star Image">-->
                                            </div>
                                        </div>
                                    </div>
                                    <?php }} ?>
                                </div>
                            </div>
                        </div>
                        <!-- Tab Pane End -->
                    </div>
                    <!-- Tab Content End -->
                </div>
                <!-- Edit Product End -->
            </div>
        </section>
        <?php
        include('includes/footer.php');?>