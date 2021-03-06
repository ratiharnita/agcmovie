<?php 
/**
 * Theme editor administration panel.
 *
 * @package Ocim
 * @subpackage Administration
 */
include('header.php');
if(!is_admin()){
  header("location:index.php");
}?>
<?php if (! isset($_GET['dir']))
    {
        include('./includes/plugin-editor.php');

    } else {    
        $x = $_GET['dir'];  
        switch($x)
        {
            case ($x):
                include('./includes/plugin.php');
                break;  
            default:
                include('./includes/plugin-editor.php');
            break;
        }
    }
?>
<?php include('footer.php');?>