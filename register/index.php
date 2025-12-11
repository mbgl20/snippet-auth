<?php
	require_once '../src/config.php';

	$error = '';

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$username = trim($_POST['un'] ?? '');
		$displayname = trim($_POST['dn'] ?? '');
		$password = $_POST['pw'] ?? '';
		$password_confirm = $_POST['pw_confirm'] ?? '';

		if (empty($username) || empty($displayname) || empty($password) || empty($password_confirm)) {
			$error = 'All fields are required';
		} elseif ($password !== $password_confirm) {
			$error = 'Passwords do not match!';
		} elseif (strlen($password) <= 6) {
			$error = 'Password has to have <= 6 Chars!';
		} else {
			try {
				$stmt = $pdo->prepare("SELECT id FROM users WHERE un = ?");
				$stmt->execute([$username]);
				if ($stmt->fetch()) {
					$error = 'Username already in use!';
				} else {
					$hashed_pw = password_hash($password, PASSWORD_DEFAULT);
					$stmt = $pdo->prepare("INSERT INTO users (un, dn, pw) VALUES (?, ?, ?)");
					$stmt->execute([$username, $displayname, $hashed_pw]);
					header('Location: /login/');
					exit;
				}
			} catch (Exception $e) {
				$error = 'Error! Try again later!';
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="UTF-8">
		<title>snippet-auth</title>
		<link rel="stylesheet" href="/src/cl/style.css">
	</head>
	<body>

	<h2>Registrieren</h2>

	<?php if ($error): ?>
	<p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
	<?php endif; ?>

	<form method="POST">
		<div>
			<label for="un">Username:</label><br>
			<input type="text" id="un" name="un" required>
		</div>
		<br>

		<div>
			<label for="dn">Displayname:</label><br>
			<input type="text" id="dn" name="dn" required>
		</div>
		<br>

		<div>
			<label for="pw">Password:</label><br>
			<input type="password" id="pw" name="pw" required>
		</div>
		<br>

		<div>
			<label for="pw_confirm">Password Confirmation:</label><br>
			<input type="password" id="pw_confirm" name="pw_confirm" required>
		</div>
		<br>

		<div>
			<button type="submit">Register</button>
		</div>
	</form>

	<p>
		Already registered? <a href="/login/index.php">Login</a>
	</p>

	</body>
</html>
