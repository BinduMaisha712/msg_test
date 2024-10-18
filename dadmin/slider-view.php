<?php include('includes/header.php'); ?>
<style>
    .btn{
    width: 34%;
    font-size: 12px;
    padding: 10px;
    }
    table.dadmin-tbl tr {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-gap: 10px;
}
</style>
<main class="main--container">
    <section class="main--content">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Slider Image</h3>
            </div>

            <div class="panel-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-cells-middle dadmin-tbl" style="border: hidden;">
                        <thead class="text-dark"></thead>
                        <tbody>
                            <tr>
                                <?php
                                    $query=mysqli_query($conn,"SELECT * FROM `slider`");
                                    $sr=1;
                                    while($data=mysqli_fetch_array($query))
                                    {
                                        $sr++;   ?>                 
                                        <td style="border: hidden;"><img src="../asset/image/banners/<?php echo $data['image']; ?>" width="150px" height="150px"><br><br>
                                            <?php
                                            if( $data['status']=='Active' )
                                            { ?>
                                                <a class="btn btn-success btn-md" href="slider-status.php?sid=<?php echo $data['id'].'&Active=Inactive'; ?>" onClick="return confirm('are you sure you want to Inactive this products')">Active</a> 
                                            <?php
                                            }
                                            else
                                            {  ?>
                                                <a class="btn btn-danger" href="slider-status.php?sid=<?php echo $data['id'].'&Active=Active';?>" onClick="return confirm('are you sure you want to Active this products')">Inactive</a> 
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <?php 
                                    } ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

<?php include('includes/footer.php'); ?>