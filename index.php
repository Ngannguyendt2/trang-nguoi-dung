<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="post">
    <label>User:</label>
    <input type="text" name="user" required><br>
    <label>Email:</label>
    <input type="email" name="email" required><br>
    <label>Telephone: </label>
    <input type="text" name="phone" required><br>
    <input type="submit" value="Sign in">
</form>
<?php

function getEmail()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        try {
            if (empty($email)) {
                throw new Exception("Error");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $email;

    }
}

function isEmail()
{
    $email = getEmail();
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return $email;
    }
    //return false;
}

function getUser()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = $_POST['user'];
        try {
            if (empty($user)) {
                throw new Exception("Error");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $user;

    }
}

function getPhone()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $phone = $_POST['phone'];
        try {
            if (empty($phone)) {
                throw new Exception("Error");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $phone;

    }
}

function createArray()
{
    $arr = [];
    array_push($arr, getUser());
    array_push($arr, isEmail());
    array_push($arr, getPhone());
    return $arr;
}

function readfileJson()
{
    $data = file_get_contents("users.json");
    return json_decode($data, true);

}

function writefileJson()
{

    $arr = readfileJson();
    $data = createArray();
    array_push($arr, $data);
    $json1data = json_encode($arr);
    file_put_contents("users.json", $json1data);

}

writefileJson();

?>
</body>
</html>
