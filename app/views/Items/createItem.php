<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php'); ?>

<div class="container">
<br>
<br>
<h2>New Item Listing</h2>
<form method="post" action="/Items/newItem" class="form-horizontal" enctype="multipart/form-data">
	<div class="form-group">
	<label for="name">Name</label>
	<input type="text" class="form-control" required="true" name="name" id="name" />
	</div>
	<div class="form-group">
	<label for="description">Description</label>
	<input type="text" class="form-control" required="true" name="description" id="description" />
	</div>
	<div class="form-group">
	<label for="image_path">Image</label><br/>
	<input type="file" name="fileToUpload" id="fileToUpload" class="form-control btn-primary">
	</div>
	<div class="form-group">
	<label for="price">Price Per Day</label>
	<input type="number" class="form-control" required="true" name="price" id="price" min="0"/>
	</div>
	<div class="form-group">
	<label for="category">Category</label>
<select class='form-control' required='true' name='category' id='category' >
	<?php
		foreach($data['category'] as $category){
			echo "<option value='$category->id' > $category->name</option>";
		}
	?>
</select>
	</div>
	<div class="form-group">
	<input type="submit" class="btn btn-default" name="action" value="Save new item" />
	</div>
</form>

<div class="form-group">
<a href="/Items/"><button  class="btn btn-default" >Go back</button></a>
</div>
</div>
</body>
</html>