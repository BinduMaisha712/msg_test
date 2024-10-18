<?php

include('config/connection.php');


if (isset($_POST['submit'])) {

// print_r($_POST);
// die();
    $proid1 = $_POST['proid'];

    $imgid=$_POST['imgid'];

    $imgseq = $_POST['setseq'];

    $imgCount = count($_POST['setseq']);
    for ($i = 0; $i < $imgCount; $i++) {

        mysqli_query($conn, "UPDATE `image` SET `set_seq`='".$_POST['setseq'][$i]."' WHERE id='".$_POST['imgid'][$i]."'");
      
    }
    header("location:set_sequence.php?pid=$proid1");


}
