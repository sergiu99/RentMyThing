<div id="chat_toggle"></div>

<script type="text/javascript">
var lastTimeID = 0;
var chatInterval;
$('#chatInput').val("");

function toggleChat(id){
	console.log("chat toggled");
	document.getElementById("toggleChat").innerHTML = "<div id='chatDiv'><h5 id='chatHeading' onclick='collapseChat()'>Chat<p style='float-right' onclick='closeChat()'>X</p></h5><div id='chat_history'><ul id='view_ajax'></ul></div><div id='sendDiv'><input type='text' id='chatInput' name='" + id + "' style='width:80%'/><input type='button' value='Send' id='btnSend' onclick='sendChatText()'/></div></div>";
	chatInterval = setInterval(function() { getChatText(id); }, 2000);
}

function getChatText(id) {
	console.log("getting");
	$.ajax({
		type: "GET",
		url: "/Chat/getNewMessages?lastTimeID=" + lastTimeID + "&rentalID=" + document.getElementById("chatInput").name
	}).done( function( data )
	{
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
		var objDiv = document.getElementById("chat_history");
		objDiv.scrollTop = objDiv.scrollHeight;
	});
}

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
	}
}

function collapseChat(){
    if(document.getElementById("chat_history").hasAttribute("hidden")){
        document.getElementById("chat_history").removeAttribute("hidden");
        document.getElementById("sendDiv").removeAttribute("hidden");
    }else{
        document.getElementById("chat_history").setAttribute("hidden", "hidden");
        document.getElementById("sendDiv").setAttribute("hidden", "hidden");
    }
}

function closeChat(){
    document.getElementById("toggleChat").innerHTML = "";
    clearInterval(chatInterval);
	lastTimeID = 0;
}

</script>

	<div id="toggleChat">
	
	</div>
    <div id="ajaxForm"></div>