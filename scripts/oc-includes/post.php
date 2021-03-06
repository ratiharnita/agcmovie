<?php
/**
 * Post functions and post utility function.
 *
 * @package OcimPress
 * @subpackage Post
 * @since 1.0.0
 */

$postq = get_mysqli("oc_posts where active = 1 and guid = '$po'");
$postno = get_mysqli("oc_posts where active = 0 and guid = '$po'");

if ($postq):
$post = mysqli_fetch_array($postq);
elseif ($postno):
$post = mysqli_fetch_array($postno);
else:
$post = mysqli_fetch_array($postq);
endif;