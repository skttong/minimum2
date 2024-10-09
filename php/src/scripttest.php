<?php
// script.php
file_put_contents('/var/www/html/log.txt', "Script run at: " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
?>