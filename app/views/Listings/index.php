<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php'); ?>
<div class="container">
<br>
<h1>Listings</h1></br>
<form method="post" action="/Listings/search" class="form-inline">
<div class="form-group">
<label for="categories">Search for &nbsp;</label>
<select class="form-control" id="category" name="category">
	<?php
		$category = $data['category'];
		if($category != ""){
			echo "<option disabled>Category $category</option>";
			foreach($data['categories'] as $aCategory){
				if($aCategory->name == $category){
					echo "<option value='$aCategory->name' selected>$aCategory->name</option>";
				}else{
					echo "<option value='$aCategory->name'>$aCategory->name</option>";
				}
			}
		}else{
			echo "<option disabled selected>Category</option>";
			foreach($data['categories'] as $aCategory){
				echo "<option value='$aCategory->name'>$aCategory->name</option>";
			}
		}
		echo "</select>";
		if(isset($data['keyword'])){ 
			$keyword = $data['keyword'];
			echo "<input style='margin-left: 10px;' type='text' class='form-control' name='keyword' id='keyword' placeholder='$keyword'/>";
		}else{
			echo "<input style='margin-left: 10px;' type='text' class='form-control' name='keyword' id='keyword' placeholder='Keyword'/>";
		}
	?>
</div>
<div class="form-group">
<input style="margin-left: 10px;" type="submit" class="btn btn-default" name="action" value='Search'/>
</div>
</form>
<br>


	<?php
	if(count($data['items']) > 0){
		echo "<table class='table table-striped'>
				<tr>
					<th>Name</th>
					<th>Image</th>
					<th>Description</th>
					<th>Price</th>
					<th>Category</th>
					<th>Postal Code</th>
					<th>Rating</th>
					<th>Action</th>
				</tr>";
		foreach($data['items'] as $item){
			echo "<tr><td>$item->name</td>";
			echo "<td><img src='/$item->image_path' width='100' height='100'></td>";
			echo "<td>$item->description</td>";
			echo "<td>$ $item->price</td>";
			echo "<td>$item->category</td>";
			$postalcode = strtoupper ($item->postal_code);
			echo "<td>$postalcode</td>";	
			echo "<td>$item->rating</td>";
			echo "<td><a href='/Listings/viewItem/$item->id'>View</a></td>";
		}
		echo "</table>";
	}else{
		echo "<h3>No listings were found!</h3>";
	}
	?>
</div>
</body>
</html>