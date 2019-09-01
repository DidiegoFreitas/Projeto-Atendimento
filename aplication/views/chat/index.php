<?php include $this->header;?>

<link rel="stylesheet" href="../../public/resources/custom/css-views/index.css?rand=<?=rand(1,99)?>">
<link rel="stylesheet" href="../../public/resources/custom/css-views/chat.css?rand=<?=rand(1,99)?>">
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script src="../../public/resources/custom/js-views/chat_pusher.js?rand=<?=rand(1,99)?>"></script>
<script src="../../public/resources/custom/js-views/create_chat.js?rand=<?=rand(1,99)?>"></script>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Botão de navegação</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Inicio</a>
        </div>
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

<div id="container_chat" class="col-xs-12 col-sm-12 col-md-12 container_chat"></div>

<script src="../../public/resources/custom/js-views/chat.js?rand=<?=rand(1,99)?>"></script>

<?php include $this->header;?>