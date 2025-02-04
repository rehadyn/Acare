<?php
session_start();
$_SESSION['test'] = "Session bekerja!";
echo $_SESSION['test'];
