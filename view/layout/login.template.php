
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">  
	    <title>Login</title>

        <!-- 
        Visual Admin Template
        http://www.templatemo.com/preview/templatemo_455_visual_admin
        -->
	    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
	    <link href="assets/font-awesome.min.css" rel="stylesheet">
	    <link href="assets/bootstrap.min.css" rel="stylesheet">
	    <link href="assets/templatemo-style.css" rel="stylesheet">
	    
	    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
	<body class="light-gray-bg">
		<div class="templatemo-content-widget templatemo-login-widget white-bg">
			<header class="text-center">
	          <div class="square"></div>
	          <h1>Casual Admin</h1>
	        </header>
	        <form action="/login" method="post" class="templatemo-login-form">
	        	<div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>	        		
		              	<input type="text" name="name" class="form-control" placeholder="js@dashboard.com">           
		          	</div>
					<div class="danger" style="color:red;" >
				<?php
                if (isset($_SESSION['name'])) {
                    echo reset($_SESSION['name']);
                    unset($_SESSION['name']);
                }
				?>
					</div>	
	        	</div>
	        	<div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>	        		
		              	<input type="password" name="password" class="form-control" placeholder="******">           
		          	</div>	
					<div class="danger" style="color:red;">
					<?php
				if (isset($_SESSION['password'])) {
				    echo reset($_SESSION['password']);
				    unset($_SESSION['password']);
				}
				?>
					</div>
	        	</div>	          	
	          	
				<div class="form-group">
					<button type="submit" class="templatemo-blue-button width-100">Login</button>
				</div>
				<div class="danger" style="color:red;">
					<?php if (isset($_SESSION['auth_error'])) {
					    echo $_SESSION['auth_error'];
					    unset($_SESSION['auth_error']);
					} ?>
				</div>
	        </form>
		</div>
		<div class="templatemo-content-widget templatemo-login-widget templatemo-register-widget white-bg">
			<p>Not a registered user yet? <strong><a href="#" class="blue-text">Sign up now!</a></strong></p>
		</div>
	</body>
</html>