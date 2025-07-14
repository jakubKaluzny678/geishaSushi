<?php 
session_start();
$host = 'localhost';
$db   = 'sushiMessages';
$userDb = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $userDb, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Błąd połączenia z bazą danych: " . $e->getMessage());
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['loginInput'];
    $password = $_POST['passInput'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE login = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && $password === $user['pass']) {
        $_SESSION['username'] = $user['login'];
        header("Location: displayMessages.php");
        exit;
    } else {
        $error = "Nieprawidłowy login lub hasło.";
        echo $error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <style>
        body {
            background-color: #000;
            color: #fff;
        }
        form {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-top: 15rem;
            padding: 2rem;
            gap: 0.5rem;
        }
    </style>
</head>
<body>
    <form action="login.php" method="POST">
        <label for="loginInput">Login: </label>
        <input type="text" name="loginInput">
        <label for="passInput">Hasło: </label>
        <input type="password" name="passInput">
        <input type="submit" value="Zaloguj">
    </form>
</body>
</html>