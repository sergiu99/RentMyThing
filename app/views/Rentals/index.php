<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php'); ?>

<div class="container">
<br>
<h1>Rentals</h1>

<br>

<div class="container-fluid">
	<div class="row">
		<div class="col-10">
<ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#home">Renting from others</a>
  </li>
  <li class="nav-item">
    <a class="nav-link"  data-toggle="tab" href="#menu2">Renting to others</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#menu1">Proposals to you</a>
  </li>
   <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#menu3">Completed Rentals</a>
  </li>
</ul>

<br>
<div class="tab-content">
  <div id="home" class="tab-pane fade in active show">
  	<br>
 <h3>Items that you are renting from others</h3>

<table class="table table-striped">
	<tr>
		<th>Name</th>
		<th>Image</th>
		<th>Description</th>
		<th>Total Price</th>
		<th>Start Date</th>
		<th>End Date</th>
		<th>Status</th>
		<th>Action</th>
		<th></th>
	</tr>
	
		
	<?php
	foreach($data['myRentals'] as $item){
		

echo "		<tr><td>$item->name</td>";
		echo "<td><img src='/$item->image_path' width='100' height='100'></td>";
		echo "<td>$item->description</td>";
		echo "<td>$ $item->total</td>";
		echo "<td>$item->start_date</td>";
		echo "<td>$item->end_date</td>";
		echo "<td>$item->status</td>";
		echo "<td><p onclick='toggleChat($item->id)' class='openChat'>Chat</p></td>";

        echo "<td><form method='post' action='/Rentals/Action'>";
        echo "<input id='rentalId' name='rentalId' type='hidden' value='$item->id'/>";
        echo "<input id='actionType' name='actionType' type='hidden' value='complete'/>";
		echo "<button class='btn btn-default'  type='submit'>Complete</button>";
		echo "</form></td></tr>";
		
	}
	?>
</table>
  </div>
  <div id="menu1" class="tab-pane fade">
  	<br>
			<h3>Item rental proposals to you</h3>
<table class="table table-striped">
	<tr>
		<th>Name</th>
		<th>Image</th>
		<th>Description</th>
		<th>Total Price</th>
		<th>Start Date</th>
		<th>End Date</th>
		<th>Status</th>
		<th>Action</th>
		<th></th>
		<th></th>
	</tr>
	
	<?php
	foreach($data['myRentalProposals'] as $item){
		echo "<tr><td>$item->name</td>";
		echo "<td><img src='/$item->image_path' width='100' height='100'></td>";
		echo "<td>$item->description</td>";
		echo "<td>$ $item->total</td>";
		echo "<td>$item->start_date</td>";
		echo "<td>$item->end_date</td>";
		echo "<td>$item->status</td>";
		echo "<td><p onclick='toggleChat($item->id)' class='openChat'>Chat</p></td>";

		echo "<form method='post' action='/Rentals/Action'>";
        echo "<input id='rentalId' name='rentalId' type='hidden' value='$item->id'/>";
        echo "<input id='actionType' name='actionType' type='hidden' value='accept'/>";
		echo "<td><button class='btn btn-default' type='submit'>Accept</button></td>";
		echo "</form>";

	    echo "<form method='post' action='/Rentals/Action'>";
        echo "<input id='rentalId' name='rentalId' type='hidden' value='$item->id'/>";
        echo "<input id='actionType' name='actionType' type='hidden' value='delete'/>";
		echo "<td><button class='btn btn-default' type='submit'>Decline</button></td></tr>";
		echo "</form>";
	}
	?>
</table>
  </div>
  <div id="menu2" class="tab-pane fade">
  	<br>
			<h3>Items that you are renting to others</h3>
			<table class="table table-striped">
	<tr>
		<th>Name</th>
		<th>Image</th>
		<th>Description</th>
		<th>Total Price</th>
		<th>Start Date</th>
		<th>End Date</th>
		<th>Status</th>
		<th>Action</th>
		<th></th>
	</tr>
	
	<?php
	foreach($data['getMyRentingItems'] as $item){
		echo "<tr><td>$item->name</td>";
		echo "<td><img src='/$item->image_path' width='100' height='100'></td>";
		echo "<td>$item->description</td>";
		echo "<td>$ $item->total</td>";
		echo "<td>$item->start_date</td>";
		echo "<td>$item->end_date</td>";
		echo "<td>$item->status</td>";
		echo "<td><p onclick='toggleChat($item->id)' class='openChat'>Chat</p></td>";     

		echo "<form method='post' action='/Rentals/Action'>";
        echo "<input id='rentalId' name='rentalId' type='hidden' value='$item->id'/>";
        echo "<input id='actionType' name='actionType' type='hidden' value='complete'/>";
		echo "<td><button class='btn btn-default'  type='submit'>Complete</button></td></tr>";
		echo "</form>";
	}
	?>
