<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// custom message log for cli
function custom_log_message($message, $type="debug")
{
    // for quick testing
    //echo "{$message} <br>".PHP_EOL;
    //return;
    // 2DO: remove later

    if (is_cli()) {
        echo "{$message}".PHP_EOL;
        log_message($type, $message);
    } else {
        log_message($type, $message);
    }
}
