<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, {{ $user['name'] }}</h1>
    <p>Email: {{ $user['email'] }}</p>
    <a href="/logout">Logout</a>
</body>
</html>