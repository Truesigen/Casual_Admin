<?php $view->component('start'); ?>

     
<div class="form-group panel-default  white-bg no-padding templatemo-overflow-hidden">
                <div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase">My Events</h2></div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <td>No.</td>
                        <td>Event</td>
                        <td>Description</td>
                        <td>Created in</td>
                        <td>Worker</td>
                      </tr>
                      </thead>
                      <tbody><?php if (isset($events)) {
                          $i = 1;
                          foreach ($events as $event) {?>
                     <tr>
                     <td><?= $i ?></td>
                     <td><?= $event['header'] ?></td>
                     <td><?= $event['description']?></td>
                     <td><?= $event['created_at']?></td>
                     <td><a href="/event/explore/chatting/?user=<?= $event['user_id']?>" class="templatemo-white-button">Chat</a></td>
                     </tr> <?php $i++;
                          }
                      }?>   
                    </tbody>
                  </table>    
                </div>                          
              </div>
<div class="form-group panel-default  white-bg no-padding templatemo-overflow-hidden">
                <div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase">Tasks in progress</h2></div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <td>No.</td>
                        <td>Event</td>
                        <td>Description</td>
                        <td>Created in</td>
                        <td>Action</td>
                      </tr>
                    </thead>
                    <tbody>
                  <?php if (isset($tasks)) {
                      $i = 1;
                      foreach ($tasks as $task) {?>
                    <tr>
                     <td><?= $i ?></td>
                     <td><?= $task['header'] ?></td>
                     <td><?= $task['description']?></td>
                     <td><?= $task['created_at']?></td>
                     <td><a href="/event/explore/chatting/?user=<?=$task['created_by']?>" class="templatemo-white-button">Chat</a></td>
                     </tr>
                    <?php $i++;
                      }
                  }?>   
                    </tbody>
                  </table>    
                </div>                          
              </div>


    <?php $view->component('end') ?>