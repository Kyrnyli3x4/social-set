<?php
session_start();
require __DIR__ . '/boot.php';


if(isset($_POST['msg']))
{
   $_SESSION['edit'] = 123;


}



echo <<< EOT


<form>
    <div class="row" >
        <div class="col">
            <h2>Регистрация</h2>
            <form action="send.php" method="post">
            
                <input type="text" class="form-control" name="login" id="login" value="{$_SESSION['edit']}"><br>
                <input type="text" class="form-control" name="los" id="los" placeholder="text message"><br>

                <button class="btn btn-success" name="msg" type="submit">Send</button>
            </form>
            <br>
        </div>
    </div>

</form>
EOT;


require __DIR__ . '/footer.php';


?>



