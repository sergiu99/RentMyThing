<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php'); ?>
<div class="container">
<br>
<?php 
    $user = $data['user'];
    echo "<h3>$user->display_name's profile</h3><br>";
    echo "<h5>Contact Information</h5>";
    if($user->phone_number == ""){
        echo "<p><strong>Phone Number: </strong> Not Available&nbsp;&nbsp;&nbsp;&nbsp;";
    }else{
        echo "<p><strong>Phone Number: </strong> $user->phone_number&nbsp;&nbsp;&nbsp;&nbsp;";
    }
    $address = "";
    if($user->street_address != ""){
        $address = $user->street_address;
    }
    if($address == ""){
        $address ==  $user->city_address . ', ' . $user->province_address;
    }else{
        $address .=  ', ' . $user->city_address . ', ' . $user->province_address;
    }
    echo "<strong>Address: </strong> $address</p>";
?>
</div>
</body>

</html>