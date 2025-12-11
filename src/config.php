<?php
	$host = 'localhost';
	$name = '';
	$user = '';
	$pass = '';

	try {
		$pdo = new PDO("mysql:host=$host;dbname=$name;charset=utf8", $user, $pass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		die("DATABASE ERROR: <b>" . $e->getMessage() . "</b>");
	}

	function gud($id, $sp) {
		global $pdo;

		$allowed_columns = [
			'id',
			'un',
			'dn',
			'em',
			'pw'
		];
		
		if (!in_array($sp, $allowed_columns)) {
			throw new Exception('Invalid column name');
		}

		try {
			$sql = "SELECT $sp FROM users WHERE id = :id";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(['id' => $id]);

			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			return $result ? $result[$sp] : null;

		} catch (PDOException $e) {
			die("DATABASE ERROR: <b>" . $e->getMessage() . "</b>");
			return null;
		}
	}

	session_start();
	
	$uid = $_SESSION['id'];
	

session_start();
?>
