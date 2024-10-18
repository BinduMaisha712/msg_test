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
                <h3 style="border-bottom: 1px solid #ddd;">CHANGE REWARD STRUCTURE</h3>
                <?php
                $query = "SELECT min_amt, percent FROM admin_rewards WHERE id = 1";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $min_amt1 = $row['min_amt'];
                    $percent1 = $row['percent'];
                } else {
                    // If no records found, initialize variables with default values or leave them empty
                    $min_amt1 = '';
                    $percent1 = '';
                }
                ?>
                <section class="">
                    <form action="" method="post" id="form1">
                        <div class="row align-items-center">
                            <div class="col-3">
                                <label for="min1" class="label-text col-form-label">Amount</label>
                                <input type="number" value="<?php echo $min_amt1; ?>" required class="form-control" name="min1" id="min1">
                            </div>
                            <div class="col-3">
                                <label for="dis1" class="label-text col-form-label">Reward Point %</label>
                                <input type="number" required value="<?php echo $percent1; ?>" class="form-control" name="dis1" id="dis1">
                            </div>
                            <div class="col-3 text-center">
                                <label>
                                    <button class="btn btn-success btn-md" id="sub1">Submit</button>
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
        if (isset($_POST['min1']) && isset($_POST['dis1'])) {
            // Retrieve form values
            $min1 = $_POST['min1'];
            $dis1 = $_POST['dis1'];

            // Insert data into the database
            $query = mysqli_query($conn, "UPDATE admin_rewards SET min_amt = $min1, percent = $dis1 WHERE id = 1");
            if ($query) {
                echo "<script>window.location.href= 'change-reward-structure.php'</script>";
            } else {
                echo "Error:" . mysqli_error($conn);
            }
        }
    }

    ?>

    <!-- Main Footer Start -->
    <?php include('includes/footer.php'); ?>

    <!-- Main Footer End -->