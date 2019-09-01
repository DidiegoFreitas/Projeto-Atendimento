<?php include $this->header;?>

<link rel="stylesheet" href="../../public/resources/custom/css-views/index.css">
<link rel="stylesheet" href="../../public/resources/custom/css-views/chat.css">
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script src="../../public/resources/custom/js-views/chat_pusher.js"></script>
<script src="../../public/resources/custom/js-views/create_chat.js"></script>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Inicio</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <!--ul class="nav navbar-nav">
                <li class=""><a href="#">Link <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">One more separated link</a></li>
                </ul>
                </li>
            </ul-->
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/logout">Logout</a></li>
                <!--li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
                </li-->
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<h1>Pusher</h1>
<div><p><?=json_encode($_SESSION);?></p></div>
<div id="container_chat" class="col-xs-12 col-sm-12 col-md-12 container_chat"></div>

<script>
    var id_user = '<?=rand(1,3);?>';
    /*console.log(id_user);
    var container_chat = $('#container_chat');
    crate_connection(id_user);
    container_chat.append(create_chat());
    container_chat.on('submit','#form_mensagem',function (e) {
        e.preventDefault();
        send_mensage(id_user,'2',$('#input_send_mensagem').val());
    });*/
</script>
<script src="../../public/resources/custom/js-views/conf_channel.js"></script>


<?php include $this->header;?>