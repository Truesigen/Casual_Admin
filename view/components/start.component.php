
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title><?php echo $view->getTitle(); ?></title>

    <!-- 
    Visual Admin Template
    http://www.templatemo.com/preview/templatemo_455_visual_admin
    -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="/assets/font-awesome.min.css" rel="stylesheet">
    <link href="/assets/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/templatemo-style.css" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>  
    <!-- Left column -->
    <div class="templatemo-flex-row">
      <div class="templatemo-sidebar">
        <header class="templatemo-site-header">
          <div class="square"></div>
          <h1>Casual Admin</h1>
        </header>  
        <!-- Search box -->
        <div class="mobile-menu-icon">
            <i class="fa fa-bars"></i>
        </div>
        <nav class="templatemo-left-nav">          
          <ul>
            <li><a href="#" class="active"><i class="fa fa-home fa-fw"></i>Dashboard</a></li>
            <li><a href="data-visualization.html"><i class="fa fa-bar-chart fa-fw"></i>Charts</a></li>
            <li><a href="data-visualization.html"><i class="fa fa-database fa-fw"></i>Data Visualization</a></li>
            <li><a href="maps.html"><i class="fa fa-map-marker fa-fw"></i>Maps</a></li>
            <li><a href="manage-users.html"><i class="fa fa-users fa-fw"></i>Manage Users</a></li>
            <li><a href="preferences.html"><i class="fa fa-sliders fa-fw"></i>Preferences</a></li>
            <?php
            if (isset($_SESSION['user_id'])) {?>
            <li><a href="/exit"><i class="fa fa-eject fa-fw"></i>Sign Out</a></li>
            <?php } else {?>
            <li><a href="/login"><i class="fa fa-eject fa-fw"></i>Sign in</a></li>
              <?php }?>
          </ul>  
        </nav>
      </div>
      <!-- Main content --> 
      <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container">
          <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
              <ul class="text-uppercase">
                <li><a href="/" class="active">Admin panel</a></li>
                <li><a href="/">Dashboard</a></li>
                <li><a href="/">Overview</a></li>
                <li><a href="/register/new">Add new user</a></li>
              </ul>  
            </nav> 
          </div>
        </div>