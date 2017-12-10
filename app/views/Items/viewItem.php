<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php');
$item = $data['item'];
 ?>

<div class="container">
<br>
<br>
<h2>Item Listing </h2>
	
<table class="table table-striped">
	<tr>
		<th>Name</th>
		<th>Image</th>
		<th>Description</th>
		<th>Price</th>
		<th>Category</th>
		<th>Rating</th>
		<th>Status</th>
	</tr>
	
	<?php
		echo "<tr><td>$item->name</td>";
		echo "<td><img src='/$item->image_path' width='100' height='100'></td>";
		echo "<td>$item->description</td>";
		echo "<td>$ $item->price</td>";
		echo "<td>$item->category</td>";
		if($item->rating == null){
			echo "<td>N/A</td>";
		}else{
			echo "<td>$item->rating/5</td>";
		}
		echo "<td>$item->status</td>";
	
	?>
</table>
	<div class="form-group">

<?php echo "<a href='/Items/editItem/$item->id'><button  class='btn btn-default'>Edit Item</button></a>" ?>
	</div>
<div class="form-group">

<a href="/Items/"><button  class="btn btn-default" >Go back</button></a>
</div>
</div>
</body>
</html>