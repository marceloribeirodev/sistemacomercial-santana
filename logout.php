<?php
session_start();

// Pega todas as seções e destroí
session_destroy();
header('Location: index.php');
exit();