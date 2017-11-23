<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php'); ?>
    <script type="text/javascript">
        var lastTimeID = 0;
        startChat();
        $('#chatInput').val("");
    
        function startChat(){
            setInterval(function() { getChatText(); }, 2000);
        }

        function getChatText() {
            $.ajax({
                type: "GET",
                url: "/Chat/getNewMessages?lastTimeID=" + lastTimeID + "&receiverID=" + document.getElementByID("chatInput").name;
            }).done( function( data )
            {
                var jsonData = JSON.parse(data);
                var jsonLength = jsonData.results.length;
                var html = "";
                for (var i = 0; i < jsonLength; i++) {
                    var result = jsonData.results[i];
                    html += '<div style="color:#' + result.color + '">(' + result.chattime + ') <b>' + result.usrname +'</b>: ' + result.chattext + '</div>';
                    lastTimeID = result.id;
                }
                 $('#view_ajax').append(html);
            });
        }
        
        function sendChatText(){
            console.log("SENDING");
            var chatInput = $('#chatInput').val();
            if(chatInput != ""){
                $.ajax({
                    type: "GET",
                    url: "/Chat/sendMessage/" + encodeURIComponent(chatInput)
                })
                $('#view_ajax').append("<p>NEW LINE</p>");
            }
        }
    </script>
    <div id="view_ajax"></div>
    <div id="ajaxForm">
    <?php 
        $receiver = $data['receiver'];
        echo "<input type='text' id='chatInput' name='$receiver'/><input type='button' value='Send' id='btnSend'/>";
    ?>
    </div>
  </body>
</html>