<?php
$file = $_POST['file'];
if(substr ($file, 0,7)=='uploads') {
    unlink($file);
}

?>
