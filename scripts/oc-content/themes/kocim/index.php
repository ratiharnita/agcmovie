<?php 
/**
 * The main template file index
 *
 * This is the most generic template file in a OcimPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @package OcimPress
 * @subpackage Kocim
 * @since Kocim 1.1
 */
if (file_exists( THEMES .$do. '.php' )) :
	include( THEMES .$do. '.php' );
else :
include('header.php');
?>
<div class="col-md-8">
	<?php if( !$oc_home_result || mysqli_num_rows($oc_home_result) == 0 ) :?>
		<p>Sorry, No posts found.</p>
        <?php 
        else : 
        while ($row = mysqli_fetch_assoc($oc_home_result)) :
        ?>
		<h2><a href="<?php bloginfo('url');?>/<?php echo $row['guid'];?>"><?php echo $row['title'];?></a></h2>
			<p><?php echo short($row['description'],250,'...');?></p>
                     	<a class="btn btn-primary" href="<?php bloginfo('url');?>/<?php echo $row['guid'];?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                     	<hr>

	<?php endwhile; 
	?>

	<ul class="pagination"><?php echo $oc_home->navigation("", "active", false, false, false, true,"<li>","</li>") ;?></ul>

        <?php endif; ?>
</div>

<?php include('sidebar.php');?>

<?php include('footer.php');?>

<?php endif;?>