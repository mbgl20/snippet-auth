<?php
	require_once '../src/config.php';

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$username = $_POST['un'] ?? '';
		$password = $_POST['pw'] ?? '';

		$stmt = $pdo->prepare("SELECT id, dn, pw FROM users WHERE un = ?");
		$stmt->execute([$username]);
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($user && password_verify($password, $user['pw'])) {
			$_SESSION['id'] = $user['id'];
			header('Location: /');
			exit;
		} else {
			$error = "Unknown username or password!";
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
		<div class="container">
			<h2>Login</h2>
			<?php if (!empty($error)): ?>
				<p class="error"><?= htmlspecialchars($error) ?></p>
			<?php endif; ?>
			<form method="POST">
				<label>Username:<br>
					<input type="text" name="un" required>
				</label><br><br>
				<label>Password:<br>
					<input type="password" name="pw" required>
				</label><br><br>
				<button type="submit">Login</button>
			</form>
			<p>Not registered yet? <a href="/register/index.php">Register</a></p>
		</div>
	</body>
</html>
