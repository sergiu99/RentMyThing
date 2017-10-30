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
		<th>Image</th>
		<th>Price</th>
		<th>Category</th>
		<th>Rating</th>
		<th>Status</th>
	</tr>
	<?php
	foreach($data['items'] as $item){
		echo "<tr><td>$item->name</td>";
		echo "<td>$item->description</td>";
		echo "<td>$item->image_path</td>";
		echo "<td>$item->price</td>";
		echo "<td>$item->category</td>";
		echo "<td>$item->rating</td>";
		echo "<td>$item->status</td>";
		echo "<td><a href='/Items/delete/$item->ID'>DELETE!!!!!</a></td></tr>";
	}
	?>
</table>

<form method="post" action="/Items/newItem" class="form-horizontal">
	<div class="form-group">
	<label for="firstName">First Name</label>
	<input type="text" class="form-control" name="firstName" id="firstName" />
	</div>
	<div class="form-group">
	<label for="lastName">Last Name</label>
	<input type="text" class="form-control" name="lastName" id="lastName" />
	</div>
	<div class="form-group">
	<label for="email">Email</label>
	<input type="text" class="form-control" name="email" id="email" />
	</div>
	<div class="form-group">
	<label for="phone">Phone</label>
	<input type="text" class="form-control" name="phone" id="phone" />
	</div>
	<div class="form-group">
	<label for="country">Country</label>
	<input type="text" class="form-control" name="country" id="country" />
	</div>
	<div class="form-group">
	<input type="submit" class="btn btn-default" name="action" value="Save new item" />
	</div>
</form>


<div>
</body>
</html>