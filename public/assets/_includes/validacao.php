<?php
session_start();
if (!isset($_SESSION["logado"])) {
    session_unset();
    session_destroy();
    header("Location:");
}