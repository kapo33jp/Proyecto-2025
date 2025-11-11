<?php
session_start();
session_destroy();
header("Location: ../html/Main.php");
?>