$.ajax({
    type:'POST',
    url:'/chat/user',
    success:function (data) {
        var retorno = JSON.parse(data);
        if(retorno['status'] == true) create_chat(retorno['data']);
        else notification('Algo deu errado!','Será necessário logar novamente!','logar','error',true);
    }
});
function create_chat(data) {
    console.log(data['usuario']['data']['id']);
    var container_chat = $('#container_chat');
    crate_connection(data['usuario']['data']['id'],container_chat,data['usuario']['data']['id_permissao']);

    container_chat.append(create_chat_html(data['usuario']['data']['id_permissao'],data['clientes']));
    
    if(data['usuario']['data']['id_permissao'] == 3){
        container_chat.find('.panel-chat .panel.panel-default').addClass('show');
        $.ajax({
            type:'POST',
            url:'/chat/conversa_cliente',
            data:{'id_cliente':data['usuario']['data']['id']},
            success:function (retorno) {
                retorno = JSON.parse(retorno);
                $.each(retorno['data'],function (i,v) {
                    if(v['id_envia']== data['usuario']['data']['id'])
                        container_chat.find('.panel-chat #caixa_mensagens').append(create_mensage_my('Você',v['data_mensagem'],v['conteudo']));                    
                    else{
                        container_chat.find('.panel-heading').text(v['nome']);
                        container_chat.find('.panel-chat #caixa_mensagens').append(create_mensage_you(v['nome'],v['data_mensagem'],v['conteudo']));
                    }

                    if((retorno['data'].length-1) == i){
                        if(v['id_envia'] == data['usuario']['data']['id'])
                            container_chat.find('#input_destino').data('data-id-cliente-conversa',v['id_recebe']);
                        else
                            container_chat.find('#input_destino').data('data-id-cliente-conversa',v['id_envia']);
                    }
                });
            }
        })
    }

    container_chat.on('click','.card-cliente',function () {
        container_chat.find('.panel-heading').text($(this).find('.title_cliente').text());
        container_chat.find('.panel-clientes  .panel-info.panel-body.card-cliente').removeClass('active');

        var id_cliente = $(this).addClass('active').find('input').data('data-id-cliente');
        
        container_chat.find('.panel-chat .panel.panel-default').removeClass('show').addClass('show');
        container_chat.find('#input_destino').data('data-id-cliente-conversa',id_cliente);
        container_chat.find('.panel-chat #caixa_mensagens').html('');
        $.ajax({
            type:'POST',
            url:'/chat/conversa',
            data:{'id_atendente':data['usuario']['data']['id'],'id_cliente':id_cliente},
            success:function (retorno) {
                retorno = JSON.parse(retorno);
                $.each(retorno['data'],function (i,v) {
                    if(v['id_envia']== data['usuario']['data']['id'])
                        container_chat.find('.panel-chat #caixa_mensagens').append(create_mensage_my('Você',v['data_mensagem'],v['conteudo']));                    
                    else
                        container_chat.find('.panel-chat #caixa_mensagens').append(create_mensage_you(v['nome'],v['data_mensagem'],v['conteudo']));
                    
                    
                    container_chat.find('.panel-chat #caixa_mensagens').scrollTop(container_chat.find('.panel-chat #caixa_mensagens').height());

    console.log(container_chat.find('.panel-chat #caixa_mensagens').height());

                });
            }
        });
    });

    container_chat.find('.container_chat_row').css('height',(window.innerHeight * 0.858)+'px');
    container_chat.find('.panel-clientes').css('height',(window.innerHeight * 0.858)+'px');
    container_chat.find('#caixa_mensagens').css('height',(container_chat.find('.container_chat_row').height() - 115)+'px');

    container_chat.on('submit','#form_mensagem',function (e) {
        e.preventDefault();
        var mensagem = $(this).find('#input_send_mensagem').val();
        var destino = $(this).find('#input_destino').data('data-id-cliente-conversa');
        $(this).find('#input_send_mensagem').val('');

        send_mensage(data['usuario']['data']['id'],destino,mensagem,container_chat);
    });
}