<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php'); ?>

<div class="container">
<br>
<br>

<form method="post" action="/Rentals/createComment" class="form-horizontal" enctype="multipart/form-data">

<?php

$rental = $data['RentalObject'];

echo "<h2>Leave a comment for the rental</h2>";
        echo "<input id='rentalId' name='rentalId' type='hidden' value='$rental->id'/>";
       // echo "<input id='actionType' name='actionType' type='hidden' value='complete'/>";
?>

	
	<div class="form-group">
	<label for="description">Content</label>
	<textarea rows="4" type="text" class="form-control" required="true" name="content" id="content"></textarea>
	</div>
	<div class="form-group  row col-sm-3">
<label for="urgency">Rating out of 5</label> <br>
<select class="form-control" name="rating" required="true" id="rating">
  <option value="5">5</option>
  <option value="4">4</option>
  <option value="3">3</option>
  <option value="2">2</option>
  <option value="1">1</option>
</select>
</div>
	<div class="form-group">
	<input type="submit" class="btn btn-default" name="action" value="Create comment "/>
	</div>
</form>

</div>
</body>
</html>