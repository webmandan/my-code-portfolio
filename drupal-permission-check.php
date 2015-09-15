<?php
/** 
 *	Drupal 7 / PHP code to check user permissions before viewing something.
 *	Return a 404 error if permission not given.
 *	$user->roles is assumed to already be declared and available to check.
 */

$role_array = array('administrator', 'author');
if (!(array_intersect($user->roles, $role_array))) {
	drupal_not_found();
	drupal_exit();
}

?>