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
    echo "<h3>Listings<h3>";

    if(count($data['listings']) > 0){
		echo "<table class='table table-striped'>
				<tr>
					<th>Name</th>
					<th>Image</th>
					<th>Description</th>
					<th>Price</th>
					<th>Category</th>
					<th>Rating</th>
					<th>Action</th>
                </tr>";
		foreach($data['listings'] as $listing){
			echo "<tr><td>$listing->name</td>";
			echo "<td><img src='/$listing->image_path' width='100' height='100'></td>";
			echo "<td>$listing->description</td>";
			echo "<td>$ $listing->price</td>";
			echo "<td>$listing->category</td>";
			echo "<td>$listing->rating</td>";
			echo "<td><a href='/Listings/viewItem/$listing->id'>View</a></td>";
		}
		echo "</table>";
	}else{
		echo "<h5>This user has no listings!</h5>";
	}


?>




</div>
</body>

</html>