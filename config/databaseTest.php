<?php

require_once __DIR__ . "/database.php";

$db = \Config\Database::getConnection();
echo "Sukses membuat koneksi dengan DB" . PHP_EOL;
