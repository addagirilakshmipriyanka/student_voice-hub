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
