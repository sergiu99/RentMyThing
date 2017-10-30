<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php'); ?>
<div class="container">
<h1>Items</h1>
<form method="get" action="/Items/search" class="form-inline">
<div class="form-group">
<label for="q">Search by name of item   </label>
<input style="margin-left: 10px;" type="text" class="form-control" name="q" id="q" />
</div>
<div class="form-group">
<input style="margin-left: 10px;" type="submit" class="btn btn-default" name="action" value='search' />
</div>
</form><br>
<br>


<table class="table table-striped">
	<tr>
		<th>Name</th>
		<th>Description</th>
		<th>Price</th>
		<th>Category</th>
		<th>Rating</th>
		<th>Status</th>
	</tr>
	<?php
	foreach($data['items'] as $item){
		echo "<tr><td>$item->name</td>";
		echo "<td>$item->description</td>";
		echo "<td>$item->price</td>";
		echo "<td>$item->category</td>";
		echo "<td>$item->rating</td>";
		echo "<td>$item->status</td>";
		echo "<td><a href='/Items/delete/$item->id'>DELETE!!!!!</a></td></tr>";
			echo "<td><a href='/Items/delete/$item->id'>DELETE!!!!!</a></td></tr>";
	}
	?>
</table>



<div>
</body>
</html>