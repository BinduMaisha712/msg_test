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
                            <h6 class="h6">VIEW SEOPAGE</h6>
                        </div>
        <table id="example">
          <thead>
            <tr>
              <th>Sr.No</th>
              <th>Page Name</th>
              <th>title</th>
              <th>Status</th>
              <th>View</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query=mysqli_query($conn,"SELECT * FROM `seopages` WHERE pid='No' AND status='Active' ORDER BY id  ASC");
            $sr=1;
            while($data=mysqli_fetch_array($query))
            {
              ?>
              <tr>
                <td><?php echo $sr ?></td>                            
                <td><?php if($data['page_name']=='index'){ echo ucfirst('home');}else{ echo ucfirst($data['page_name']);}?></td>
                <td><?php echo $data['title'];?></td>
                <td>
                 <?php

                 if( $data['status']=='Active' ){
                  ?>
                  Active 
                  <?php
                }
                else
                { 
                 ?>
                 Inactive  
                 <?php
               }


               ?>                                       
             </td>
             <td> 
              <a href="add-meta.php?id=<?php echo $data['id']; ?>" > 
                <button class="btn btn-success">View/Edit</button> </a> </td>
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
