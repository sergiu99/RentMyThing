<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php'); ?>

<div class="container">
<br>
<br>
<h2>Edit Item Listing</h2>
<form method="post" action="/Items/editItem/<?php $item = $data['user']; echo "$item->id";?>" class="form-horizontal">
	<div class="form-group">
	<label for="name">Name</label>
	<input type="text" class="form-control" required="true" name="name" id="name" />
	</div>
	<div class="form-group">
	<label for="description">Description</label>
	<input type="text" class="form-control" required="true" name="description" id="description" />
	</div>
	<div class="form-group">
	<label for="image_path">Image</label>
	<input type="text" class="form-control" required="true" name="image_path" id="image_path" />
	</div>
	<div class="form-group">
	<label for="price">Price</label>
	<input type="text" class="form-control" required="true" name="price" id="price" />
	</div>
	<div class="form-group">
	<label for="category">Category</label>
	<input type="text" class="form-control" required="true" name="category" id="category" />
	</div>
	<div class="form-group">
	<input type="submit" class="btn btn-default" name="action" value="Update item" />
	</div>
</form>

<div class="form-group">
<a href="/Items/"><button  class="btn btn-default" >Go back</button></a>
</div>
</div>
</body>
</html>