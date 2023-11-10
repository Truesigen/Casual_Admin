 <?php $view->component('start');

?>
    
    <div class="panel panel-default templatemo-content-widget white-bg no-padding templatemo-overflow-hidden">
                <i class="fa fa-times"></i>
                <div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase">Event list</h2></div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <td>No.</td>
                        <td>Username</td>
                        <td>Event</td>
                        <td>Description</td>
                        <td>Created</td>
                      </tr>
                    </thead>
                    <tbody>
                  <?php foreach ($events as $event) {
                      $view->component('todo_table', ['event' => $event]);
                  }?>   
                    </tbody>
                  </table>    
                </div>                          
              </div>
                   

 

    <?php $view->component('end') ?>