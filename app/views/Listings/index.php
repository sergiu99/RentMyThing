<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php'); ?>
<div class="container">

<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/search.php'); ?>

<br><h2>Listings</h2><br>
	<?php
	$favorites = $data['favorites'];
	if(count($data['items']) > 0){
		echo "<table class='table table-striped'>
				<tr>
					<th>Name</th>
					<th>Image</th>
					<th>Description</th>
					<th>Price/Day</th>
					<th>Category</th>
					<th>Postal Code</th>
					<th>Rating</th>
					<th>Favorite</th>
					<th>View</th>
				</tr>";
		foreach($data['items'] as $item){
			echo "<tr><td>$item->name</td>";
			echo "<td><img src='/$item->image_path' width='100' height='100'></td>";
			echo "<td>$item->description</td>";
			echo "<td>$ $item->price</td>";
			echo "<td>$item->category</td>";
			$postalcode = strtoupper ($item->postal_code);
			echo "<td>$postalcode</td>";
			if($item->rating == null){
				echo "<td>N/A</td>";
			}else{
				echo "<td>$item->rating/5</td>";
			}
			
			if(in_array($item->id, $favorites)){
				echo "<td><input type='checkBox' id='favorite$item->id' checked onclick='setFavorite($item->id)'/></td>";
			}else{
				echo "<td><input type='checkBox' id='favorite$item->id' onclick='setFavorite($item->id)'/></td>";
			}
			echo "<td><a href='/Listings/viewItem/$item->id'>View</a></td>";
		}
		echo "</table>";
	}else{
		echo "<h3>No listings were found!</h3>";
	}
	?>
</div>
</body>

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
</html>