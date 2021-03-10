<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

<style type="text/css">
	.message{
		position: absolute;
		font-weight: bold;
		font-size: 20px;
		color: #6495ED;
		left: 262px;
		width: 500px;
		text-align: center;
	}
	.error_msg{
	  position: absolute;
	  color:red;
	  font-weight: bold;
		font-size: 20px;
		left: 262px;
		width: 500px;
	  text-align: center;
	}
</style>


<div class="container">



<div class="card bg-light">
	<?php

      if (isset($message_display)) {
        echo "<div class='message'>";
        echo $message_display;
        echo "</div>";
      }
      else if(isset($error_message)){
      	echo "<div class='error_msg'>";
      	echo $error_message;
      	echo "</div>";
      }


    ?>  
<article class="card-body mx-auto" style="max-width: 400px;">
	<h4 class="card-title mt-3 text-center">Register Form</h4>

	 
	
	<form action="<?php echo site_url('login/add_register'); ?>" method="post">
		<div class="form-group input-group">
			<div class="input-group-prepend">
			    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
			 </div>
	        <input name="first_name" class="form-control" placeholder="First name" type="text" required>
	    </div> <!-- form-group// -->

	    <div class="form-group input-group">
			<div class="input-group-prepend">
			    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
			 </div>
	        <input name="last_name" class="form-control" placeholder="Last name" type="text" required>
	    </div> <!-- form-group// -->


	    <div class="form-group input-group">
	    	<div class="input-group-prepend">
			    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
			 </div>
	        <input name="email" class="form-control" placeholder="Email address" type="email" required>
	    </div> <!-- form-group// -->

	    <div class="form-group input-group">
	    	<div class="input-group-prepend">
			    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
			</div>
			
	    	<input name="mobile" class="form-control" placeholder="Phone number" type="number" maxlength="10" required>
	    </div> <!-- form-group// -->

	    
	    <div class="form-group input-group">
	    	<div class="input-group-prepend">
			    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
			</div>
	        <input class="form-control" placeholder="Create password" type="password" name="input_password" id="input_password" required>
	    </div> <!-- form-group// -->

	    <div class="form-group input-group">
	    	<div class="input-group-prepend">
			    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
			</div>
	        <input class="form-control" placeholder="Confirm password" type="password" name="confirm_password" id="confirm_password" required>
	    </div> <!-- form-group// -->

	    <span class="registrationFormAlert" id="CheckPasswordMatch" style="color:green;"></span>

	    <div class="form-group">
	        <button type="submit" class="btn btn-primary btn-block"> Create Account  </button>
	    </div> <!-- form-group// -->      
	    <p class="text-center">Have an account? <a href="<?=site_url('login/add_login')?>">Log In</a> </p>                                                                 
	</form>
</article>
</div> <!-- card.// -->

</div> 
<!--container end.//-->

<script type="text/javascript">
    $(document).ready(function() {
       $("#confirm_password").keyup(checkPasswordMatch);      
    });

    function checkPasswordMatch() {
        var password = $("#input_password").val();
        var confirmPassword = $("#confirm_password").val();
        if (password != confirmPassword)
            $("#CheckPasswordMatch").html("Passwords does not match!");
        else
            $("#CheckPasswordMatch").html("Passwords match.");
    }
</script>

