<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php'); ?>
    <script type="text/javascript">
        var lastTimeID = 0;
        var mesages;
        startChat();
        $('#chatInput').val("");
    
        function startChat(){
            setInterval(function() { getChatText(); }, 2000);
        }
//https://codepen.io/anon/pen/JOZBzy 
        function getChatText() {
            $.ajax({
                type: "GET",
                url: "/Chat/getNewMessages?lastTimeID=" + lastTimeID + "&receiverID=" + document.getElementById("chatInput").name
            }).done( function( data )
            {
                var messages = JSON.parse(data);
                messages = JSON.parse(messages);
                mesages = messages;
                var jsonLength = messages.results.length;
                var html = "";
                for (var i = 0; i < jsonLength; i++) {
                    var message = messages.results[i];
                    html += "<p>Sent on: " + message.created_on + "</p>";
                    html += "<p class='chatLine'>" + message.content + "</p>";
                    lastTimeID = message.id;
                }
                $('#view_ajax').append(html);
                var objDiv = document.getElementById("view_ajax");
                objDiv.scrollTop = objDiv.scrollHeight;
            });
        }
        
        function sendChatText(){
            console.log("SENDING");
            var chatInput = $('#chatInput').val();
            if(chatInput != ""){
                $.ajax({
                    type: "GET",
                    url: "/Chat/sendMessage?receiverID=" + document.getElementById("chatInput").name + "&content=" + encodeURIComponent(chatInput)
                }).done(function (data){
                    console.log(data);
                });
                $('#chatInput').val("");
            }
        }
    </script>
    <div id="chatDiv">
        <h5 style="width:100%">Chat</h5>
        <div id="view_ajax"></div>
        <?php 
            $receiver = $data['receiver'];
            echo "<input type='text' id='chatInput' name='$receiver'/><input type='button' value='Send' id='btnSend' onclick='sendChatText()'/>";
        ?>
    </div>
    <div id="ajaxForm">
    </div>
  </body>
</html>