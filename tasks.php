<?php
  require "./databaseFunctions/taskDisplayFunctions.php";
?>

      <h3 class="ui top attached header">Volunteer Tasks</h3>
	  <!-- Temporary location until team decides where to put it -->
	  
<?php 
	if (getCookieData('accountType') == "admin") {
		echo '<div class="ui attached segment"><a href=index.php?action=taskForm>Create Task</a></div>';
	}  
?>	  
      <div class="ui attached segment four column grid">


<?php 
		
					
			


  try {

    try {
		$tasks = get_tasks();
        if($tasks){
          foreach($tasks as $singleTask){	
            $taskID = $singleTask['taskID'];
            $taskName = $singleTask['taskName'];            
            $taskDateTime = $singleTask['taskDateTime'];
            $volunteersNeeded = $singleTask['volunteersNeeded'];
            $volunteersMax = $singleTask['volunteersMax'];
			$strippedTaskName =  str_replace([' '," ",'-'], "", $taskName);
            $strippedTime = str_replace([':'," "], "", $taskDateTime);
			$registered_ind = $singleTask['registered_ind'];
			if ($registered_ind == 'Y') {
				$registrationURL = '<a class="ui red button" href=index.php?action=unregister&taskID='.$taskID.'>Unregister</a>';
			} else {
				$registrationURL = '<a class="ui green button" href=index.php?action=register&taskID='.$taskID.'>Register</a>';
			}
			if (getCookieData('accountType') == "admin") {
				$updateTaskURL = '<a id="edit" class="ui primary button" href=index.php?action=taskForm&taskID='.$taskID.'>Edit</a>';
			} else {
				$updateTaskURL = '';
			}

			// to set the button link for editing or register/unregister based on admin status
			$buttonLink = '';
			if ($updateTaskURL==''){
				$buttonLink=$registrationURL;
			} else {
				$buttonLink=$updateTaskURL;
			}

			echo "
			<div class='ui row'>
					<div class='header column'>".$taskName."</div>"
					."<div class='column'>".$taskDateTime."</div>"
					."<div class='column'>"
					."<div class='ui grid two column row'>"
					    ."<div class='column'>".$volunteersNeeded."</div>"
					    ."<div class='column'>".$volunteersMax."</div>"
					."</div>"
					."</div>"
					."<div class='column'>".$buttonLink."</div>"
				."</div>";
          }
        }
    }
    catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
    }
  }
  catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
?>
		<div class="ui small modal transition hidden" id='edit-modal'>
			<div class="header">Header</div>
			<div class="content">
				<p></p>
			</div>
			<div class="actions">
				<div class="ui approve button">Approve</div>
				<div class="ui button">Neutral</div>
				<div class="ui cancel button">Cancel</div>
			</div>
		</div>
	</div>
	<br>
	<br>










