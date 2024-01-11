<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">  
	    <title><?php echo $view->getTitle()?></title>
	    <link href="/assets/bootstrap.min.css" rel="stylesheet">
	    <link href="/assets/templatemo-style.css" rel="stylesheet">
	</head>
	<body class="light-gray-bg">
		<div class="templatemo-content-widget templatemo-login-widget white-bg">
			<header class="text-center">
	          <div class="square"></div>
	          <h1>Casual Admin</h1>
			  <h2>Registration</h2>
	        </header>
				<form action="/registration" method="post" class="templatemo-login-form">
	        	<div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon blue-text"><?php $session->seeErrors('name'); ?></div>	        		
		              	<input type="text" name="name" class="form-control" placeholder="Rafael" value="<?php echo $session->old('name')?>"/>           
		          	</div>
	        	</div>
	        	<div class="form-group">
	        		<div class="input-group">
		              	<input type="password" name="password" class="form-control" placeholder="******" />         
		        		<div class="input-group-addon blue-text"><?php $session->seeErrors('password'); ?></div>	 	        		
		          	</div>		
	        	</div>	          	
				<div class="form-group">
					<button type="submit" class="templatemo-blue-button width-100">Sign up</button>
				</div>
				<div class="input-group-addon red-text"><?php $session->seeErrors('auth_error')?></div>
	        </form>
			</div>
		<div class="templatemo-content-widget templatemo-login-widget templatemo-register-widget white-bg">
			<p>Already registered? <strong><a href="/login" class="blue-text">Sign in now!</a></strong></p>
		</div>
	</body>
</html>
