<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>
<?php
	if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
		$username = ucfirst(escape($_POST['username']));
		$email = escape($_POST['email']);
		$password = escape($_POST['password']);
		$password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));

		$query = "INSERT INTO users (user_name, user_email, user_password, user_role) ";
		$query .= "VALUES ('$username', '$email', '$password', 'subscriber')";
		$register_user_query = mysqli_query($connection, $query);
		confirmQuery($register_user_query);
	}
?>
<div class="container">
	<section id="login">
    <div class="row">
      <div class="col-xs-6 col-xs-offset-3">
        <div class="form-wrap">
          <h1>Register</h1>
          <p>You will be registered as a subscriber. In order to get to the CMS you will have to wait for admin to approve you.</p>
          <hr>
          <form role="form" action="registration.php" method="post" id="registrationForm" autocomplete="off">
            <div id="error" class="bg-error"></div>
            <div class="form-group has-feedback" id="usernameGroup">
              <label for="username" class="control-label">Username</label>
              <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" aria-describedby="usernameErrorStatus">
            </div>

            <div class="form-group has-feedback" id="emailGroup">
              <label for="email" class="control-label">Email</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" aria-describedby="emailErrorStatus">
            </div>

            <div class="form-group has-feedback passwordGroup">
              <label for="password" class="control-label">Password</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Password" aria-describedby="passwordErrorStatus">
            </div>

            <div class="form-group has-feedback passwordGroup">
              <label for="password" class="control-label">Confirm Password</label>
              <input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control" placeholder="Confirm Password" aria-describedby="passwordErrorStatus">
            </div>

            <input type="submit" name="submit" id="submit" class="btn btn-custom btn-lg btn-block" value="Register">
          </form>
        </div>
        <script>
					$('#registrationForm').submit(function(event) {
						event.preventDefault();
						var errorMessage="";

						function isValidEmailAddress(emailAddress) {
							var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
							return pattern.test(emailAddress);
						};

						if(!$("#username").val().trim()) {
							errorMessage = "Please enter a username";
							$("#usernameGroup").addClass("has-error");
							$(".usernameSuccessIcon").remove();
							$("#usernameGroup").append("<span class='glyphicon glyphicon-remove form-control-feedback usernameErrorIcon' aria-hidden='true'></span><span id='usernameErrorStatus' class='sr-only usernameErrorIcon'>(error)</span>");
						} else {
							$("#usernameGroup").removeClass("has-error");
							$("#usernameGroup").addClass("has-success");
							$(".usernameErrorIcon").remove();
							$("#usernameGroup").append("<span class='glyphicon glyphicon-ok form-control-feedback usernameSuccessIcon' aria-hidden='true'></span><span id='usernameErrorStatus' class='sr-only usernameSuccesIcon'>(success)</span>");
							$("#error").empty();
						}

						if(!isValidEmailAddress($("#email").val())) {
							errorMessage = errorMessage + "</br>Please enter a valid email address";
							$("#emailGroup").addClass("has-error");
							$(".emailSuccessIcon").remove();
							$("#emailGroup").append("<span class='glyphicon glyphicon-remove form-control-feedback emailErrorIcon' aria-hidden='true'></span><span id='emailErrorStatus' class='sr-only emailErrorIcon'>(error)</span>");
						} else {
							$("#emailGroup").removeClass("has-error");
							$("#emailGroup").addClass("has-success");
							$(".emailErrorIcon").remove();
							$("#emailGroup").append("<span class='glyphicon glyphicon-ok form-control-feedback emailSuccessIcon' aria-hidden='true'></span><span id='emailErrorStatus' class='sr-only emailSuccesIcon'>(success)</span>");
							$("#error").empty();
						}

						if(!$("#password").val().trim()) {
							errorMessage = errorMessage + "</br>Please enter a password";
							$(".passwordGroup").addClass("has-error");
							$(".passwordSuccessIcon").remove();
							$(".passwordGroup").append("<span class='glyphicon glyphicon-remove form-control-feedback passwordErrorIcon' aria-hidden='true'></span><span id='passwordErrorStatus' class='sr-only passwordErrorIcon'>(error)</span>");
						} else if($("#password").val() != $("#passwordConfirm").val()) {
							errorMessage = errorMessage + "</br>Please enter matching passwords";
							$(".passwordGroup").addClass("has-error");
							$(".passwordSuccessIcon").remove();
							$(".passwordGroup").append("<span class='glyphicon glyphicon-remove form-control-feedback passwordErrorIcon' aria-hidden='true'></span><span id='passwordErrorStatus' class='sr-only passwordErrorIcon'>(error)</span>");
						} else {
							$(".passwordGroup").removeClass("has-error");
							$(".passwordGroup").addClass("has-success");
							$(".passwordErrorIcon").remove();
							$(".passwordGroup").append("<span class='glyphicon glyphicon-ok form-control-feedback passwordSuccessIcon' aria-hidden='true'></span><span id='passwordErrorStatus' class='sr-only passwordSuccesIcon'>(success)</span>");
							$("#error").empty();
						}

						if(errorMessage=="") {
							$.ajax({
				        url: "registration.php",
				        type: "post",
				        data: $('#registrationForm').serialize()
					    	});
							$("#error").html("User created");
						} else {
							$("#error").html(errorMessage);
						}
					});
				</script>
      </div>
    </div>
	</section>
	<hr>
<?php include "includes/footer.php";?>
