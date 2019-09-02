function crate_connection(id_user,container_chat,id_permissao) {
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;
    var key = '3c8e93a6f7612e82df8c';

    var pusher = new Pusher(key, { cluster: 'us2', forceTLS: true });
    var channel = pusher.subscribe('channel_'+id_user);
    //FUNÇÕES DO CANAL
    channel.bind('mensagem-channel', function(data) {
        if(id_permissao == 3)
            container_chat.find('.panel-chat #caixa_mensagens').append(create_mensage_you(data['nome_origem'],data['data_envio'],data['mensagem']));
        else if(data['origem'] == container_chat.find('.panel-chat #input_destino').data('data-id-cliente-conversa'))
            container_chat.find('.panel-chat #caixa_mensagens').append(create_mensage_you(data['nome_origem'],data['data_envio'],data['mensagem']));
        //CRIAR SITUAÇÃO ONDE O CLIENTE ESTEJA ESPERANDO
    });
    channel.bind('new-cliente-channel', function(data) {
        if(id_permissao != 3){
            console.log(data);
        }
    });
    //FUNÇÕES DO CANAL

    //CANAL GLOBAL PARA RESPOSTAS DO SERVIDOR
    var channel_global = pusher.subscribe('channel_global');
    channel_global.bind('teste', function(data) {
        console.log(data);
        /*$.each(data,function (i,v) {
            if(i == 'id_recebe' && v == id_user){
                $('.panel-chat #caixa_mensagens').append(
                    create_mensage_you(data['id_envia'],'20:00 12/02/2019',data['msg'])
                );
            }
        })*/
    });
}

function send_mensage(id_origem,id_destino,msg,container_chat) {
    if(id_destino == 0){
        $.ajax({
            type:'POST',
            url:'/chat/sendFirst',
            data:{'origem':id_origem,'destino':id_destino,'mensagem':msg},
            success:function (data) {
                data = JSON.parse(data);
                if(data['status'] == true){
                    container_chat.find('.panel-chat #caixa_mensagens').append(create_mensage_my('Você',data['data']['data_envio'],data['data']['mensagem']));
                }
            }
        });
    }
    else{
        $.ajax({
            type:'POST',
            url:'/chat/send',
            data:{'origem':id_origem,'destino':id_destino,'mensagem':msg},
            success:function (data) {
                data = JSON.parse(data);
                if(data['status'] == true){
                    container_chat.find('.panel-chat #caixa_mensagens').append(create_mensage_my('Você',data['data']['data_envio'],data['data']['mensagem']));
                }
            }
        });
    }
}