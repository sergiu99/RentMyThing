<html>
  <head>
    <!-- https://www.phpclasses.org/blog/package/3213/post/1-Tutorial-on-Creating-an-AJAX-based-Chat-system-in-PHP.html -->
    <title>Chat Room Example</title>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
        var lastTimeID = 0;

        $(document).ready(function() {
            $('#btnSend').click( function() {
                sendChatText();
                $('#chatInput').val("");
            });
            startChat();
        });
    
        function startChat(){
            setInterval( function() { getChatText(); }, 2000);
        }

        function getChatText() {
            $.ajax({
                type: "GET",
                url: "/Chat/getNewMessages/" + lastTimeID
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
            var chatInput = $('#chatInput').val();
            if(chatInput != ""){
                $.ajax({
                    type: "GET",
                    url: "/submit.php?chattext=" + encodeURIComponent( chatInput);
                })
            }
        }
    </script>
    <link rel="stylesheet" href="css/main.css" />
  </head>
  <body>
    <div id="view_ajax"></div>
    <div id="ajaxForm">
      <input type="text" id="chatInput" /><input type="button" value="Send" id="btnSend" />
    </div>
  </body>
</html>