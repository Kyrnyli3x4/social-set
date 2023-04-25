<?php
session_start();
$title="Форма регистрации";
require __DIR__ . '/header.php';

$conn = mysqli_connect("localhost", "root", "root", "sacam");

if (!$conn) {
    die("Ошибка: " . mysqli_connect_error());
}

else {
    if (isset($_POST['do_signup'])) {

        $errors = array();

        if (trim($_POST['login']) == '') {

            $errors[] = "Введите логин!";
        }

        if (trim($_POST['email']) == '') {

            $errors[] = "Введите Email";
        }


        if (trim($_POST['name']) == '') {

            $errors[] = "Введите Имя";
        }

        if (trim($_POST['family']) == '') {

            $errors[] = "Введите фамилию";
        }

        if ($_POST['password'] == '') {

            $errors[] = "Введите пароль";
        }

        if ($_POST['password_2'] != $_POST['password']) {

            $errors[] = "Повторный пароль введен не верно!";
        }
        if (mb_strlen($_POST['login']) < 5 || mb_strlen($_POST['login']) > 90) {

            $errors[] = "Недопустимая длина логина";

        }

        if (mb_strlen($_POST['name']) < 3 || mb_strlen($_POST['name']) > 50) {

            $errors[] = "Недопустимая длина имени";

        }

        if (mb_strlen($_POST['family']) < 5 || mb_strlen($_POST['family']) > 50) {

            $errors[] = "Недопустимая длина фамилии";

        }

        if (mb_strlen($_POST['password']) < 2 || mb_strlen($_POST['password']) > 16) {

            $errors[] = "Недопустимая длина пароля (от 2 до 8 символов)";

        }

        if (!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $_POST['email'])) {

            $errors[] = 'Неверно введен е-mail';

        }


        if (empty($errors)) {

            require ('User_detect/Code.php');
            $code = new User_detect\Code();
            $code -> send_email($_POST['email']);

            $password = hash("sha256", $_POST['password']);

            $sql = "INSERT INTO Autorization (Login, Password,email) VALUES (
                                                                    '{$_POST['login']}',
                                                                    '{$password}',
                                                                    '{$_POST['email']}'
                                                                    )";


           require ('DateBase/DB.php');
           $edit = new \DateBase\DB();
           $datetime = date("d.my");

           $edit -> request("INSERT INTO User_info (name, famili, last_name, date_register) VALUES (
                                                                                               '{$_POST['name']}',
                                                                                               '{$_POST['family']}',
                                                                                               '{$_POST['last_name']}',
                                                                                               '{$datetime}'
                                                                                                    )");

        }
        else {
            echo '<div style="color: red; ">' . array_shift($errors) . '</div><hr>';
        }
    }
}
?>

<div class="container mt-4">
    <div class="row">
        <div class="col">
            <h2>Регистрация</h2>
            <form action="singup.php" method="post">
                <input type="text" class="form-control" name="login" id="login" placeholder="Введите логин"><br>
                <input type="email" class="form-control" name="email" id="email" placeholder="Введите Email"><br>
                <input type="text" class="form-control" name="name" id="name" placeholder="Введите имя" required><br>
                <input type="text" class="form-control" name="family" id="family" placeholder="Введите фамилию" required><br>
                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Введите Отчество(если имеется)"><br>
                <input type="date" class="form-control" value="2017-06-02" name="register" id="register" placeholder="Введите дату рождения" required><br>
                <input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль"><br>
                <input type="password" class="form-control" name="password_2" id="password_2" placeholder="Повторите пароль"><br>
                <button class="btn btn-success" name="do_signup" type="submit">Зарегистрировать</button>
            </form>
            <br>
            <p>Если вы зарегистрированы, тогда нажмите <a href="login.php">здесь</a>.</p>
            <p>Вернуться на <a href="index.php">главную</a>.</p>
            <?php
                if($_SESSION['log']!=""){
            ?>
                <p><a href="logout.php"> Выйти из аккаута</a>.</p>
            <?php
                    unset($_SESSION['cart']);
                }
            ?>
        </div>
    </div>
</div>
<?php require __DIR__ . '/footer.php'; ?>

