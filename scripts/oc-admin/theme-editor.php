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
        include('./includes/themes-css.php');

    } else {    
        $x = $_GET['dir'];  
        switch($x)
        {
            case ($x):
                include('./includes/theme.php');
                break;  
            default:
                include('./includes/themes-css.php');
            break;
        }
    }
?>
<?php include('footer.php');?>