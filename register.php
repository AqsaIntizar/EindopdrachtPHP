<?php
    require_once 'bootstrap/bootstrap.php';

    if (!empty($_POST)) {
        try {
            $security = new Verification();
            $security->password = $_POST['password'];
            $security->passwordConfirmation = $_POST['password_confirmation'];

            if ($security->passwordsAreSecure()) {
                $user = new User();
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['password']);
                $user->setUsername($_POST['username']);
                $user->setFirstname($_POST['firstname']);
                $user->setLastname($_POST['lastname']);
                if ($user->register()) {
                    header('Location: index.php');
                }
            } else {
                $error = 'Your passwords are not secure or do not match.';
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>includeFood - Register</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<form action="" method="post">
		<h2>Sign up for an account</h2>
		<?php if (isset($error)): ?>
				<div class="form__error">
					<p>
						💩 <?php echo $error; ?>
					</p>
				</div>
                <?php endif; ?>
				
		<label for="firstanme">Firstname</label>
		<input type="text" id="firstname" name="firstname">
			
		<label for="lastname">Lastname</label>
		<input type="text" id="lastname" name="lastname">

		<label for="username">Username</label>
		<input type="text" id="username" name="username">

		<label for="email">Email</label>
		<input type="text" id="email" name="email">

		<label for="password">Password</label>
		<input type="password" id="password" name="password">

		<label for="password_confirmation">Confirm your password</label>
		<input type="password" id="password_confirmation" name="password_confirmation">

		<input type="submit" value="Sign me up!" class="btn btn--primary">
	</form>
</body>
</html>
