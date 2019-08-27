<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script>

// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('3c8e93a6f7612e82df8c', {
    cluster: 'us2',
    forceTLS: true
});

var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(data) {
    alert(JSON.stringify(data));
});

$(document).ready(function () {
    $('#input_send').click(function (){
        $.ajax({
            type:'POST',
            url:'aplication/services/send.php',
            success:function (data) {
                console.log(data);
            }
        });
    });
});
</script>