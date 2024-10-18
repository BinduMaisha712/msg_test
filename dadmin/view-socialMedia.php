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
                            <h6 class="h6">VIEW SOCIAL MEDIA</h6>
                        </div>
        <table id="example">
          <thead>
            <tr>
              <th>Sr.No</th>
              <th>Social Media Name</th>
              <th>Icon</th>
              <th>Url</th>
              <th>Status</th>
              <th>View</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query=mysqli_query($conn,"SELECT * FROM `social_media`  ORDER BY id  DESC");
            $sr=1;
            if(mysqli_num_rows($query)>0)
            {
            while($data=mysqli_fetch_array($query))
            {
              ?>
              <tr>
                <td><?php echo $sr ?></td>                            
                <td><?= $data['name']?></td>
                <td><i class="<?= $data['icon']?>"></i></td>
                <td><?php echo $data['url'];?></td>
                <td id="status_<?= $data['id']?>">
                 <?php

                 if( $data['status']=='Active' ){
                  ?>
                 <a class="btn btn-success" href="#" onClick="changeStatus(<?= $data['id']?>,'Inactive')">Active</a> 
                  <?php
                }
                else
                { 
                 ?>
                   <a class="btn btn-danger" href="#" onClick="changeStatus(<?= $data['id']?>,'Active')">Inactive</a>
                 <?php
               }


               ?>                                       
             </td>
             <td> 
              <a href="add-socialMedia.php?id=<?php echo $data['id']; ?>" > 
                <button class="btn btn-success">Edit</button> </a> </td>
                <td> 
                </tr>

                <?php  $sr++; }
                } ?>

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

      <script type="text/javascript">

        function changeStatus(id,status)
        {
         
          var x= confirm('Are You Sure you want to '+status+' this media');
         if(x==true)
         {
            $.ajax({
            url: 'media-status.php',
            type: 'POST',
            data: {Active:status,id:id},
            // dataType: 'json',
            success: function (data) {
              if(status=='Active')
              {
                var status1="'Inactive'";
              $('#status_'+id).html('<a class="btn btn-success" href="#" onClick="changeStatus('+id+','+status1+')">'+status+'</a');
            }
            else
            {
              var status1="'Active'";
              $('#status_'+id).html('<a class="btn btn-danger" href="#" onClick="changeStatus('+id+','+status1+')">'+status+'</a');
            }


            }
          })
         }
        }
      </script>
