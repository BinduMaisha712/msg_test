<?php

include ('includes/header.php');
?>
<style>
.padd-20{
    padding:30px 8px;
}
 .trckbtn{
    font-size: 11px !important;
    padding: 5px 12px !important;
    }
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
<!-- Main Container Start -->
<main class="main--container">
    <!-- Main Content Start -->
    <section class="main--content">
        <div class="panel">
            <!-- Records List Start -->
            <div class="records--list" data-title="Wallet Transactions">
<div class="table-responsive padd-20">
  <table id="example" class="display nowrap" cellspacing="0" width="100%">
      <thead>
          <tr>
              <th>#</th>
              <th>Order ID</th>
              <th>Payment Mode</th>
              <th>Order Total</th>
              <th>Shipping Charge</th>
              <th>Order Date</th>
              <!-- <th>Invoice</th> -->
          </tr>
      </thead>
      <tbody>
          <?php
          $i=0;
          $agentid=$_SESSION['agent_loginid']; 
          $userid = mysqli_query($conn, "SELECT id FROM `user` WHERE agt_id='$agentid'");
          $loginus = mysqli_fetch_assoc($userid);
          $loginid=$loginus['id'];
          $sqql = mysqli_query($conn, "SELECT * FROM `order_tbl` WHERE ((`payment_type`='Online' || `payment_type`='Pay With Wallet' && `payment_status`='Success') or ( `payment_type`='Cash On Delivery')) AND userid='$loginid' order by id desc");

          while ($row = mysqli_fetch_assoc($sqql)) {
              $or = mysqli_query($conn, "select * from order_status where user_id='$loginid' and order_id='" . $row['order_id'] . "'  order by id DESC");

              $var_or = mysqli_fetch_assoc($or);
              if ($row['payment_status'] == 'Success') {
                  $sta = "( <small><b><font color='green'>Success</font></b></small> )";
              } elseif ($row['payment_status'] == 'Cancel') {
                  $sta = "( <small><b><font color='red'>Cancelled</font></b></small> )";
              } else {
                  $sta = "( <small><b id='payment_status_" . $row['order_id'] . "'>" . $row['payment_status'] . "</b></small> )";
              }
              $i++;
          ?>
              <tr data-child-value="<?= $row['id']; ?>">
                  <td class="details-control"><i class="fa fa-plus"></i></td>
                  <td><?= $row['order_id']; ?>
                  </td>

                  <td><?php if ($row['payment_type'] == 'Online') {
                          echo "Online" . $sta;
                      } else if($row['payment_type'] == 'Pay With Wallet'){
                          echo "Pay With Wallet ".$sta;
                      } else {
                          echo "Cash On Delivery " . $sta;
                      } ?>
                  </td>
                  <td><?= $currency; ?> <span data-id="<?= $row['orderprice']; ?>" id="totalPrice_<?= $var_or['order_id']; ?>"><?= number_format($row['orderprice'], 2); ?></span>
                  </td>
                  <td><?= $currency; ?> 100</td>
                  <td><?php echo date('d-m-Y', strtotime($row['date'])); ?></td>
              </tr>

          <?php
          } ?>

      </tbody>
  </table>
  <?php
  $content = '';
  $sqqlq = mysqli_query($conn, "select * from order_tbl where userid='$loginid' order by id desc");
  while ($row = mysqli_fetch_assoc($sqqlq)) {
      $content .= '<span style="display:none;" id="show' . $row['id'] . '"><table style="width: 100%;"><thead><tr><th>#</th><th>Product Name</th><th>Order Status</th><th>Quantity</th><th>Unit Price</th><th>Tax</th><th>Total</th></tr></thead><tbody>';
      $or = mysqli_query($conn, "select * from order_details where order_id='" . $row['order_id'] . "'");
      $totalProductCount = mysqli_num_rows($or);
      $cancelledProductCount = 0;
      $deliveredProCount = 0;
      $order_coupon_details = mysqli_query($conn, "select * from order_coupon_code where order_id='" . $row['order_id'] . "' AND user_id='" . $loginid . "'");
      $sr = 1;
      $cancelledProPrice = 0;
      $o = 1;
      while ($var_or = mysqli_fetch_assoc($or)) {

          $pr = mysqli_query($conn, "select * from products where id='" . $var_or['productid'] . "'");
          $var_pr = mysqli_fetch_assoc($pr);

          $content .= '<tr ';

          $statusQuery = mysqli_query($conn, "select * from order_status where user_id='$loginid' and tracking_id='" . $var_or['tracking_id'] . "'");
          $numStatusResult = mysqli_num_rows($statusQuery);


          $orderSrbFetch = mysqli_fetch_array(mysqli_query($conn, "select od.*, os.tracking_status from order_details od, order_status os where od.order_id='" . $row['order_id'] . "' AND od.order_id = os.order_id AND od.tracking_id=os.tracking_id AND od.productid='" . $var_or['productid'] . "' ORDER BY os.id DESC LIMIT 1;"));

          $productTrackingId = $var_or['tracking_id'];

          if ($orderSrbFetch['tracking_status'] == 'Cancelled') {
              $cancelledProPrice += $var_or['price'] + $var_or['gst'];
              $cancelledProductCount++;
          } else if ($orderSrbFetch['tracking_status'] == 'Delivered') {
              $deliveredProCount++;
              $deliverydatetime=$orderSrbFetch['deldat'].' '.$orderSrbFetch['deltime'];
              $delnewDateTime = date('Y-m-d H:i:s', strtotime($deliverydatetime) + 24 * 3600);
          }

          $content .= '>

          <td>' . $sr++ . '</td>
          <td>' . $var_pr['product_name'] . '</td>  <td>' . $orderSrbFetch['tracking_status'] . '</td>
          <td class="text-center">' . $var_or['quantity'] . '</td>
          <td class="text-center">' . $currency . ' ' . number_format(($var_or['price'] / $var_or['quantity']), 2) . '</td>
          <td class="text-center">' . $currency . number_format($var_or['gst'], 2) . '</td>
          <td class="text-center"> ' . $currency . ' ' . number_format($var_or['price'] + $var_or['gst'], 2) . '</td>
          
          <td class="text-center"><button class="btn dwnld-btn btn-primary trckbtn"';
            if ($numStatusResult > 0 && $row['payment_status'] != 'Failed') {
                $content .= 'style="cursor: pointer;padding:0;" ';

                if (($row['payment_type'] == 'Online' || $row['payment_type'] == 'Pay With Wallet') && ($row['payment_status'] != 'Success')) {
                    $content .= 'onclick="orderTrackingNotAvailable()"';
                } else {
                    $content .= 'onclick="javascript:location.href=\'https://micodetest.com/msg_updated/track-order.php?id=' . $var_or['tracking_id'] . '\'"';
                }
            }
            $content.='>Track</button>
            
            </td>';
            
             $orderSrbFetch1 = (mysqli_query($conn, "select id from refund_order where od_p_id='" . $var_or['id'] . "' "));
        
        if ($orderSrbFetch['tracking_status'] == 'Delivered' &&  date('Y-m-d H:i:s')< $delnewDateTime && mysqli_num_rows($orderSrbFetch1)==0) {
     
                $content .= '<td class="text-right" style="cursor: pointer;padding:0"
                
                ><button class="btn dwnld-btn btn-primary trckbtn refund" id="'.$var_or['id'].'">Refund</button></td></tr>';
            
        }
        else
        {
           $content .='<td></td></tr>'; 
        }
    
            $o++;
        }

  ?>
      <?php echo "<script>
      var totalProduct = " . $totalProductCount . "
      var cancelledProduct = " . $cancelledProductCount . "
      var deliveredPorducts = " . $deliveredProCount . "
      var paymentMode = '" . $row['payment_mode'] . "'
    
      if(totalProduct - cancelledProduct == 0){
         document.getElementById('payment_status_" . $row['order_id'] . "').innerText = 'Cancelled';
      }else if ((deliveredPorducts + cancelledProduct == totalProduct) && paymentMode == 'COD'){
          document.getElementById('payment_status_" . $row['order_id'] . "').innerText = 'Success';
      }
        var totalPrice = document.getElementById('totalPrice_" . $row['order_id'] . "').getAttribute('data-id');
        document.getElementById('totalPrice_" . $row['order_id'] . "').innerText = number_format_js(Number(totalPrice) - Number(" . $cancelledProPrice . "), 2) ;
      
      </script>";
      ?>
  <?php

      // $cancelledProPrice ;

      $getcuopondata = mysqli_fetch_assoc($order_coupon_details);
      if (!empty($getcuopondata)) {
          $content .= '<tr><td></td><td></td><td></td><td>Coupon Apply(' . $getcuopondata['coupon_code'] . ')</td><td> - ' . $currency . ' ' . $getcuopondata['discount_price'] . '</td></tr>';
          $content .= '<tr><td></td><td></td><td></td><td>Total</td><td> ' . $currency . ' ' . $getcuopondata['totalprice'] . '</td></tr>';
      }
      if ($row['invoice_generated'] == 1) { 
                $query23 = "SELECT token from invoice_generate WHERE order_id = '".$row['order_id']."'";
        
                $mysqliQuery = mysqli_query($conn,$query23);
                $num = mysqli_num_rows($mysqliQuery);
             
                if($num > 0){
                    $result = mysqli_fetch_array($mysqliQuery);  
                    $invoiceToken=$result['token'];
                }else{
                    $invoiceToken=NULL;
                }
            
          if ($invoiceToken != null) {
              $content .= '<tr><td></td><td></td><td></td><td></td><td class="text-right" style="cursor: pointer;"
              onclick="window.open(\'https://micodetest.com/msg_updated/invoice.php?oid=' . $row['order_id'] . '\')"
              ><button class="btn dwnld-btn btn-primary">Download Invoice</button></td></tr>';
          }
      }


      $content .= '</tbody></table></span>';
  }

  echo $content;

  ?>

