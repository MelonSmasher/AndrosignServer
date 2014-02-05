<?php
include_once 'includes/register.inc.php';
include_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="/assets/css/bootstrap.css" rel="stylesheet">
		<link href="/assets/css/custom.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
		<title>Registration</title>
	</head>
	<body>

		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="/">Androsign CMS</a>
				</div>
			</div>
		</div>

		<!-- Registration form to be output if the POST variables are not
		set or if the registration script caused an error. -->
		<?php
		if (!empty($error_msg)) {
			echo $error_msg;
		}
		?>
		<div class="container">
			<form class="form-signin" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="registration_form">
				<h1 class="form-signin-heading">Registration</h1>
				<ul>
					<li>
						Usernames may contain only digits, upper and lower case letters and underscores
					</li>
					<li>
						Emails must have a valid email format
					</li>
					<li>
						Passwords must be at least 6 characters long
					</li>
					<li>
						Passwords must contain
						<ul>
							<li>
								At least one upper case letter (A..Z)
							</li>
							<li>
								At least one lower case letter (a..z)
							</li>
							<li>
								At least one number (0..9)
							</li>
						</ul>
					</li>
					<li>
						Your password and confirmation must match exactly
					</li>
				</ul>
				<br>
				<label for="username">Username</label>
				<input type='text'
				name='username'
				id='username' />
				<br>
				<label for="email">Email Address</label>
				<input type="text"
				name="email"
				id="email" />
				<br>
				<label for="password">Password</label>
				<input type="password"
				name="password"
				id="password"/>
				<br>
				<label for="confirmpwd">Confirm password</label>
				<input type="password"
				name="confirmpwd"
				id="confirmpwd" />
				<br>
				<input type="button"
				class="btn btn-medium btn-primary"
				value="Register"
				onclick="return regformhash(this.form,
				this.form.username,
				this.form.email,
				this.form.password,
				this.form.confirmpwd);" />
			</form>
		</div>
		<script src="/assets/js/sha512.js"></script>
		<script src="/assets/js/forms.js"></script>
		<script src="/assets/js/jquery.js"></script>
		<script src="/assets/js/bootstrap.js"></script>
		<script src="/assets/js/bootstrap.min.js"></script>
	</body>
</html>