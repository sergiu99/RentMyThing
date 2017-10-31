<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php'); ?>

<div class="container">
<h2>New Item Listing</h2>
<form method="post" action="/Items/newItem" class="form-horizontal">
	<div class="form-group">
	<label for="name">Name</label>
	<input type="text" class="form-control" name="name" id="name" />
	</div>
	<div class="form-group">
	<label for="description">Description</label>
	<input type="text" class="form-control" name="description" id="description" />
	</div>
	<div class="form-group">
	<label for="image_path">Image</label>
	<input type="text" class="form-control" name="image_path" id="image_path" />
	</div>
	<div class="form-group">
	<label for="price">Price</label>
	<input type="text" class="form-control" name="price" id="price" />
	</div>
	<div class="form-group">
	<label for="category">Category</label>
	<input type="text" class="form-control" name="category" id="category" />
	</div>
	<div class="form-group">
	<input type="submit" class="btn btn-default" name="action" value="Save new item" />
	</div>
</form>


</div>
</body>
</html>