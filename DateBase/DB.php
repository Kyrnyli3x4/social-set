<?php

namespace DateBase;

class DB
{
    function request($sql)
    {
        $conn = mysqli_connect("localhost", "root", "root", "sacam");
        if (!$conn) {
            die("Ошибка: " . mysqli_connect_error());
        }
        else {

            $request = $sql;

            if ($conn->query($request)) {
                echo "Ошибок нет";
            } else {
                echo "Ошибка {$conn->error}";
            }
        }

    }

}