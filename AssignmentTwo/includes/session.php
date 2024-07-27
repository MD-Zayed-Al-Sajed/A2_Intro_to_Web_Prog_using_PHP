<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['student_id']);
}
?>
