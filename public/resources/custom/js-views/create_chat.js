function create_mensage_my(nome,data_hora,mensagem) {
    var mensagem_left = $('<div/>').addClass('panel panel-primary panel-body chat-left')
        .append($('<div/>').addClass('row').data('id', 'mensagem')
            .append($('<div/>').addClass('col-xs-8 col-sm-8 col-md-8 pull-left').text(nome))
            .append($('<div/>').addClass('col-xs-4 col-sm-4 col-md-4 pull-right text-right text_data_msg').text(data_hora))
            .append($('<div/>').addClass('col-xs-12 col-sm-12 col-md-12 pull-left').text(mensagem))
            );
    return mensagem_left;
}

function create_mensage_you(nome,data_hora,mensagem = '') {
    var mensagem_right = $('<div/>').addClass('panel panel-success panel-body chat-right')
        .append($('<div/>').addClass('row').data('id', 'mensagem')
            .append($('<div/>').addClass('col-xs-8 col-sm-8 col-md-8 pull-left').html(nome))
            .append($('<div/>').addClass('col-xs-4 col-sm-4 col-md-4 pull-right text-right text_data_msg').html(data_hora))
            .append($('<div/>').addClass('col-xs-12 col-sm-12 col-md-12 pull-left').html(mensagem))
            );
    return mensagem_right;
}

function create_card_cliente(id,nome,ultima_msg) {
    var html = $('<div/>').addClass('panel panel-info panel-body card-cliente')
                .append($('<input/>').attr('type','hidden').data('data-id-cliente',id))
                .append($('<div/>').addClass('col-xs-12 col-sm-12 col-md-12 row').text(nome))
                .append($('<div/>').addClass('col-xs-12 col-sm-12 col-md-12 row').text(ultima_msg));
    return html;
}

function create_chat_html(clientes = false) {
    var chat = $('<div/>').addClass('row container_chat_row');
    
    var panel_clientes = $('<div/>').addClass('panel-body');

    if(clientes){
        if(clientes['status'] == true){
            $.each(clientes['data'],function (i,v) {
                panel_clientes.append(create_card_cliente(v['id_cliente'],v['nome_cliente']));
            });
        }
    }

    var painel_espera = $('<div/>').addClass('col-xs-4 col-sm-4 col-md-4')
            .append($('<div/>').addClass('row panel-clientes')
                .append(panel_clientes)
            );

    var painel_chat = $('<div/>').addClass('col-xs-8 col-sm-8 col-md-8 panel-chat')
        .append($('<div/>').addClass('panel panel-default')
                .append($('<div/>').addClass('panel-heading').text('Default'))
                .append($('<div/>').addClass('panel-body').attr('id','caixa_mensagens'))
                .append($('<div/>').addClass('panel-footer')
                    .append($('<form/>').attr('action','#').attr('id','form_mensagem')
                        .append($('<div/>').addClass('row')
                            .append($('<div/>').addClass('col-xs-10 col-sm-10 col-md-10 not-padding-right')
                                .append($('<input/>').attr('type','text').attr('id','input_send_mensagem').attr('placeholder','Escreva...').addClass('form-control rounded-0'))
                            )
                            .append($('<div/>').addClass('col-xs-2 col-sm-2 col-md-2 not-padding-left')
                                .append($('<input/>').attr('type','submit').attr('id','send_mensagem').addClass('btn btn-success pull-right'))
                            )
                        )
                        .append($('<input/>').attr('id','input_destino').attr('type','hidden').data('data-id-cliente-conversa',0))
                    )
                )
            );

    chat.append(painel_espera).append(painel_chat);
    return chat;
}