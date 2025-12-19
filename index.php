<?php
	require_once 'src/config.php';

	if (!isset($_SESSION['id'])) {
		header('Location: /login/');
		exit;
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
			<h1>Welcome, <?= gud($uid, 'dn') ?>!</h1>
			
			<p>Here will be LOGGED-IN exclusive content!</p>
			
			<h3>Your Information</h3>
			<p>
				ID: <b><?= $uid ?></b>
				<br><br>
				Username: <b>@<?= gud($uid, 'un') ?></b>
				<br><br>
				Displayname: <b><?= gud($uid, 'dn') ?></b>
				<br><br>
				Password: <b><?= gud($uid, 'pw') ?></b> - Try to unshash it! :)
			</p>
			
			<a href="/settings/>Settings</a> - <a href="/src/logout.php">Logout</a>
		</div>
	</body>
</html>
