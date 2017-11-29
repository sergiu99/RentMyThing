<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php');
$item = $data['item'];
$urlItemNameWords = explode(' ', $item->name);
$urlName = $urlItemNameWords[0];
for($i = 1; $i < sizeOf($urlItemNameWords) - 1; $i ++){
	$urlName .= "%20" . $urlItemNameWords[$i];
}
 ?>

<div class="container">
<br>
<h2>Item Listing &nbsp;&nbsp;Share:&nbsp;&nbsp;<a class="" href="mailto:?subject=Check%20out%20this%20item%20on%20RentMyThing%3A%20<?php echo $urlName;?>&amp;body=http%3A%2F%2Flocalhost%2FListings%2FviewItem%2F<?php echo $item->id?>" title="Email Listing"><i class="fa d-inline fa-lg fa-envelope-o"></i></a></h2>
	
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
	<label for="totalInput">Map</label>
	<div id="mapDiv" onLoad="initMap()">
		
	</div>

<form method="post" action="/Listings/rentItem" class="form-horizontal" enctype="multipart/form-data">
	<div class="form-group">
<input type='hidden' class='form-control' name='item_id'  id='item_id'  value ="<?php echo $item->id;?>"/>
		<div class ="row">
			
<div class="col-md-3">
	<label for="start_date">Start Date</label>
	<input type='date' class='form-control' required='true' name='start_date' onchange="calculate()" required='true' id='start_date'  />
</div>
<div class="col-md-3">
	<label for="end_date">End Date</label>
	<input type='date' class='form-control end_date' onchange="calculate()" required='true' name='end_date' id='end_date' />
</div>
<div class="col-md-3">
	<label for="totalInput">Total</label>
	<input type='text' class='form-control' required='true' name='totalInput' id='totalInput' disabled=""/>
</div>
<script type="text/javascript">
	function initMap(){
		var map = new google.maps.Map(document.getElementById('mapDiv'), {
    		zoom: 8,
    		center: {lat: 40.731, lng: -73.997}
  		});;
		var geocoder = new google.maps.Geocoder;
		geocoder.geocode( { 'address': "<?php echo substr($item->postal_code, 0, 3)?>"}, function(results, status) {
			if (status == 'OK') {
			  map.setCenter(results[0].geometry.location);
			  var marker = new google.maps.Marker({
				  map: map,
				  position: results[0].geometry.location
			  });
			} else {
			  alert('Geocode was not successful for the following reason: ' + status);
			}
		});
	}

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9J8N8owe_ytoIftmgjWsYonoqfRTD7oc&callback=initMap"></script>

<div class="col-md-12">
	<br>
	
			<input type="submit" id='rentbutn'  class="btn btn-default" name="action" value="Rent Item" />
			</form>
	
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
			var selectedStart = document.getElementById("start_date").value;
			var starttDate = new Date(selectedStart);

			var inDays = Math.floor((endDate - starttDate) / (1000*60*60*24));
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