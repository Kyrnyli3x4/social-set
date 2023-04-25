<?php

session_start();

$title="Вход";
require __DIR__ . '/header.php';
$conn = mysqli_connect("localhost", "root", "root", "sacam");

if (!$conn) {
    die("Ошибка: " . mysqli_connect_error());
}
$data = $_POST;

if(isset($data['do_login'])) {

    $errors = array();
    $password = hash("sha256", $_POST['password']);
    $sql ="SELECT * FROM Password_user";

    $bool = false;

    if($result = $conn->query($sql)){
        foreach($result as $row){
            if($password == $row["Password"] && $_POST['login'] == $row["Login"]) {
                $_SESSION['log'] = $row["Login"];
                $bool = true;
                unset($_SESSION['cart']);
                header("Location: index.php");
                break;
            }
        }
    }
    if($bool == false)
    {
        $errors[] = "Неправильный логин или пароль";
    }

    if(!empty($errors)) {

        echo '<div style="color: red; ">' . array_shift($errors). '</div><hr>';

    }

}
?>

<div class="container mt-4">
    <div class="row">
        <div class="col">
        <h2>Авторизация</h2>
            <form action="login.php" method="post">
                <input type="text" class="form-control" name="login" id="login" placeholder="Введите логин" required><br>
                <input type="password" class="form-control" name="password" id="pass" placeholder="Введите пароль" required><br>
                <button class="btn btn-success" name="do_login" type="submit">Авторизоваться</button>
            </form>
            <br>
            <p>Если вы еще не зарегистрированы, тогда нажмите <a href="singup.php">здесь</a>.</p>
            <p>Вернуться на <a href="index.php">главную</a>.</p>
        </div>
    </div>
</div>

<?php require __DIR__ . '/footer.php'; ?>