<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>Document</title>
</head>
<body>
  <div id="chat"></div>
<input type="text" id="message">
<button id="send">Send</button>
</body>
<script>
    $(document).ready(function() {
    var interval = setInterval(function() {
        $.ajax({
            url: 'chat.php', // URL of the PHP script that handles the chat
            success: function(data) {
                $('#chat').html(data); // Update the chat div with the new messages
            }
        });
    }, 1000); // Refresh the chat every second
});

// Send a message to the server
$('#send').click(function() {
    var message = $('#message').val();
    $.ajax({
        url: '1.php', // URL of the PHP script that sends the message
        data: { message: message },
        success: function() {
            $('#message').val(''); // Clear the message input field
        }
    });
});

</script>
</html>