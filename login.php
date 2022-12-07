<?php
require '_header.php';
$url = '/condition.php';
$headingForm = "Login";
$btn = "Login";
if (isset($_SESSION['name'])) {
    echo "<div class='w-25 rounded  m-3 text-white fw-bold shadow p-3 bg-success'> Mr " . $_SESSION['name'] . " your are successfully signup please log in</div>";
    unset($_SESSION['name']);
}
require '_form.php';
require '_footer.php';
?>