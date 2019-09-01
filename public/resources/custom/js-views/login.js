$(document).ready(function(){
    $('.login-info-box').fadeOut();
    $('.login-show').addClass('show-log-panel');
    $('#form_register input[name="telefone"]').mask(SPMaskBehavior, spOptions);

    $('.login-reg-panel input[type="radio"]').on('change', function() {
        if($('#log-login-show').is(':checked')) {
            $('#form_login').find('input[type="text"]').val('').removeClass('error');
            $('#form_login').find('input[type="password"]').val('').removeClass('error');
            $('#form_login').find('.div_error_individual').removeClass('show');

            $('.register-info-box').fadeOut(); 
            $('.login-info-box').fadeIn();
            
            $('.white-panel').addClass('right-log');
            $('.register-show').addClass('show-log-panel');
            $('.login-show').removeClass('show-log-panel');
        }
        else if($('#log-reg-show').is(':checked')) {
            $('#form_register').find('input[type="text"]').val('').removeClass('error');
            $('#form_register').find('input[type="password"]').val('').removeClass('error');
            $('#form_register').find('.div_error_individual').removeClass('show');

            $('.register-info-box').fadeIn();
            $('.login-info-box').fadeOut();
            
            $('.white-panel').removeClass('right-log');
            
            $('.login-show').addClass('show-log-panel');
            $('.register-show').removeClass('show-log-panel');
        }
    });

    $('#btn_form_register').on('click',function (e) {
        var form = $(this).closest('#form_register');
        var form_array = form.serializeArray();
        var error = false;
        var msg_error = [];
        var senha = '';

        form.find('input').removeClass('error');
        form.find('.div_error_individual').removeClass('show');

        $.each(form_array,function (i,v) {
            switch (v['name']) {
                case 'nome':
                    if(v['value'].length > 30){
                        error = true;
                        msg_error.push({'nome':'Limite de 30 caracteres!'});
                    }else if(v['value'].length == 0) {
                        error = true;
                        msg_error.push({'nome':'Campo obrigatório!'});
                    }
                break;
                case 'email':
                    if(v['value'].length > 50){
                        error = true;
                        msg_error.push({'email':'Limite de 50 caracteres!'});
                    }else if(v['value'].length == 0) {
                        error = true;
                        msg_error.push({'email':'Campo obrigatório!'});
                    }
                break;
                case 'telefone':
                    if(v['value'].length > 15){
                        error = true;
                        msg_error.push({'telefone':'Limite de 15 caracteres!'});
                    }else if(v['value'].length == 0) {
                        error = true;
                        msg_error.push({'telefone':'Campo obrigatório!'});
                    }
                break;
                case 'senha':
                    senha = v['value'];
                    if(v['value'].length == 0) {
                        error = true;
                        msg_error.push({'senha':'Campo obrigatório!'});
                    }else if(v['value'].length < 4){
                        error = true;
                        msg_error.push({'senha':'Deve conter pelo menos 4 digitos!'});
                    }
                break;
                case 'conf_senha':
                    if(v['value'].length == 0) {
                        error = true;
                        msg_error.push({'conf_senha':'Campo obrigatório!'});
                    }else if(v['value'] != senha){
                        error = true;
                        msg_error.push({'senha':'Senhas não conferem!'});
                        msg_error.push({'conf_senha':'Senhas não conferem!'});
                    }
                break;
            }
        });

        if(error){
            $.each(msg_error,function (i,v) {
                $.each(v,function (identificador,mensagem) {
                    form.find('input[name="'+identificador+'"]').addClass('error');
                    form.find('div[data-identification="'+identificador+'"]').text(mensagem).addClass('show');
                });
            });
        }else{
            $.ajax({
                type:'POST',
                url:'login/cadastro',
                data:{'data' : form_array},
                success:function (retorno) {
                    retorno = JSON.parse(retorno);
                    if(retorno['status'] == false){
                        $.each(retorno['data'],function (indice,msg) {
                            form.find('input[name="'+indice+'"]').addClass('error');
                            form.find('div[data-identification="'+indice+'"]').text(msg).addClass('show');
                        });
                    }else if(retorno['status'] == true){
                        var retorno_notificacao = notification('Concluído','Cadastro concluído!','Login');
                        if(retorno_notificacao) $('#log-reg-show').click();
                    }
                }
            });
        }
    });
    $('#btn_form_login').on('click',function (e) {
        var form = $(this).closest('#form_login');
        var form_array = form.serializeArray();

        var error = false;
        var msg_error = [];

        form.find('input').removeClass('error');
        form.find('.div_error_individual').removeClass('show');
        $.each(form_array,function (i,v) {
            switch (v['name']) {
                case 'login':
                    if(v['value'].length == 0) {
                        error = true;
                        msg_error.push({'login':'Campo obrigatório!'});
                    }
                break;
                case 'senha_login':
                    if(v['value'].length == 0) {
                        error = true;
                        msg_error.push({'senha_login':'Campo obrigatório!'});
                    }
                break;
            }
        });

        if(error){
            $.each(msg_error,function (i,v) {
                $.each(v,function (identificador,mensagem) {
                    form.find('input[name="'+identificador+'"]').addClass('error');
                    form.find('div[data-identification="'+identificador+'"]').text(mensagem).addClass('show');
                });
            });
        }else{
            $.ajax({
                type:'POST',
                url:'login/verificacao',
                data:{'data' : form_array},
                success:function (retorno) {
                    retorno = JSON.parse(retorno);
                    if(retorno['status'] == false){
                        var msg = 'Email ou senha incorretos!';
                        form.find('input[type="text"]').addClass('error');
                        form.find('input[type="password"]').addClass('error');
                        form.find('.div_error_individual').text(msg).addClass('show');
                    }
                    else window.location.href = '/chat';
                }
            });
        }
    });
});