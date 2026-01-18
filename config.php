<?php
// ---------- Safe session start ----------
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ---------- Database connection ----------
$conn = new mysqli("localhost", "root", "", "blog");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}