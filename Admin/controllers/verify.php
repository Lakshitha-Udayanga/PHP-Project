<?php 
	$connection = mysqli_connect('localhost', 'root', '', 'e-solution');

	if (isset($_GET['code'])) {
		$verification_code = mysqli_real_escape_string($connection, $_GET['code']);

		$query = "SELECT * FROM admi WHERE token = '{$verification_code}'";

		$result = mysqli_query($connection, $query);

		if (mysqli_num_rows($result) == 1) {
			$query = "UPDATE admi SET verified = true, token = NULL WHERE token = '{$verification_code}' LIMIT 1";

			$result = mysqli_query($connection, $query);

			if (mysqli_affected_rows($connection) == 1) {
				echo 'Email address verified successfully.';
			} else {
				echo 'Invalid verification code.';
			}
		}
	}




 ?>