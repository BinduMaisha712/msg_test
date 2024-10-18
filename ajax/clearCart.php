<?php
require('../config.php');

$data = array();

// session_start();

    if($cart->clearCart()){
        $data['status'] = true;
        $data['result'] = 'Removed all items from Cart!';

    }else{
        $data['status'] = false;
        $data['result'] = 'Error Occur! Please try again';

    }

echo json_encode($data);

?>