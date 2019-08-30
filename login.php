<?php
die;
session_start();
//echo '<pre>';
$auth = (isset($_GET['auth']))?$_GET['auth']:false;
//var_dump($auth);
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="../../public/resources/custom/animated.css">

    <link rel="stylesheet" href="../../public/bootstrap-3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/bootstrap-3.4.1/css/bootstrap.min.css.map">
    <link rel="stylesheet" href="../../public/resources/custom/css-views/login.css">

    <script src="../../public/jquery/jquery.min.js"></script>
    <script src="../../public/bootstrap-3.4.1/js/bootstrap.min.js"></script>
    <script src="../../public/resources/custom/js-views/login.js"></script>
</head>
<body>
        <div class="in-left">

        <div class="login-reg-panel">
		<div class="login-info-box">
			<h2>Have an account?</h2>
			<p>Lorem ipsum dolor sit amet</p>
			<label id="label-register" for="log-reg-show">Login</label>
			<input type="radio" name="active-log-panel" id="log-reg-show"  checked="checked">
		</div>
							
		<div class="register-info-box">
			<h2>Don't have an account?</h2>
			<p>Lorem ipsum dolor sit amet</p>
			<label id="label-login" for="log-login-show">Register</label>
			<input type="radio" name="active-log-panel" id="log-login-show">
		</div>
							
		<div class="white-panel">
			<div class="login-show">
				<h2>LOGIN</h2>
				<input type="text" placeholder="Email">
				<input type="password" placeholder="Password">
				<input type="button" value="Login">
				<a href="">Forgot password?</a>
			</div>
			<div class="register-show">
				<h2>REGISTER</h2>
				<input type="text" placeholder="Email">
				<input type="password" placeholder="Password">
				<input type="password" placeholder="Confirm Password">
				<input type="button" value="Register">
			</div>
		</div>
	</div>
        </div>
</body>
</html>