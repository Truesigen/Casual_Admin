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
			  <h2>Authorization</h2>
	        </header>
	        <form action="/sign-in" method="post" class="templatemo-login-form">
	        	<div class="form-group">
	        		<div class="input-group">
						<input type="text" name="name" class="form-control" placeholder="Geralt">           
		        		<div class="input-group-addon blue-text"><?php $session->seeErrors('name'); ?></div>	        		
		          	</div>
	        	</div>
	        	<div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon blue-text"><?php $session->seeErrors('password'); ?></div>	        		
		              	<input type="password" name="password" class="form-control" placeholder="******">           
		          	</div>	
	        	</div>	          	
				<div class="form-group">
					<button type="submit" class="templatemo-blue-button width-100">Login</button>
				</div>
				<div class="input-group-addon red-text"><?php $session->seeErrors('auth_error'); ?></div>
	        </form>
		</div>
		<div class="templatemo-content-widget templatemo-login-widget templatemo-register-widget white-bg">
			<p>Not a registered user yet? <strong><a href="/register-new-user" class="blue-text">Sign up now!</a></strong></p>
		</div>
	</body>
</html>