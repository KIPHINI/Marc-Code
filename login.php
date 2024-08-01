<?php





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="logstyle.css">
</head>
<body>
    <h1 id="login_head">Login</h1>
    <form action="confirm.php" method="post">
        <input type="text" name="username" class="input" placeholder="Username" required><br>
        <input type="password" name="password" class="input" placeholder="Password" required><br><br>
        <input type="submit" name="submit" value="Login" id="login">
    </form>
</body>
</html>