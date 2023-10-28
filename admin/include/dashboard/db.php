<?php
$db = mysqli_connect('localhost', 'root', '', 'project-1023');
if (!$db) {
    die("There is something wrong" . mysqli_error($db));
}
?>