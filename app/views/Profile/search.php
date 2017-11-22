<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php'); ?>
<div class="container">
<br>
<form method="post" action="/Profile/search" class="form-inline" id="searchAction">
	<div class="form-group" id="searchForm">
		<label for="type">Search for &nbsp;</label>
        <select class="form-control" id="type" name="type" onchange="selectChange()">
			<option value="users">Users</option>
			<option value="listings">Listings</option>
		</select>&nbsp;&nbsp;with keyword&nbsp;
		<input style="margin-left: 10px;" type="text" class="form-control" name="keyword" id="keyword" placeholder="Keyword"/>
</div>
<div class="form-group">
<input style="margin-left: 10px;" type="submit" class="btn btn-default" name="submit" value='Search'/>
</div>
</form>
<br><h2>Users</h2><br>
</br>
	<?php
    //TODO Display users
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
		echo "<h3>No users were found!</h3>";
	}
	?>
</div>
</body>

<script type="text/javascript">
	var categories = "<?php 
						$categories = "";
						foreach($data['categories'] as $aCategory){
							$categories .= "<option value='$aCategory->name'>$aCategory->name</option>";
						}
						echo $categories;
					?>";
	function selectChange(){
		if(document.getElementById("type").value == "listings"){
			console.log(document.getElementById("searchAction").action);
			document.getElementById("searchAction").action="/Listings/search";
			document.getElementById("searchForm").innerHTML="<label for='type'>Search for &nbsp;</label>";
			document.getElementById("searchForm").innerHTML+="<select class='form-control' id='type' name='type' onchange='selectChange()'><option value='listings'>Listings</option><option value='users'>Users</option></select>&nbsp;&nbsp;with keyword&nbsp;";
			document.getElementById("searchForm").innerHTML+="<input style='margin-left: 10px;' type='text' class='form-control' name='keyword' id='keyword' placeholder='Keyword'/>&nbsp;&nbsp;in&nbsp;&nbsp;";
			var selectCategoryList = "<select class='form-control' id='category' name='category'><option disabled selected>Category</option>" + categories + "</select>";
			document.getElementById("searchForm").innerHTML+= selectCategoryList;
		}else{
			document.getElementById("searchForm").innerHTML='';
			document.getElementById("searchAction").action="/Profile/search";
			document.getElementById("searchForm").innerHTML="<label for='type'>Search for &nbsp;</label>";
			document.getElementById("searchForm").innerHTML+="<select class='form-control' id='type' name='type' onchange='selectChange()'><option value='users'>Users</option><option value='listings'>Listings</option></select>&nbsp;&nbsp;with keyword&nbsp;";
			document.getElementById("searchForm").innerHTML+="<input style='margin-left: 10px;' type='text' class='form-control' name='keyword' id='keyword' placeholder='Keyword'/>";
		}
	}
</script>

</html>