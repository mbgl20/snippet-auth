<?php
	require_once 'src/config.php';

	if (!isset($_SESSION['id'])) {
		header('Location: /login/');
		exit;
	}

	$error = '';
	$success = '';

	// Aktuelle Userdaten laden
	$stmt = $pdo->prepare("SELECT un, dn FROM users WHERE id = ?");
	$stmt->execute([$_SESSION['id']]);
	$user = $stmt->fetch();

	if (!$user) {
		die('User not found');
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$username = trim($_POST['un'] ?? '');
		$displayname = trim($_POST['dn'] ?? '');
		$new_pw = $_POST['pw'] ?? '';
		$new_pw_confirm = $_POST['pw_confirm'] ?? '';

		if (empty($displayname)) {
			$error = 'Displayname can NOT be empty!';
		} elseif (!empty($new_pw)) {
			if ($new_pw !== $new_pw_confirm) {
				$error = 'Passwords doesnt match!';
			} elseif (strlen($new_pw) <= 6) {
				$error = 'Password needs to be >= 6 chars!';
			}
		}

		if (!$error) {
			try {
				if (!empty($new_pw)) {
					$hashed_pw = password_hash($new_pw, PASSWORD_DEFAULT);
					$stmt = $pdo->prepare("UPDATE users SET un = ?, dn = ?, pw = ? WHERE id = ?");
					$stmt->execute([$username, $displayname, $hashed_pw, $_SESSION['id']]);
				} else {
					$stmt = $pdo->prepare("UPDATE users SET un = ?, dn = ? WHERE id = ?");
					$stmt->execute([$username, $displayname, $_SESSION['id']]);
				}

				$success = 'Saved successfully!';
				$user['dn'] = $displayname;
			} catch (Exception $e) {
				$error = 'Error while saving!';
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
	<h2>Settings:</h2>

	<?php if ($error): ?>
		<p style="color:red;"><?= htmlspecialchars($error) ?></p>
	<?php endif; ?>

	<?php if ($success): ?>
		<p style="color:green;"><?= htmlspecialchars($success) ?></p>
	<?php endif; ?>

	<form method="POST">
		<div>
			<label for="un">Username:</label><br>
			<input type="text" id="un" name="un" value="<?= htmlspecialchars($user['un']) ?>" required>
			<br>
			<label for="dn">Displayname:</label><br>
			<input type="text" id="dn" name="dn" value="<?= htmlspecialchars($user['dn']) ?>" required>
		</div>
		<br>

		<hr>

		<p><em>Leave blank, to not make any changes!</em></p>

		<div>
			<label for="pw">New Password:</label><br>
			<input type="password" id="pw" name="pw">
		</div>
		<br>

		<div>
			<label for="pw_confirm">Confirm New Password:</label><br>
			<input type="password" id="pw_confirm" name="pw_confirm">
		</div>
		<br>

		<button type="submit">Save</button>
	</form>

	<p>
		<a href="/">Back</a> | <a href="/logout/">Logout</a>
	</p>

</body>
</html>
