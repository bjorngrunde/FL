<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Återställ ditt lösenord</h2>

		<div>
		<p>
			För att återställa ditt lösenord, följ länken: {{ URL::to('password/reset', array($token)) }}.<br/>
			Denna länk kommer försvinna om {{ Config::get('auth.reminder.expire', 60) }} minuter.
			</p>
		</div>
	</body>
</html>
