<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome to the Assignly</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333;">
    <h2>Greetings {{ $user->name }}!</h2>

    <p>Welcome to the Assignly! An account has been created for you with the following credentials:</p>

    <ul>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Password:</strong> {{ $password }}</li>
    </ul>

    <p>You can log in at:</p>
    <p>
        <a href="{{ url('/login') }}" style="color: #1d4ed8;">{{ url('/login') }}</a>
    </p>

    <p><strong>Important:</strong> Please log in and change your password as soon as possible.</p>

    <p>Best regards,<br>Assignly Team</p>
</body>
</html>
