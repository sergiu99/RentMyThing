<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php');
$item = $data['item'];
if(strlen($item->name) > 130){
	$item->name = substr($item->name, 0, 130);
}
$urlItemNameWords = explode(' ', $item->name);
$urlName = $urlItemNameWords[0];
for($i = 1; $i < sizeOf($urlItemNameWords) - 1; $i ++){
	$urlName .= "%20" . $urlItemNameWords[$i];
}

 ?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);

  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };

  return t;
}(document, "script", "twitter-wjs"));</script>


<div class="container">
<br>
<div class="">
<h2 style="display:inline">Item Listing</h2> &nbsp;&nbsp;Share:&nbsp;&nbsp;
	<h5 style="display:inline"><a class="" href="mailto:?subject=Check%20out%20this%20item%20on%20RentMyThing%3A%20<?php echo $urlName;?>&amp;body=http%3A%2F%2Flocalhost%2FListings%2FviewItem%2F<?php echo $item->id?>" title="Email Listing">
		<i class="fa d-inline fa-lg fa-envelope-o"></i>
	</a></h5>&nbsp;&nbsp;
	<div class="fb-share-button" data-href="http://localhost/Listings/viewItem/<?php echo $item->id?>" data-layout="button" data-size="large" data-mobile-iframe="true">
		<a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Flocalhost%2FListings%2FviewItem%2F1&amp;src=sdkpreparse">Share</a>
	</div>&nbsp;&nbsp;
	<a style="margin-top: 50:px;" class="twitter-share-button" href="https://twitter.com/intent/tweet?text=Check%20out%20this%20item%20on%20RentMyThing%3A%20<?php echo $urlName;?>&url=http://localhost/Listings/viewItem/<?php echo $item->id?>&hashtags=rentmything" data-size="large">
		Tweet
	</a>
	</div><a href="/Profile/viewUser/<?php echo $item->user_id?>" style="float:right">View owner's profile</a>
</br></br>
<table class="table table-striped">
	<tr>
		<th>Name</th>
		<th>Image</th>
		<th>Description</th>
		<th>Price</th>
		<th>Category</th>
		<th>Rating</th>
	</tr>
	
	<?php
		echo "<tr><td>$item->name</td>";
		echo "<td><img src='/$item->image_path' width='100' height='100'></td>";
		echo "<td>$item->description</td>";
		echo "<td>$ $item->price</td>";
		echo "<td>$item->category</td>";
		if($item->rating == null){
			echo "<td>N/A</td>";
		}else{
			echo "<td>$item->rating/5</td>";
		}
	
	?>
</table>

<div class="row">
	<div class="col-6">
	<label for="totalInput">Map</label>
	<div id="mapDiv" onLoad="initMap()">
		
	</div>
</div>
<div class="col-md-6">
<h6>Make A Rental Request:</h6>
<p id="dateRangeMessage"></p>
<form method="post" action="/Listings/rentItem" class="form-horizontal" enctype="multipart/form-data">
	<div class="form-group">
<input type='hidden' class='form-control' name='item_id'  id='item_id'  value ="<?php echo $item->id;?>"/>
		<div class ="row">

	<label for="start_date">Start Date</label>
	<input type='date' class='form-control' required='true' name='start_date' onchange="calculate()" required='true' id='start_date' onblur="checkDates()"/></br>

	<label for="end_date">End Date</label>
	<input type='date' class='form-control end_date' onchange="calculate()" required='true' name='end_date' id='end_date' onblur="checkDates()"/></br>

	<label for="totalInput">Total</label>
	<input type='text' class='form-control' required='true' name='totalInput' id='totalInput' disabled=""/>

	<br><br>
	
			<input type="submit" id='rentbutn'  class="btn btn-default" name="action" value="Rent Item" style="margin-top:25px"/>
			</form>
	
</div>

	</div>
</div>
<div class="form-group">
<script type="text/javascript">
	function initMap(){
		var map = new google.maps.Map(document.getElementById('mapDiv'), {
    		zoom: 14,
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

<script type="text/javascript">
			var price = <?php echo $item->price?>;
			var pad = "00"
			var today = new Date();
			var day = "" + today.getDate();
			var dayPad = pad.substring(0, pad.length - day.length) + day;
			var startDate = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+dayPad;

			document.getElementById("start_date").value = startDate;
			document.getElementById("start_date").min = startDate;
			document.getElementById("end_date").value = startDate;
			document.getElementById("end_date").min = startDate;
			document.getElementById("totalInput").value = "$"+price;

			function calculate(){
				var selectedText = document.getElementById('end_date').value;
   				var selectedDate = new Date(selectedText);
   				console.log(selectedDate);
				if ( selectedText == "" || selectedText === null){
					 $('.rentbutn').prop('disabled', true);
				}else{
					var endDateInput = document.getElementById("end_date").value;
					var endDate = new Date(endDateInput);
					var selectedStart = document.getElementById("start_date").value;
					var startDate = new Date(selectedStart);
					var inDays = Math.floor((endDate - startDate) / (1000*60*60*24));
					var total = (inDays+1) * price;
			
					if(total <= 0){
						document.getElementById("rentbutn").disabled = true;
						document.getElementById("dateRangeMessage").innerHTML = "Invalid Date Range";
					}else{
						document.getElementById("rentbutn").disabled = false;
						document.getElementById("dateRangeMessage").innerHTML = "";
					}

   					//console.log(inDays);
					document.getElementById("totalInput").value = "$"+total;
			  		$('.rentbutn').prop('disabled', false);
				}
			}

			function checkDates(){
				console.log("changes");
				document.getElementById("end_date").min = document.getElementById("start_date").value;
				$.ajax({
					type: "GET",
					url: "/Listings/checkDates?start=" + document.getElementById("start_date").value + "&end=" + document.getElementById("end_date").value + "&item=" + document.getElementById("item_id").value
				}).done(function (data){
					console.log(data);
					var result = JSON.parse(data);
					if(result.length > 0){
						document.getElementById("dateRangeMessage").innerHTML = "Item not available for this date range";
						document.getElementById("rentbutn").disabled = true;
					}else{
						document.getElementById("dateRangeMessage").innerHTML = "";
						document.getElementById("rentbutn").disabled = false;
					}
				});
			}
		</script>
<a href="/Listings/"><button  class="btn btn-default" >Go back</button></a>
</div>
</div>
<br><h2>Comments</h2><br>
	<?php
	if(count($data['comments']) > 0){
		echo "<table class='table table-striped'>
				<tr>
					<th>Content</th>
					<th>Rating</th>
				</tr>";
		foreach($data['comments'] as $item){
			echo "<tr><td>$item->content</td>";
			echo "<td>$item->rating out of 5</td>";
		}
		echo "</table>";
	}else{
		echo "<h3>No comments were left for this item!</h3>";
	}
	?>
</div>
</body>
</html>