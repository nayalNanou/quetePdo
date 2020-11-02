<?php
require_once 'connec.php';

$bdd = new PDO(DSN, USER, PASS);


if (isset($_POST['firstname'], $_POST['lastname'])) {
	if (empty(trim($_POST['firstname'])) || empty(trim($_POST['lastname'])) || !preg_match('#^[a-z ]+$#i', trim($_POST['firstname'])) || !preg_match('#^[a-z ]+$#i', trim($_POST['lastname']))) {
		$firstnameError = '';
		$lastnameError = '';

		// Verification ( firstname )

		if (empty(trim($_POST['firstname']))) {
			$firstnameError = 'Le prénom ne doit pas être vide';
		}

		if (trim($_POST['firstname']) != null && !preg_match('#^[a-z ]+$#i', trim($_POST['firstname']))) {
			$firstnameError .= (empty($firstnameError) ? 'Le prénom ne doit pas contenir de nombres et de charactères spéciaux' : ', ne doit pas contenir de nombres et de charactères spéciaux');
		}

		if (!empty($firstnameError)) {
			$fistnameError .= '.';
		}


		// Verification ( lastname )

		if (empty(trim($_POST['lastname']))) {
			$lastnameError = 'Le nom ne doit pas être vide';
		}

		if (trim($_POST['lastname']) != null && !preg_match('#^[a-z ]+$#i', trim($_POST['lastname']))) {
			$lastnameError .= (empty($lastnameError) ? 'Le nom ne doit pas contenir de nombres et de charactères spéciaux' : ', ne doit pas contenir de nombres et de charactères spéciaux');
		}

		if (!empty($lastnameError)) {
			$lastnameError .= '.';
		}


		header('Location: index.php?firstnameError=' . $firstnameError . '&lastnameError=' . $lastnameError . '&firstname=' . trim($_POST['firstname']) . '&lastname=' . trim($_POST['lastname']));
	} else {
		$statement = $bdd->prepare('INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)');

		$statement->bindValue(':firstname', trim($_POST['firstname']), PDO::PARAM_STR);
		$statement->bindValue(':lastname', trim($_POST['lastname']), PDO::PARAM_STR);

		$statement->execute();

		header('Location: index.php');
	}
}

?>
