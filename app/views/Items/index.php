<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php'); ?>
<div class="container">
<br>
<h1>Items</h1>
<form method="get" action="/Items/search" class="form-inline">
<div class="form-group">
<label for="q">Search by name of item   </label>
<input style="margin-left: 10px;" type="text" class="form-control" name="q" id="q" />
</div>
<div class="form-group">
<input style="margin-left: 10px;" type="submit" class="btn btn-default" name="action" value='search' />
</div>
</form>
<br>
<div class="form-group">
<a href="/Items/newItem"><button  class="btn btn-default" >Create a new Listing</button></a>
</div>


<table class="table table-striped">
	<tr>
		<th>Name</th>
		<th>Image</th>
		<th>Description</th>
		<th>Price/Day</th>
		<th>Category</th>
		<th>Rating</th>
		<th>Enable</th>
		<th>Action</th>
		<th></th>
		<th></th>
	</tr>
	
	<?php
	foreach($data['items'] as $item){
		echo "<tr><td>$item->name</td>";
		echo "<td><img src='/$item->image_path' width='100' height='100'></td>";
		echo "<td>$item->description</td>";
		echo "<td>$ $item->price</td>";
		echo "<td>$item->category</td>";
		echo "<td>$item->rating</td>";
		if($item->status == "enabled"){
			echo "<td><input type='checkbox' id='checkbox$item->id' onclick='enableCheck($item->id)' checked/></td>";
		}else{
			echo "<td><input type='checkbox' id='checkbox$item->id' onclick='enableCheck($item->id)'/></td>";
		}
		echo "<td><a href='/Items/viewItem/$item->id'>View</a></td>";
		echo "<td><a href='/Items/editItem/$item->id'>Edit</a></td>";
		echo "<td><a href='/Items/delete/$item->id'>Delete</a></td></tr>";
	}
	?>
</table>



</div>
<script>
	function enableCheck(id){
		if(document.getElementById("checkbox" + id).checked == true){
			$.ajax({
                type: "GET",
            	url: "/Items/setStatus?itemId=" + id + "&status=enabled"
            });
		}else{
			$.ajax({
                type: "GET",
            	url: "/Items/setStatus?itemId=" + id + "&status=disabled"
            }).done(function (){
            });;
		}
	}
</script>

</body>
</html>