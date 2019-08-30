function crate_connection(id_user) {
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('3c8e93a6f7612e82df8c', {
        cluster: 'us2',
        forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('mensagem-channel', function(data) {
        $.each(data,function (i,v) {
            if(i == 'id_recebe' && v == id_user){
                $('.panel-chat #caixa_mensagens').append(
                    create_mensage_you(data['id_envia'],'20:00 12/02/2019',data['msg'])
                );
            }
        })
    });
}
function send_mensage(id_user,id_destino,msg) {
    console.log('teste de envio');
    $.ajax({
        type:'POST',
        url:'aplication/services/send.php',
        data:{'user':id_user,'recebe':id_destino,'msg':msg},
        success:function (data) {
            console.log(data);
        }
    });
}