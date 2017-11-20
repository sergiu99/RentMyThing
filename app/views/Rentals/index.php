<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php'); ?>
<div class="container">
<br>
<h1>Rentals</h1>

<br>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<h3>Items that you are renting</h3>

<table class="table table-striped">
	<tr>
		<th>Name</th>
		<th>Image</th>
		<th>Description</th>
		<th>Total Price</th>
		<th>Start Date</th>
		<th>End Date</th>
		<th>Status</th>
		<th>Action</th>
		<th></th>
		<th></th>
	</tr>
	
	<?php
	foreach($data['myRentals'] as $item){
		echo "<tr><td>$item->name</td>";
		echo "<td><img src='/$item->image_path' width='100' height='100'></td>";
		echo "<td>$item->description</td>";
		echo "<td>$ $item->price</td>";
		echo "<td>$item->category</td>";
		echo "<td>$item->rating</td>";
		echo "<td>$item->status</td>";
		echo "<td><a href='/Items/viewItem/$item->id'>View</a></td>";
		echo "<td><a href='/Items/editItem/$item->id'>Edit</a></td>";
		echo "<td><a href='/Items/delete/$item->id'>Delete</a></td></tr>";
	}
	?>
</table>
		</div>
		<div class="col-md-6">
			<h3>Item rental proposals to you</h3>
		</div>
	</div>
</div>

</div>
</body>
</html>