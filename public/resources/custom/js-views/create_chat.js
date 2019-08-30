function create_mensage_my(nome,data_hora,mensagem) {
    var mensagem_left = $('<div/>').addClass('panel panel-primary panel-body chat-left')
        .append($('<div/>').addClass('row').data('id', 'mensagem')
            .append($('<div/>').addClass('col-xs-8 col-sm-8 col-md-8 pull-left').html('dono da mensagem'))
            .append($('<div/>').addClass('col-xs-4 col-sm-4 col-md-4 pull-right text-right').html('data_hora'))
            .append($('<div/>').addClass('col-xs-12 col-sm-12 col-md-12 pull-left').html('mensagem...'))
            );
    return mensagem_left;
}

function create_mensage_you(nome,data_hora,mensagem) {
    var mensagem_right = $('<div/>').addClass('panel panel-success panel-body chat-right')
        .append($('<div/>').addClass('row').data('id', 'mensagem')
            .append($('<div/>').addClass('col-xs-8 col-sm-8 col-md-8 pull-left').html(' outro dono da mensagem'))
            .append($('<div/>').addClass('col-xs-4 col-sm-4 col-md-4 pull-right text-right').html('data_hora'))
            .append($('<div/>').addClass('col-xs-12 col-sm-12 col-md-12 pull-left').html('outra mensagem...'))
            );
    return mensagem_right;
}

function create_chat(params) {
    var chat = $('<div/>').addClass('row');

    var painel_espera = $('<div/>').addClass('col-xs-4 col-sm-4 col-md-4')
            .append($('<div/>').addClass('row panel-clientes')
                .append($('<div/>').addClass('panel-body')
                    .append($('<div/>').addClass('panel panel-info panel-body card-cliente')
                        .append($('<div/>').addClass('col-xs-12 col-sm-12 col-md-12 row').html('nome cliente'))
                        .append($('<div/>').addClass('col-xs-12 col-sm-12 col-md-12 row').html('ultima mensagem'))
                    )
                )
            );

    var painel_chat = $('<div/>').addClass('col-xs-8 col-sm-8 col-md-8 panel-chat')
        .append($('<div/>').addClass('panel panel-default')
                .append($('<div/>').addClass('panel-heading').html('Nome Cliente'))
                .append($('<div/>').addClass('panel-body').attr('id','caixa_mensagens')
                    //.append(create_mensage_my('Diego','2019-08-08 00:00:00','Primeira mensagem'))
                    //.append(create_mensage_you('Thiago','2019-08-08 01:00:00','Segunda mensagem'))
                    )
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
                    )
                )
            );

    chat.append(painel_espera).append(painel_chat);
    return chat;
}