</table>
  </div>
    <div id="menu3" class="tab-pane fade">
  	<br>
			<h3>Completed Rentals</h3>
			<table class="table table-striped">
	<tr>
		<th>Name</th>
		<th>Image</th>
		<th>Description</th>
		<th>Total Price</th>
		<th>Start Date</th>
		<th>End Date</th>
		<th>Status</th>
		<th>Action</th>
		<th></th>
	</tr>
	
	<?php
	foreach($data['completedItems'] as $item){
		echo "<tr><td>$item->name</td>";
		echo "<td><img src='/$item->image_path' width='100' height='100'></td>";
		echo "<td>$item->description</td>";
		echo "<td>$ $item->total</td>";
		echo "<td>$item->start_date</td>";
		echo "<td>$item->end_date</td>";
		echo "<td>$item->status</td>";
		echo "<td><p onclick='toggleChat($item->id)' class='openChat'>Chat</p></td>";  

		echo "<form method='post' action='/Rentals/Action'>";
        echo "<input id='rentalId' name='rentalId' type='hidden' value='$item->id'/>";
        echo "<input id='actionType' name='actionType' type='hidden' value='complete'/></tr>";
		echo "</form>";
	}
	?>
</table>
  </div>
  </div>
</div>
	
</div>

</div>

<div id="chat_toggle"></div>

<script type="text/javascript">
var lastTimeID = 0;
var mesages;
$('#chatInput').val("");

function toggleChat(id){
	console.log("chat toggled");
	document.getElementById("toggleChat").innerHTML = "<div id='chatDiv'><h5 style='width:100%; padding:5px; background-color:orange; margin-bottom: 0px !important;'>Chat</h5><div id='chat_history'><ul id='view_ajax'></ul></div><div id='sendDiv'><input type='text' id='chatInput' name='" + id + "' style='width:80%'/><input type='button' value='Send' id='btnSend' onclick='sendChatText()'/></div></div>";
	setInterval(function() { getChatText(id); }, 2000);
}

function getChatText(id) {
	$.ajax({
		type: "GET",
		url: "/Chat/getNewMessages?lastTimeID=" + lastTimeID + "&rentalID=" + document.getElementById("chatInput").name
	}).done( function( data )
	{
		var messages = JSON.parse(data);
		messages = JSON.parse(messages);
		mesages = messages;
		var jsonLength = messages.results.length;
		var html = "";
		for (var i = 0; i < jsonLength; i++) {
			var message = messages.results[i];
			console.log("Sender: " + message.sender_id);
			console.log("Receiver: " + <?php echo $data['this_user']?>);
			if(message.sender_id == <?php echo $data['this_user']?>){
				html += "<li class='clearfix'><div class='message-data align-right'><span class='message-data-time'>" + message.created_on + "</span></div>";
				html += "<div class='message my-message float-right'>" + message.content + "</div></li>";
			}else{
				html += "<li class='clearfix'><div class='message-data align-left'><span class='message-data-time'>" + message.created_on + "</span></div>";
				html += "<div class='message other-message float-left'>" + message.content + "</div></li>";
			}
			lastTimeID = message.id;
		}
		$('#view_ajax').append(html);
		var objDiv = document.getElementById("chat_history");
		objDiv.scrollTop = objDiv.scrollHeight;
	});
}

function sendChatText(){
	console.log("SENDING");
	var chatInput = $('#chatInput').val();
	if(chatInput != ""){
		$.ajax({
			type: "GET",
			url: "/Chat/sendMessage?rentalID=" + document.getElementById("chatInput").name + "&content=" + encodeURIComponent(chatInput)
		}).done(function (data){
			console.log(data);
		});
		$('#chatInput').val("");
	}
}
</script>

	<div id="toggleChat">
	
	</div>
    <div id="ajaxForm"></div>
</body>
</html>