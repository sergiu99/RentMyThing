<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php'); ?>
    <script type="text/javascript">
        var lastTimeID = 0;
        var mesages;
        startChat();
        $('#chatInput').val("");
    
        function startChat(){
            setInterval(function() { getChatText(); }, 2000);
        }
        function getChatText() {
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
                    html += "<li class='clearfix'><div class='message-data align-right'><span class='message-data-time'>" + message.created_on + "</span></div>";
                    if(message.sender == <?php echo $data['this_user']?>){
                        html += "<div class='message my-message float-right'>" + message.content + "</div></li>";
                    }else{
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
                    type: "POST",
                    url: "/Chat/sendMessage?receiverID=" + document.getElementById("chatInput").name + "&content=" + encodeURIComponent(chatInput)
                }).done(function (data){
                    console.log(data);
                });
                $('#chatInput').val("");
            }
        }
    </script>
    <div id="chatDiv">
        <h5 style="width:100%; padding:5px">Chat</h5>
        <div id="chat_history">
            <ul id="view_ajax">

            </ul>
        </div>
        <div id="send_div">
            <?php 
                $rentalId = $data['rentalId'];
                echo "<input type='text' id='chatInput' name='$rentalId' style='width:80%'/>";
            ?>
            <input type="button" value="Send" id="btnSend" onclick="sendChatText()"/>
        </div>
    </div>
    <div id="ajaxForm">
    </div>
  </body>
</html>