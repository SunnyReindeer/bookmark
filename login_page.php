<!DOCTYPE html>
<html>

<head>
	<title>LOGIN</title>
	<link rel="stylesheet" href="login.css">
</head>

<body>
	<div class="wrapper">
		<div class="card-switch">
			<label class="switch">
				<input type="checkbox" class="toggle">
				<span class="slider"></span>
				<span class="card-side"></span>
				<div class="flip-card__inner">
					<div class="flip-card__front">
						<div class="title">Log in</div>
						<form class="flip-card__form" action="login.php" method="post">
							<?php if (isset($_GET['error'])) { ?>
								<p class="error">
									<?php echo $_GET['error']; ?>
								</p>
							<?php } ?>
							<input class="flip-card__input" name="email" placeholder="Email" type="email">
							<input class="flip-card__input" name="password" placeholder="Password" type="password">
							<button class="flip-card__btn">Login</button>
						</form>
					</div>
					<div class="flip-card__back">
						<div class="title">Sign up</div>
						<form class="flip-card__form" action="signup-check.php" method="post">
							<?php if (isset($_GET['error'])) { ?>
								<p class="error">
									<?php echo $_GET['error']; ?>
								</p>
							<?php } ?>

							<?php if (isset($_GET['success'])) { ?>
								<p class="success">
									<?php echo $_GET['success']; ?>
								</p>
							<?php } ?>

							<?php if (isset($_GET['name'])) { ?>
								<input class="flip-card__input" placeholder="Name" type="name"
									value="<?php echo $_GET['name']; ?>">


							<?php } else { ?>
								<input type="text" name="name" placeholder="Name" class="flip-card__input">
							<?php } ?>
							<?php if (isset($_GET['email'])) { ?>
								<input type="email" class="flip-card__input" name="email" placeholder="Email" 
									value="<?php echo $_GET['email']; ?>"><br>
							<?php } else { ?>
								<input type="email" name="email" placeholder="Email Address" class="flip-card__input">
							<?php } ?>
							<input class="flip-card__input" name="password" placeholder="Password" type="password">
							<input class="flip-card__input" name="re_password" placeholder="Re-Enter Your Password"
								type="password">
							<button class="flip-card__btn">Confirm!</button>
						</form>
					</div>
				</div>
			</label>
		</div>
	</div>
</body>

</html>