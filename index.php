<?php
include_once("functions.php");
?>

<!DOCTYPE HTML>
<html>

	<head>

	</head>

	<body>

		<form method="POST">
			<table>
				<tr>
					<td><input
						type="text"
						name="username"
						placeholder="Username"
						value="<?php if ( isset($_REQUEST['action']) ) { if( $_REQUEST['action'] == 'registerUser' ) { echo $_POST['username']; } } ?>">
					</td>
				</tr>

				<tr>
					<td><input
						type="email"
						name="email"
						placeholder="Email"
						value="<?php if ( isset($_REQUEST['action']) ) { if( $_REQUEST['action'] == 'registerUser' ) { echo $_POST['email']; } } ?>">
					</td>
				</tr>

				<tr>
					<td><input
						type="email"
						name="confirmEmail"
						placeholder="Confirm email"
						value="<?php if ( isset($_REQUEST['action']) ) { if( $_REQUEST['action'] == 'registerUser' ) { echo $_POST['confirmEmail']; } } ?>">
					</td>
				</tr>

				<tr>
					<td><input
						type="text"
						name="firstName"
						placeholder="First name"
						value="<?php if ( isset($_REQUEST['action']) ) { if( $_REQUEST['action'] == 'registerUser' ) { echo $_POST['firstName']; } } ?>">
					</td>
				</tr>

				<tr>
					<td><input
						type="text"
						name="lastName"
						placeholder="Last name"
						value="<?php if ( isset($_REQUEST['action']) ) { if( $_REQUEST['action'] == 'registerUser' ) { echo $_POST['lastName']; } } ?>">
					</td>
				</tr>

				<tr>
					<td><input
						type="password"
						name="password"
						placeholder="Password">
					</td>
				</tr>

				<tr>
					<td><input
						type="password"
						name="confirmPassword"
						placeholder="Confirm password">
					</td>
				</tr>

				<tr>

					<td>
						<input
						type="hidden"
						name="action"
						value="registerUser">

						<input
						type="submit"
						value="Register">
					</td>
				</tr>

			</table>
		</form>

	</body>

</html>
