<?php 
function QuizShortcode(){ 

include('cdnfiles.php');
	?>


<div class="container">

<div class="col-md-3"></div>
<div class="col-md-6">
	<p><?php if(isset($error)){
		echo  $error;
	} ?></p>
<div class="jumbotron">
		
			
				<h4>User login</h4>
				<form action="<?php echo plugins_url();?>/viv-quiz-plugin/user_login.php" method="POST">
					<div class="form-group">
					<label>Username:</label>
					<input type="text" name="user_email" placeholder="Uername" class="form-control">
					</div>
					<div class="form-group">
					<label>Password:</label>
					<input type="password" name="user_password" placeholder="Password" class="form-control">
					</div>
					<input type="submit" name="login" value="Login">
				</form>
				<button data-toggle="modal" data-target="#myModal" class="pull-right">Register Here</button>
				<a href="<?php echo site_url();?>/lost-password">Lost Password</a>
			
		</div>
		</div>
<div class="col-md-3"></div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Registration Form</h4>
      </div>
      <div class="modal-body">
      	<form action="<?php echo plugins_url();?>/viv-quiz-plugin/user_registration.php"  method = "POST" 
      		onsubmit="return registrationFormValidation();">
      		<div class="form-group">
      			<label>First Name:</label>
      			<input type="text" name="first_name" class="form-control" placeholder="Enter Name" id="first_name">
      				<div class="popup_error" id="first_name_error_msg"></div>
      			
      		</div>
      		<div class="form-group">
      			<label>Last Name:</label>
      			<input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" id="last_name">
      			<div class="popup_error" id="last_name_error_msg"></div>
      			
      		</div>
      		<div class="form-group">
      			<label>Email:</label>
      			<input type="email" name="user_email" class="form-control" placeholder = "Enter Email" id="insert_email">
      			<div class="popup_error" id="email_error_msg"></div>
      			
      		</div>
      		<div class="form-group">
      			<label>Password:</label>
      			<input type="password" name="user_password" class="form-control" placeholder="Enter password">
      		</div>
      		<div class="form-group">
      			<center><input type="submit" name="insert" value="Register"></center>
      		</div>
      	</form>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>	
</div>
<?php get_footer(); ?>
<script type="text/javascript">
/*
validation for registration form on client side

*/

	function registrationFormValidation(){

		var first_name = $('#first_name').val();
		var last_name = $('#last_name').val();
		var insert_email = $('#insert_email').val();
		//alert(insert_email);

		if(first_name==""){
			$('#first_name_error_msg').show();
			$('#first_name_error_msg').css('color','#CC0000');
			$('#first_name_error_msg').html('Please Enter First Name');
			$('#first_name').focus();
  			$('#first_name').addClass('error');
  			setTimeout("$('#first_name_error_msg').fadeOut(); ", 3000);
return false;

		}

		if(last_name== ""){
			$('#last_name_error_msg').show();
			$('#last_name_error_msg').css('color','#CC0000');
			$('#last_name_error_msg').html('Please Enter Last Name');
			$('#last_name').focus();
			$('#last_name').addClass('error');
			setTimeout("$('#last_name_error_msg').fadeOut();",3000);
			return false;

		}

		if(insert_email== ""){
			$('#email_error_msg').show();
			$('#email_error_msg').css('color','#CC0000');
			$('#email_error_msg').html('Please Enter Email');
			$('#insert_email').focus();
			$('#insert_email').addClass('error');
			setTimeout("$('#email_error_msg').fadeOut();",3000);
			return false;

		}

	}
</script>

	
<?php
} 

add_shortcode('Quiz-page','QuizShortcode');
?>