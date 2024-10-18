<?php include ('includes/header.php');
?>
<!-- Main Container Start -->
<main class="main--container">

  <!-- Main Content Start -->
  <section class="main--content">
    <div class="panel">
      <!-- Records List Start -->
<div class="records--body">
                        <div class="title">
                            <h6 class="h6">VIEW HOME CONFIGURATION</h6>
                        </div>
        <table id="example">
          <thead>
            <tr>
              <th>Sr.No</th>
              <th>Name</th>
              <th>View</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query=mysqli_query($conn,"SELECT * FROM `home` ORDER BY id  ASC");
            $sr=1;
            while($data=mysqli_fetch_array($query))
            {
              ?>
              <tr>
                <td><?php echo $sr ?></td>                            
                <td><?= ucwords($data['name']);?></td>
             <td> 
              <a href="edit-home.php?id=<?php echo $data['id']; ?>" > 
                <button class="btn btn-success">Edit</button> </a> </td>
                <td> 
                </tr>

                <?php  $sr++; } ?>

              </tbody>
            </table>
          </div>
          <!-- Records List End -->
        </div>
      </section>
      <!-- Main Content End -->

      <!-- Main Footer Start -->
      <?php include('includes/footer.php'); ?>

      <script type="text/javascript">
        $(document).ready(function() {
    $('#example').DataTable();
} );
      </script>
