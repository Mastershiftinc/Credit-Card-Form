<?php

include('functions.php');
$user = new User();

if(!empty($_POST["action"]) && $_POST["action"] == 'send'){
    $user->send();

}if(!empty($_POST["action"]) && $_POST["action"] == 'transactions'){
    $user->transactions();

}


?>
