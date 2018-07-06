<html>
<!-- above the doctype this is inserted?? is this correct? -->
<?php

		// define variables and set to empty values
		$toErr = $subjectErr = $messageErr = $headersErr = $nameErr = $commentErr = $emailErr = "";
		$to = $subject = $message = $headers = $email = $success = "";
		$name = $email = $comment = "";  // these are the vars that should be validated

		if (isset($_POST['send'])) {

			// let's try validating before anything else is done
			if (empty($_POST["name"])) {
				$nameErr = "Name is required";
			} else {
			    $name = test_input($_POST["name"]);
				// check if name only contains letters and whitespace
				if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
					$nameErr = "Only letters and white space allowed";
				}
			}

			if (empty($_POST["email"])) {
				$emailErr = "Email is required";
			} else {
				$email = test_input($_POST["email"]);
				// check if e-mail address is well-formed
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$emailErr = "Invalid email format";
				}
			}

			if (empty($_POST["comment"])) {
				$comment = "";
			} else {
				$comment = test_input($_POST["comment"]);
			}
		}

		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
			// need to insert the appropriate email for Nadeen's
			$to = 'nadeenEmail@nadeenEmail.com';
			$subject = 'Feedback from my site';
			//$message = 'Name: ' . $_POST['name'] . "\r\n\r\n";
			$message = 'Name: ' . "$name" . "\r\n\r\n";
			// body of email must be a single string so concat like this
			// $message .= 'Email: ' . $_POST['email'] . "\r\n\r\n";
			$message .= 'Email: ' . "$email" . "\r\n\r\n";
			// $message .= 'Comments: ' . $_POST['comments'];
		    $message .= 'Comments: ' . "$comment" . "\r\n\r\n";
			$headers = "From: webmaster@nickblackcode.com\r\n";
			$headers .= 'Content-Type: text/plain; charset=utf-8';
			// $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
			if ($email) { // superflous code I believe, but leave for now
				$headers .= "\r\nReply-To: $email";
			}

			$success = mail($to, $subject, $message, $headers);
	?>
<head></head>
<body>


	<?php if (isset($success) && $success) { ?>
	<h1>Thank You</h1>
	<p>
		Your message has been sent.
		<?php echo "\r\n $name" . "\r\n " . "$email" . " \r\n" . "$comment"; ?>
	</p>
	<?php } else { ?>
	<h1>Oops!</h1>
	<p>Sorry, there was a problem sending your message.</p>
	<?php } ?>
</body>
</html>
