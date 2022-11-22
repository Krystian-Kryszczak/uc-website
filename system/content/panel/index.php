<?php
session_start();
if (!isset($_SESSION['logged'])){
	header('Location: login');
	exit();
}else{
	header('Location: dashboard');
	exit();
}