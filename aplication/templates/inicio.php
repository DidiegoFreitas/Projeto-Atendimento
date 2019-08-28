<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="../../public/resources/image/ico_madeiramadeira_Qq6_icon.ico">
    <title>Template</title>

    <?php 
        $this->content_cdn();
        $this->content_cdn_view();
    ?>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Atendimento</a>
        </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" data-toggle="modal" data-target="#modalLRForm"><i class="glyphicon glyphicon-user"></i> Login</a></li>
            </ul>
            </div>
        </div>
    </nav>
    
    <!--Modal: Login / Register Form-->
<div class="modal fade" id="modalLRForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog cascading-modal" role="document">
    <!--Content-->
    <div class="modal-content">

      <!--Modal cascading tabs-->
      <div class="modal-c-tabs">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" style="
        box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
    margin: -1.5rem 1rem 0 1rem;
    display: flex;
    background-color: #0277bd!important;
    flex-wrap: wrap;
    z-index: 1;
    position: relative;
    border-radius: .25rem;
    border: 0;
    padding: .7rem;
        " role="tablist">
          <li class="nav-item" style="
              flex: 1;
              margin-bottom: -1px;
              list-style: none;
              position: relative;
    cursor: pointer;
    overflow: hidden;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
          ">
            <a class="nav-link active" style="
                text-align: center;
                background-color: rgba(0,0,0,.2);
    color: #fff;
    transition: all 1s;
    border-radius: .25rem;
    border-color: #dee2e6 #dee2e6 #fff;
    border: 0;
    display: block;
    padding: .5rem 1rem;
    cursor: pointer;
    text-decoration: none;
            " data-toggle="tab" href="#panel7" role="tab"><i class="fas fa-user mr-1"></i>
              Login</a>
          </li>
          <li class="nav-item" style="
              flex: 1;
              margin-bottom: -1px;
              list-style: none;
              position: relative;
    cursor: pointer;
    overflow: hidden;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
          ">
            <a class="nav-link" style="
                text-align: center;
    color: #fff;
    transition: all 1s;
    border-radius: .25rem;
    border-color: #dee2e6 #dee2e6 #fff;
    border: 0;
    display: block;
    padding: .5rem 1rem;
    cursor: pointer;
    text-decoration: none;
            " data-toggle="tab" href="#panel8" role="tab"><i class="fas fa-user-plus mr-1"></i>
              Register</a>
          </li>
        </ul>

        <!-- Tab panels -->
        <div class="tab-content">
          <!--Panel 7-->
          <div class="tab-pane fade in active" id="panel7" role="tabpanel">

            <!--Body-->
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <label for="exampleInputEmail1" class="col-sm-1 control-label">
                            <i class="glyphicon glyphicon-envelope"></i>
                        </label>
                        <div class="col-sm-11">
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="exampleInputPassword1" class="col-sm-1 control-label">
                            <i class="glyphicon glyphicon-lock"></i>
                        </label>
                        <div class="col-sm-11">
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Senha">
                        </div>
                    </div>
                </div>
            </div>

          </div>
          <!--/.Panel 7-->

            <!--Panel 8-->
            <div class="tab-pane fade" id="panel8" role="tabpanel">

            <!--Body-->
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <label for="exampleInputEmail1" class="col-sm-1 control-label">
                                <i class="glyphicon glyphicon-envelope"></i>
                            </label>
                            <div class="col-sm-11">
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="exampleInputPassword1" class="col-sm-1 control-label">
                                <i class="glyphicon glyphicon-lock"></i>
                            </label>
                            <div class="col-sm-11">
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Senha">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="exampleInputPassword1" class="col-sm-1 control-label">
                                <i class="glyphicon glyphicon-lock"></i>
                            </label>
                            <div class="col-sm-11">
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Senha">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          <!--/.Panel 8-->
        </div>

      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: Login / Register Form-->

    <?php
        $this->content();
    ?>
</body>
</html>