
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title><?php echo $view->getTitle(); ?></title>
    <link href="/assets/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/templatemo-style.css" rel="stylesheet">
  </head>
  <body>  
    <!-- Left column -->
    <div class="templatemo-flex-row">
      <div class="templatemo-sidebar">
        <header class="templatemo-site-header">
          <div class="square"></div>
          <h1>Casual Admin</h1>
        </header>  
        <nav class="templatemo-left-nav">          
          <ul>
            <li><a href="/" class="active"><i class="fa fa-home fa-fw"></i>Dashboard</a></li>
            <li><a href="/event/new"><i class="fa fa-bar-chart fa-fw"></i>Create Event</a></li>
            <li><a href="/event/explore"><i class="fa fa-database fa-fw"></i>Event Visualization</a></li>
            <li><a href="/profile/"><i class="fa fa-users fa-fw"></i>Manage Profile</a></li>
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
       <?php if ($_SESSION['is_admin'] ?? 0 == 1) {?>
        <div class="templatemo-top-nav-container">
          <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
              <ul class="text-uppercase">
                <li><a href="/" class="active">Admin panel</a></li>
                <li><a href="/">Dashboard</a></li>
                <li><a href="/">Overview</a></li>
                <li><a href="/registration">Add new user</a></li>
              </ul>  
            </nav> 
          </div>
        </div>
      <?php } ?>