<?php $view->component('start') ?>

<form action="/register/new" method="post" class="margin-left-15" >
	        	<div class="form-group" >
	        		<div>
		        		<h2 class="form-group">Username</h2>       		
		              	<input type="text" name="name" class="form-control" placeholder="jacob">           
		          	</div>
					<div>
						<?php
                         if (isset($_SESSION['name'])) {
                             echo reset($_SESSION['name']);
                             unset($_SESSION['name']);
                         }?>
					</div>
	        	</div>
	        	<div class="form-group">
	        		<div>
		        		<h2 class="form-group">Password</h2>	
		              	<input type="password" name="password" class="form-control" placeholder="******">           
		          	</div>
					<div>
						<?php
                          if (isset($_SESSION['password'])) {
                              echo reset($_SESSION['password']);
                              unset($_SESSION['password']);
                          }?>
					</div>	
	        	</div>	          	
				<div class="form-group">
					<button type="submit" class="templatemo-blue-button">Add</button>
				</div>
				<div>
					<?php

                    if (isset($_SESSION['auth_error'])) {
                        echo $_SESSION['auth_error'];
                        unset($_SESSION['auth_error']);
                    }?>
				</div>
				
	        </form>

<?php $view->component('end') ?> 