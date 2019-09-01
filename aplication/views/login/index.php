<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link rel="stylesheet" href="../../public/resources/custom/animated.css?rand=<?=rand(1,99)?>">

    <link rel="stylesheet" href="../../public/bootstrap-3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/bootstrap-3.4.1/css/bootstrap.min.css.map">
    <link rel="stylesheet" href="../../public/resources/custom/css-views/login.css?rand=<?=rand(1,99)?>">

    <script src="../../public/jquery/jquery.min.js"></script>
    <script src="../../public/jquery/jquery.mask.js"></script>
    <script src="../../public/jquery/SPMaskBehavior.js"></script>
    <script src="../../public/jquery/sweetalert.min.js"></script>
    <script src="../../public/resources/custom/js-views/notification.js?rand=<?=rand(1,99)?>"></script>
    
    <script src="../../public/bootstrap-3.4.1/js/bootstrap.min.js"></script>
    <script src="../../public/resources/custom/js-views/login.js?rand=<?=rand(1,99)?>"></script>
</head>
<body>
    <div class="in-right container-login">
        <div class="login-reg-panel">
            <div class="login-info-box">
                <h2>Já possui conta?</h2>
                <p>
                    Não perca mais tempo
                    <br/>
                    Converse agora com um de nossos atendentes
                </p>
                <label id="label-register" for="log-reg-show">Login</label>
                <input type="radio" name="active-log-panel" id="log-reg-show"  checked="checked">
            </div>
                                
            <div class="register-info-box">
                <h2>Não possui conta?</h2>
                <p>
                    Sabia que você pode conversar diretamente com um de nossos atendentes e tempo real.
                    <br/>
                    E ainda pode acompanhar seus chamados
                </p>
                <label id="label-login" for="log-login-show">Cadastrar - se</label>
                <input type="radio" name="active-log-panel" id="log-login-show">
            </div>
                                
            <div class="white-panel">
                <div class="login-show">
                    <h2>LOGIN</h2>
                    <form id="form_login" action="#">
                        <input type="text" name="login" placeholder="Email">
                        <div class="div_error_individual" data-identification="login"></div>
                        <input type="password" name="senha_login" placeholder="Senha">
                        <div class="div_error_individual" data-identification="senha_login"></div>
                        <input id="btn_form_login" type="button" value="Login">
                    </form>
                </div>
                <div class="register-show">
                    <h2>CADASTRO</h2>
                    <form id="form_register" action="#">
                        <input type="text" name="nome" placeholder="Nome">
                        <div class="div_error_individual" data-identification="nome"></div>
                        <input type="text" name="email" placeholder="Email">
                        <div class="div_error_individual" data-identification="email"></div>
                        <input type="text" name="telefone" placeholder="Telefone">
                        <div class="div_error_individual" data-identification="telefone"></div>
                        <input type="password" name="senha" placeholder="Senha">
                        <div class="div_error_individual" data-identification="senha"></div>
                        <input type="password" name="conf_senha" placeholder="Confirmar Senha">
                        <div class="div_error_individual" data-identification="conf_senha"></div>

                        <input id="btn_form_register" type="button" value="Cadastrar">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>