<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php');
$item = $data['item'];
 ?>

<div class="container">
<br>
<br>
<h2>Item Listing </h2>
	
<table class="table table-striped">
	<tr>
		<th>Name</th>
		<th>Image</th>
		<th>Description</th>
		<th>Price</th>
		<th>Category</th>
		<th>Rating</th>
		<th>Status</th>
	</tr>
	
	<?php
		echo "<tr><td>$item->name</td>";
		echo "<td><img src='/$item->image_path' width='100' height='100'></td>";
		echo "<td>$item->description</td>";
		echo "<td>$ $item->price</td>";
		echo "<td>$item->category</td>";
		echo "<td>$item->rating</td>";
		echo "<td>$item->status</td>";
	
	?>
</table>
	<div class="form-group">
		<div class ="row">
			
<div class="col-md-3">
	<label for="start_date">Start Date</label>
	<input type='date' class='form-control' required='true' name='start_date' id='start_date' disabled="" />
</div>
<div class="col-md-3">
	<label for="end_date">End Date</label>
	<input type='date' class='form-control end_date' onchange="calculate()" required='true' name='end_date' id='end_date' />
</div>
<div class="col-md-3">
	<label for="totalInput">Total</label>
	<input type='text' class='form-control' required='true' name='totalInput' id='totalInput' disabled=""/>
</div>
<div class="col-md-12">
	<br>
	<a onclick='calculate();'"><button  class="btn btn-default" >Calculate</button></a>
		<?php echo "<a href='/Listings/rentItem/$item->id'><button disabled='' class='btn btn-primary rentbutn' id='rentbutn'>Rent Item</button></a>" ?>
</div>

	</div>
</div>
<div class="form-group">
<script type="text/javascript">
			var today = new Date();
			var startDate = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
			document.getElementById("start_date").value = startDate;
			//document.getElementById("end_date").value = "2017-11-20";
			

			
			function calculate(){
			var selectedText = document.getElementById('end_date').value;
   			var selectedDate = new Date(selectedText);
   			console.log(selectedDate);
				if ( selectedText == "" || selectedText === null){
					 $('.rentbutn').prop('disabled', true);
				}
					else{

			var endDateInput = document.getElementById("end_date").value;
			var endDate = new Date(endDateInput);

			var inDays = Math.floor((endDate - today) / (1000*60*60*24));
			var total = (inDays+2) * 1;
			
   			//console.log(inDays);
			document.getElementById("totalInput").value = "$"+total;
			  $('.rentbutn').prop('disabled', false);
			}}
		</script>
<a href="/Listings/"><button  class="btn btn-default" >Go back</button></a>
</div>
</div>
</body>
</html>