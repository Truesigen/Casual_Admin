<?php $view->component('start');

?>
<div class="templatemo-flex-row flex-content-row">
            <div class="templatemo-content-widget white-bg col-2">
             
              <div class="media margin-bottom-30">
                <div class="media-left padding-right-25">
                  <a href="#">
                    <img class="media-object img-circle templatemo-img-bordered" src="<?php echo isset($user) ? $user->avatar() : '/assets/avatars/default.jpg' ?>"
                     alt="Sunset">
                  </a>
                </div>
                <?php if (isset($user)) {?>
                <div class="col-lg-6 col-md-6 form-group"> 
                <label class="control-label templatemo-block">Change avatar</label>  
                <form action="/profile/avatar/new/" method="get">               
                <select name="avatar" class="">
                      <?php foreach ($user->avatars as $value) { ?>
                  <option value="<?= $value ?>"><?= $value?></option>
                  <?php }
                      ?>                  
                </select>
                <button type="submit">save</button>
                </form>
              </div>
              <?php } ?>
                <div class="media-body">
                  <h2 class="media-heading text-uppercase blue-text"><?= $user->name ?? 'John Doe' ?></h2>
                  <p>Project Manager</p>
                </div>        
              </div>
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <td><div class="circle green-bg"></div></td>
                      <td>New Task Issued</td>
                      <td>02</td>                    
                    </tr> 
                    <tr>
                      <td><div class="circle pink-bg"></div></td>
                      <td>Task Pending</td>
                      <td>22</td>                    
                    </tr>  
                    <tr>
                      <td><div class="circle blue-bg"></div></td>
                      <td>Inbox</td>
                      <td>13</td>                    
                    </tr>  
                    <tr>
                      <td><div class="circle yellow-bg"></div></td>
                      <td>New Notification</td>
                      <td>18</td>                    
                    </tr>                                      
                  </tbody>
                </table>
              </div>             
            </div>
            
            

<?php $view->component('end') ?>