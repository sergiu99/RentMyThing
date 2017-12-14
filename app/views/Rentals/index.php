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
    <a class="nav-link active" id="home_toggle" data-toggle="tab" href="#home">Renting from others</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="menu1_toggle" data-toggle="tab" href="#menu2">Renting to others</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="menu2_toggle" data-toggle="tab" href="#menu1">Proposals to you</a>
  </li>
   <li class="nav-item">
    <a class="nav-link" id="menu3_toggle" data-toggle="tab" href="#menu3">Completed Rentals</a>
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
		<th></th>
	</tr>
	
		
	<?php
	foreach($data['myRentals'] as $item){
	$statuss = $item->status;
		$completeAction = "<td><button class='btn btn-default'  type='submit'>Complete</button></td></tr>";
		if($item->status == 'reqcompleted' . $data['this_user']) {
			$statuss = 'You have requested this Rental to complete.';
			$completeAction = "<td><button class='btn btn-default disabled'  type='submit' disabled>Complete</button></td></tr>";
		} else if($item->status == 'pending'){
			$statuss = 'Pending';
			$completeAction = "<td><button class='btn btn-default'  type='submit'>Cancel Request</button></td></tr>";
		}
		else if($item->status == 'completed')
		{
			$statuss = 'Completed';
		}else if($item->status == 'accepted')
		{
			$statuss = 'Accepted';
		} else {
			$statuss = 'Awaiting your confirmation to Complete';
		} 

		echo "<tr><td>$item->name</td>";
		echo "<td><img src='/$item->image_path' width='100' height='100'></td>";
		echo "<td>$item->description</td>";
		echo "<td>$ $item->total</td>";
		echo "<td>$item->start_date</td>";
		echo "<td>$item->end_date</td>";
		echo "<td>$statuss</td>";
		echo "<td><p onclick='toggleChat($item->id)' class='openChat'>Chat</p></td>";

        echo "<td><form method='post' action='/Rentals/Action'>";
        echo "<input id='rentalId' name='rentalId' type='hidden' value='$item->id'/>";
        echo "<input id='actionType' name='actionType' type='hidden' value='complete'/>";
		echo $completeAction;
		echo "</form></td></tr>";
		
	}
	$chatId = $data['chat'];
	if($chatId != ""){
		echo "<div id='loadChat' onload='toggleChat($chatId)'></div>";
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
		$statuss = $item->status;
	    $completeAction = "<td><button class='btn btn-default'  type='submit'>Decline</button></td></tr>";
		if($item->status == 'reqcompleted' . $data['this_user']) {
			$statuss = 'You have requested this Rental to complete.';
			$completeAction = "<td><button class='btn btn-default disabled'  type='submit' disabled>Complete</button></td></tr>";
		} else if($item->status == 'pending'){
			$statuss = 'Pending';
		}
		else if($item->status == 'completed')
		{
			$statuss = 'Completed';
		}else if($item->status == 'accepted')
		{
			$statuss = 'Accepted';
		} else {
			$statuss = 'Awaiting your action to Complete';
		} 
		echo "<tr><td>$item->name</td>";
		echo "<td><img src='/$item->image_path' width='100' height='100'></td>";
		echo "<td>$item->description</td>";
		echo "<td>$ $item->total</td>";
		echo "<td>$item->start_date</td>";
		echo "<td>$item->end_date</td>";
		echo "<td>$statuss</td>";
		echo "<td><p onclick='toggleChat($item->id)' class='openChat'>Chat</p></td>";

		echo "<form method='post' action='/Rentals/Action'>";
        echo "<input id='rentalId' name='rentalId' type='hidden' value='$item->id'/>";
        echo "<input id='actionType' name='actionType' type='hidden' value='accept'/>";
		echo "<td><button class='btn btn-default' type='submit'>Accept</button></td>";
		echo "</form>";

	    echo "<form method='post' action='/Rentals/Action'>";
        echo "<input id='rentalId' name='rentalId' type='hidden' value='$item->id'/>";
        echo "<input id='actionType' name='actionType' type='hidden' value='delete'/>";
		echo $completeAction;
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

		$statuss = $item->status;
	    $completeAction = "<td><button class='btn btn-default'  type='submit'>Complete</button></td></tr>";
		if($item->status == 'reqcompleted' . $data['this_user']) {
			$statuss = 'You have requested this Rental to complete.';
			$completeAction = "<td><button class='btn btn-default disabled'  type='submit' disabled>Complete</button></td></tr>";
		} else if($item->status == 'pending'){
			$statuss = 'Pending';
		}
		else if($item->status == 'completed')
		{
			$statuss = 'Completed';
		}else if($item->status == 'accepted')
		{
			$statuss = 'Accepted';
		} else {
			$statuss = 'Awaiting your action to Complete';
		} 
		echo "<tr><td>$item->name</td>";
		echo "<td><img src='/$item->image_path' width='100' height='100'></td>";
		echo "<td>$item->description</td>";
		echo "<td>$ $item->total</td>";
		echo "<td>$item->start_date</td>";
		echo "<td>$item->end_date</td>";
		echo "<td>$statuss</td>";
		echo "<td><p onclick='toggleChat($item->id)' class='openChat'>Chat</p></td>";     

		echo "<form method='post' action='/Rentals/Action'>";
        echo "<input id='rentalId' name='rentalId' type='hidden' value='$item->id'/>";
        echo "<input id='actionType' name='actionType' type='hidden' value='complete'/>";
		echo $completeAction; 
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
	$commented = $data['commented'];
	foreach($data['completedItems'] as $item){
		$statuss = $item->status;
		
	    $completeAction = "<td><button class='btn btn-default'  type='submit'>Complete</button></td></tr>";
		if($item->status == 'reqcompleted' . $data['this_user']) {
			$statuss = 'You have requested this Rental to complete.';
			$completeAction = "<td><button class='btn btn-default disabled'  type='submit' disabled>Complete</button></td></tr>";
		} else if($item->status == 'pending'){
			$statuss = 'Pending';
		}
		else if($item->status == 'completed')
		{
			$statuss = 'Completed';
		}else if($item->status == 'accepted')
		{
			$statuss = 'Accepted';
		} else if($item->status == 'cancelled') {
			$statuss = 'Cancelled';
		} else{
			$statuss = 'Awaiting your action to Complete';
		}

		$itemuserid = $item->user_id;
		$thisusersss = $data['this_user'];
		if( $itemuserid == $thisusersss && !in_array($item->id, $commented)) {
			$actionss =  "<td><button class='btn btn-default'  type='submit'>Leave Comment </button></td></tr>";
		} else {
			$actionss =  "<td><button class='btn btn-default disabled'  type='submit' disabled>Finished</button></td></tr>";
		}
		
		echo "<tr><td>$item->name</td>";
		echo "<td><img src='/$item->image_path' width='100' height='100'></td>";
		echo "<td>$item->description</td>";
		echo "<td>$ $item->total</td>";
		echo "<td>$item->start_date</td>";
		echo "<td>$item->end_date</td>";
		echo "<td>$statuss</td>";
		echo "<td><p onclick='toggleChat($item->id)' class='openChat'>Chat</p></td>";  

		
		echo "<form method='post' action='/Rentals/createComment'>";
        echo "<input id='rentalId' name='rentalId' type='hidden' value='$item->id'/>";
        echo $actionss;
		echo "</form></tr>";
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
//Select a tab
function setTabAttributes(pane, toggle){
	document.getElementById("home").className = "tab-pane fade in";
	document.getElementById("home").setAttribute("aria-expanded", "false");
	document.getElementById(pane).className = "tab-pane fade active show";
	document.getElementById(pane).setAttribute("aria-expanded", "true");
	document.getElementById("home_toggle").className = "nav-link";
	document.getElementById("home_toggle").setAttribute("aria-expanded", "false");
	document.getElementById(toggle).className = "nav-link active";
	document.getElementById(toggle).setAttribute("aria-expanded", "true");
}

//Set the selected tab
function setTab(){
	var tab = "<?php echo $data['tab']?>";
	if(tab == "proposals"){
		//Open proposals tab
		setTabAttributes("menu1", "menu2_toggle");
	}else{
		if(tab == "completed"){
			//Open completed tab
			setTabAttributes("menu3", "menu3_toggle");
		} else {
			if(tab == "owned"){
				//Open renting to others tab
				setTabAttributes("menu2", "menu1_toggle");
			}
		}
	}
}

var lastTimeID = 0; //The last viewed message id
var chatStatus = "initial";
$('#chatInput').val("");

//Open the chatbox
function toggleChat(id){
	document.getElementById("toggleChat").innerHTML = "<div id='chatDiv' class='panel'><h5 class='chatHeading' style='width:100%; padding:5px; background-color:#007bff; color:white; margin-bottom: 0px !important; border-radius: 0.25rem;' onclick='collapseChat()'>Chat</h5><div id='chat_history'><ul id='view_ajax'></ul></div><div id='sendDiv' class='form-group' style='padding:5px;margin-bottom: 0px;'><div class='input-group'><input type='text' id='chatInput' class='form-control' name='" + id + "' style='width:80%; ' onkeypress = 'chatInputEnter(event)'/><span class='input-group-btn'><button class='btn btn-secondary' type='button' onclick='sendChatText()'>Send</button></span></div></div></div>";
	setInterval(function() { getChatText(id); }, 2000); //Set a chat update interval
	lastTimeID = 0;
}

//Get the new chat messages for a rental
function getChatText(id) {
	$.ajax({
		type: "GET",
		url: "/Chat/getNewMessages?lastTimeID=" + lastTimeID + "&rentalID=" + document.getElementById("chatInput").name
	}).done( function( data )
	{
		//Process the json data and populate the message display
		var messages = JSON.parse(data);
		messages = JSON.parse(messages);
		var jsonLength = messages.results.length;
		var html = "";
		for (var i = 0; i < jsonLength; i++) {
			var message = messages.results[i];
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
		//Set the initial parameters
		if(chatStatus == "initial"){
			var objDiv = document.getElementById("chat_history");
			objDiv.scrollTop = objDiv.scrollHeight;
			chatStatus = "refreshed";
		}
	});
}

//Send a chat message on ENTER
function chatInputEnter(e){
	if(e.which == 13){
		chatStatus == "initial";
		sendChatText();
	}
}

//Send the text in the chat input field as a chat message
function sendChatText(){
	var chatInput = $('#chatInput').val();
	if(chatInput != ""){
		$.ajax({
			type: "GET",
			url: "/Chat/sendMessage?rentalID=" + document.getElementById("chatInput").name + "&content=" + encodeURIComponent(chatInput)
		}).done(function (data){
			console.log(data);
		});
		$('#chatInput').val("");
		chatStatus = "initial";
	}
}

//Collapse or show the chat box
function collapseChat(){
    if(document.getElementById("chat_history").hasAttribute("hidden")){
        document.getElementById("chat_history").removeAttribute("hidden");
        document.getElementById("sendDiv").removeAttribute("hidden");
    }else{
        document.getElementById("chat_history").setAttribute("hidden", "hidden");
        document.getElementById("sendDiv").setAttribute("hidden", "hidden");
    }
}

//Close a chat box completely
function closeChat(){
    document.getElementById("toggleChat").innerHTML = "";
    clearInterval(chatInterval);
	lastTimeID = 0;
}

setTab();
</script>

	<!-- This div will contain the chat contents -->
	<div id="toggleChat">
	
	</div>
	<div id="ajaxForm"></div>
	<?php 
		if(isset($data['chat']) && $data['chat'] != "") { 
			$chat = $data['chat']; 
			echo "<script>toggleChat($chat)</script>"; 
		} 
	?>
</body>
</html>