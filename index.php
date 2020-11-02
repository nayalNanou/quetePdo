<?php
	include('connec.php');

	$bdd = new PDO(DSN, USER, PASS);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Ma page</title>
		<style>
			table {
				border-collapse: collapse;
			}

			th, td {
				border: 1px solid black;
				padding: 4px;
			}

			form {
				margin-top: 20px;
			}

			label {
				width: 150px;
				text-align: right;
				display: inline-block;
				margin-bottom: 10px;
			}

			input[type="submit"] {
				margin-left: 154px;
			}

			.inputError {
				padding: 4px 10px;
				border: 0.5px solid black;
				background: #DFDFDF;
				color: #2F2F2F;
				border-radius: 4px;
				margin: 6px;
				display: inline-block;
			}
		</style>
	</head>

	<body>
		<table>
			<tr>
				<th>id</th>
				<th>firstname</th>
				<th>lastname</th>
			</tr>

			<?php
				$statement = $bdd->query('SELECT * FROM friend');

				$friends = $statement->fetchAll(PDO::FETCH_ASSOC);

				foreach ($friends as $friend) {
				?>
					<tr>
						<td><?php echo $friend['id']; ?></td>
						<td><?php echo $friend['firstname']; ?></td>
						<td><?php echo $friend['lastname']; ?></td>
					</tr>
				<?php
				}
			?>
		</table>

		<form method="post" action="add.php">
			<label for="firstname">Firstname :</label> <input type="text" name="firstname" id="firstname" value="<?php if (isset($_GET['firstname'])) { echo $_GET['firstname']; } ?>" />
			<?php
				if (isset($_GET['firstnameError']) && $_GET['firstnameError'] != null) {
					echo '<span class="inputError">' . $_GET['firstnameError'] . '</span>';
				}
			?>
			<br />

			<label for="lastname">Lastname :</label> <input type="text" name="lastname" id="lastname" value="<?php if (isset($_GET['lastname'])) { echo $_GET['lastname']; } ?>" />
			<?php
				if (isset($_GET['lastnameError']) && $_GET['lastnameError'] != null) {
					echo '<span class="inputError">' . $_GET['lastnameError'] . '</span>';
				}
			?>
			<br />

			<input type="submit" value="Enregistrer" />
		</form>
	</body>
</html>
