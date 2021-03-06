<?php
$live = false;
$contact_email = 'aviq.baihaqy@gmail.com';
define('BASE_URI', '/');
define('BASE_URL', 'ecommerce.local/');
define('MYSQL', './includes/mysql.inc.php');
session_start();

function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars)
{
    global $live, $contact_email;
    $message = "An error occurred in script '$e_file' on line $e_line:\n$e_message\n";
    $message .= "<pre>" .print_r(debug_backtrace(), 1) . "</pre>\n";

    if (!$live) {
        echo '<div class="error">' . nl2br($message) . '</div>';
    } else {
        error_log($message, 1, $contact_email, 'From:admin@example.com');
        if ($e_number != E_NOTICE) {
            echo '<div class="error">A system error occurred. We apologize for the inconvenience.</div>';
        }
    } // End of $live IF-ELSE.
    return true;
} // End of my_error_handler( ) definition.
   
set_error_handler('my_error_handler');
