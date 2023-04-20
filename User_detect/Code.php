<?php

namespace User_detect;

class Code
{
    function send_email($email)
    {

        $code = rand(1111, 9999);

        mail("{$email}", "Код проверки", "Ваш код проверки {$code} никому не говорите его");

        return $code;
    }

}