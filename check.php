<?php

//TODO доделать проверку на правильность ключа


if(isset($_POST['click']))
{
    if($_POST['code'] == '1234')
    {
        header('Location: home.php');
    }
}



?>
<div class="container mt-4">
    <div class="row">
        <div class="col">
            <h2>Авторизация</h2>
            <form action="check.php" method="post">
                <input type="text" class="form-control" name="code" id="code" placeholder="Введите код" required><br>
                <button class="btn btn-success" name="click" type="submit">Проверить</button>
            </form>
            <br>
            <p>Если пароль не пришел нажмите <a href="singup.php">здесь</a>.</p>
        </div>
    </div>
</div>

