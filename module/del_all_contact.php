<?php 
	include('sql.php');
	include('../templ/init.php');
	$contact->remove(array('pertain'=>$_SESSION["user-info"]['usernm']));
	header('Location: ../view_contact.php');
?>