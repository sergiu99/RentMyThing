<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php'); ?>
<div class="container">
<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/search.php'); ?>
<br><h2>Your Favorites</h2><br>
	<?php
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
					<th>Action</th>
				</tr>";
		foreach($data['items'] as $item){
			echo "<tr id='row$item->id'><td>$item->name</td>";
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
			echo "<td><a href='/Listings/viewItem/$item->id'>View</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='/Favorites/removeFavoriteWithId/$item->id'>Remove</a></td>";
		}
		echo "</table>";
	}else{
		echo "<h3>You have no favorites!</h3>";
	}
	?>
</div>
</body>
</html>