</div>
</div>
            <!-- Records List End -->
        </div>
    </section>
    <!-- Main Content End -->

    <!-- Main Footer Start -->
    <?php include('includes/footer.php'); ?>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('.select2drop1').select2({
            placeholder: 'Please Select State',
        });
    });
</script>

<script>
    function format(value) {
        var firstDivContent = document.getElementById('show' + value);
        var fet = "select * from order_tbl where userid='$loginid' and id='" + value + "' order by id desc";
        var sh = "<div id='p_" + value + "'>" + firstDivContent.innerHTML + "</div>";

        return sh;
    }
    $(document).ready(function() {
        var table = $('#example').DataTable({
            // "lengthMenu": [[1], [1, "All"]],
            language: {
                paginate: {
                    next: '>>',
                    previous: '<<'
                }
            }
        });

        // Add event listener for opening and closing details
        $('#example').on('click', 'td.details-control', function() {
            var tr = $(this).closest('tr');
            console.log(tr);
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(tr.data('child-value'))).show();
                tr.addClass('shown');
            }
        });
    });
</script>


<script>

    function orderTrackingNotAvailable() {
        Swal.fire({
            title: 'Order tracking not available',
            html: "Order tracking is not accessible for pending or cancelled payments. This option becomes available only after payment has been completed, or for cash on delivery transactions.",
            showCancelButton: true,
            type: 'info',
            icon: "info",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            showCancelButton: false,
            confirmButtonText: 'OK'
        });
    }
</script>

<script>
    $(document).on('click', '.refund', function() {
        var id = $(this).attr('id');
        $('#' + id).attr('disabled', true);
        var refundid = id;

        $.ajax({
            url: '../ajax/refund-order.php',
            type: 'POST',
            data: { id: refundid },
            success: function(data) {
                data = JSON.parse(data);

                $('#' + id).hide();

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: data.result,
                    showConfirmButton: false,
                    timer: 3000
                }).then(() => {
                    // Reload the page after the Swal notification disappears
                    location.reload();
                });
            }
        });
    });
</script>


