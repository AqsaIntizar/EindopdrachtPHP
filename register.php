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
                $error = 'Your passwords are not secure or do not match. password should have 8 charachters';
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
  <title>IncludeFood - Register</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="jo">
	<form action="" method="post">
		<h2>Sign up for an account</h2>
		<?php if (isset($error)): ?>
				<div class="form__error">
					<p class="error">
						 <?php echo $error; ?>
					</p>
				</div>
                <?php endif; ?>
		<div class="signup">
		<input type="text" id="firstname" name="firstname" placeholder="Firstname"><br>
			
		<input type="text" id="lastname" name="lastname" placeholder="Lastname"><br>

		<input type="text" id="username" name="username" placeholder="Username"><br>

		<input type="text" id="email" name="email" placeholder="Email"><br>

		<input type="password" id="password" name="password" placeholder="Password"><br>

		<input type="password" id="password_confirmation" name="password_confirmation" placeholder="password_confirmation"><br>
        </div>
		<input type="submit" value="Sign me up!" class="btn btn--primary"><br>
		
		<a href="login.php" class="registerLink">I already have an account!</a>
        </div>
	</form>
	
</body>
</html>
