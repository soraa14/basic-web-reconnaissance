<?php
exec("pgrep bash", $output, $return);
if ($return == 0) {
    echo "Ok, process is running\n";
}
?>