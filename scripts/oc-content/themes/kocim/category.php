<?php 
/**
 * The template for displaying Category pages
 *
 * @package OcimPress 
 * @subpackage Kocim
 * @since Kocim 1.1
 */
include('header.php');
?>
<div class="col-md-8">
        <ol class="breadcrumb">
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                        <a itemprop="url" href="<?php bloginfo('url');?>"><span itemprop="title">Home</span></a>
                </li>
                <li class="active">You Are Browsing "<?php echo $id;?>" Category</li>
        </ol>

	<?php if( !$oc_category_result || mysqli_num_rows($oc_category_result) == 0 ) :?>
		<p>Sorry, No posts found.</p>
        <?php 
        else : 
        while ($row = mysqli_fetch_assoc($oc_category_result)) :
        ?>
		<h2><a href="<?php bloginfo('url');?>/<?php echo $row['guid'];?>"><?php echo $row['title'];?></a></h2>
			<p><?php echo short($row['description'],250,'...');?></p>
                     	<a class="btn btn-primary" href="<?php bloginfo('url');?>/<?php echo $row['guid'];?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                     	<hr>

	<?php endwhile; 
	?>

	<ul class="pagination"><?php echo $oc_category->navigation("", "active", false, false, false, true,"<li>","</li>") ;?></ul>

        <?php endif; ?>
</div>

<?php include('sidebar.php');?>

<?php include('footer.php');?>