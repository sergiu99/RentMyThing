<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php'); ?>

<div class="container">
<br>
<br>
<h2>Delete your account</h2>
<form method="post" action="/Profile/deleteAccount" class="form-horizontal" enctype="multipart/form-data">
	
	<div class="form-group">
	<label for="description">Reasons for deleting account: </label>
	<textarea rows="4" type="text" class="form-control" required="true" name="description" id="description"></textarea>
	</div>
	<div class="form-group  row col-sm-3">
<label for="urgency">Are you sure you want to delete your account?</label> <br>
<select class="form-control" name="urgency" required="true" id="urgency">
  <option value="no">No</option>
  <option value="yes">Yes</option>
</select>
</div>
	<div class="form-group">
	<input type="submit" class="btn btn-danger" name="action" value="Delete Account" /></form>
<a href="/Profile" class="btn btn-default" >Back to Profile</a>
	</div>



Disclaimer: No information will be deleted. Your access to it will be disabled as it may be kept for legal purposes.<br>Please contact us for further questions.
<br>

</div>
</body>
</html>