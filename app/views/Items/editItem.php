<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php');
$item = $data['item'];
 ?>

<div class="container">
<br>
<br>
<h2>Edit Item Listing </h2>
<?php echo"<form method='post' action='/Items/editItem/$item->id' class='form-horizontal' enctype='multipart/form-data'>"?>
	<div class="form-group">
	<label for="name">Name</label>
	<?php echo"<input type='text' class='form-control' required='true' name='name' id='name' value='$item->name' />" ;?>
	</div>
	<div class="form-group">
	<label for="description">Description</label>
	<?php echo"<input type='text' class='form-control' required='true' name='description' id='description' value='$item->description' />" ;?>
	</div>
	<div class="form-group">
	<label for="image_path">Image</label><br/>
	<input type="file" name="fileToUpload" id="fileToUpload" class="form-control btn-primary">
	</div>
	<div class="form-group">
	<label for="price">Price Per Day</label>
	<?php echo"<input type='number' class='form-control' required='true' name='price' id='price' value='$item->price'  min='0'/>" ;?>
	</div>
	<div class="form-group">
	<label for="category">Category</label>

	<select class='form-control' required='true' name='category' id='category' >

	<?php
		foreach($data['category'] as $category){
			if($item->category ==  $category->id){
				echo "<option value='$category->id' selected> $category->name</option>";
			}else{
				echo "<option value='$category->id' > $category->name</option>";
			}
		}
	?>
</select>
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