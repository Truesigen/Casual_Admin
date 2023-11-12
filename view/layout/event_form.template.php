<?php $view->component('start'); ?>
<div class="templatemo-content-widget white-bg">
            <h2 class="margin-bottom-10">Preferences</h2>
            <p>Here goes another trivial todo event.</p>
            <form action="/event/new" class="templatemo-login-form" method="post">
                <input type="hidden" name="user_id" value="<?=$_SESSION['user_id'] ?? 0?>">
              <div class="row form-group">
                <div class="col-lg-7 col-md-6 form-group">                  
                    <label for="inputUsername">Theme</label>
                    <input type="text" class="form-control" name="header" id="inputUsername" placeholder="Save the World"> 
                    <?php $view->seeErrors('header'); ?>                 
                </div>
                  <div class="col-lg-7 form-group">                   
                      <label class="control-label" for="description">Description</label>
                      <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                      <?php $view->seeErrors('description'); ?>   
                </div>
                <div class="col-lg-7 col-md-6 form-group">                  
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control" id="inputEmail" placeholder="admin@company.com">                  
                </div> 
              </div>
              <div class="row form-group">
                  <div class="col-lg-7 col-md-6 form-group">                  
                      <label for="inputCurrentPassword">Current Password</label>
                      <input type="password" class="form-control highlight" name="password" id="inputCurrentPassword"  placeholder="*********************">                  
                      <?php $view->seeErrors('password'); ?>  
                    </div>                
                </div>
                <div class="red-text">
                    <?php $view->seeErrors('event_error'); ?>
                </div>
              <div class="form-group text-right">
                <?php if (isset($_SESSION['user_id'])) {?>
                    <button type="submit" class="templatemo-blue-button">Submit</button>
               <?php } else {?>
                    <a href="/login" class="templatemo-blue-button">Login first</a>
                <?php } ?>
              </div>                           
            </form>
          </div>
<?php $view->component('end');
