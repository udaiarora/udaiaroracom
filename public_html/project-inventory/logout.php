<?php
session_start();
session_destroy();
header("Location: signin.php?error=Logged%20Out");
?>