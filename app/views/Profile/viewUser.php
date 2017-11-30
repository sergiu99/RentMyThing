<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php'); ?>
<div class="container">
<br>
<?php 
    $user = $data['user'];
    echo "<h3>$user->display_name's profile</h3>";
	echo "<h5>Contact Information</h5>";
	if($user->show_email == 0){
		echo "<p><strong>Email: </strong> Not Available&nbsp;&nbsp;&nbsp;&nbsp;";
	}else{
		echo "<p><strong>Email: </strong> $user->email&nbsp;&nbsp;&nbsp;&nbsp;";
	}
    if($user->phone_number == "" || $user->show_phone == 0){
        echo "<strong>Phone Number: </strong> Not Available&nbsp;&nbsp;&nbsp;&nbsp;";
    }else{
        echo "<strong>Phone Number: </strong> $user->phone_number&nbsp;&nbsp;&nbsp;&nbsp;";
    }
    $address = "";
    if($user->street_address == "" || $user->show_address == 0){
        $address = "Not Available";
    }else{
		$address = $user->street_address;
	}
    if($address == ""){
        $address ==  $user->city_address . ', ' . $user->province_address;
    }else{
        $address .=  ', ' . $user->city_address . ', ' . $user->province_address;
    }
    echo "<strong>Address: </strong> $address</p>";
    echo "<h3>Listings</h3>";

    if(count($data['listings']) > 0){
		$favorites = $data['favorites'];
		echo "<table class='table table-striped'>
		<tr>
			<th>Name</th>
			<th>Image</th>
			<th>Description</th>
			<th>Price/Day</th>
			<th>Category</th>
			<th>Rating</th>
			<th>Favorite</th>
			<th>View</th>
		</tr>";
		foreach($data['listings'] as $listing){
			echo "<tr><td>$listing->name</td>";
			echo "<td><img src='/$listing->image_path' width='100' height='100'></td>";
			echo "<td>$listing->description</td>";
			echo "<td>$ $listing->price</td>";
			echo "<td>$listing->category</td>";
			echo "<td>$listing->rating</td>";
			if(in_array($listing->id, $favorites)){
				echo "<td><input type='checkBox' id='favorite$listing->id' checked onclick='setFavorite($listing->id)'/></td>";
			}else{
				echo "<td><input type='checkBox' id='favorite$listing->id' onclick='setFavorite($listing->id)'/></td>";
			}
			echo "<td><a href='/Listings/viewItem/$listing->id'>View</a></td>";
		}
		echo "</table>";
	}else{
		echo "<h5>This user has no listings!</h5>";
	}


?>

<script>
	function setFavorite(id){
		var urlString = "";
		if(document.getElementById("favorite" + id).checked == true){
			urlString = "/Favorites/setFavorite?item=" + id;
		}else{
			urlString = "/Favorites/removeFavorite?item=" + id;
		}
		$.ajax({
			type: "POST",
			url: urlString
		}).done(function (data){
			console.log(data);
		});
	}
</script>
</div>
</body>

</html>