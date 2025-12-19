<?php
session_destroy(); // Hapus sesi
header('Location: ../user/login'); // Tendang ke login
exit();
?>