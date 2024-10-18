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
$agent_id = $_SESSION['agent_loginid'];
echo
date_default_timezone_set("Asia/kolkata");
?>
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
                <form action="" method="post" id="payform">
                    <input type="hidden" name="agent_loginid" id="agent_loginid" value="<?php echo $agent_id ?>">
                    <div class="form-group">
                        <span class="col-form-label">Amount: </span>
                        <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount"
                            value="" required>
                    </div>
                    <button id="payBtn" type="submit" class="btn btn-success m-2">Pay</button>
                </form>


            </div>
        </div>
    </section>
    <?php 
    
    include('includes/footer.php');    
    ?>