<?php 
/**
 * The template for displaying Author pages
 *
 * @package OcimPress 
 * @subpackage Kocim
 * @since Kocim 1.1
 */
include('header.php');
?>
<div class="col-md-8">
        <ol class="breadcrumb">
                <li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                        <a itemprop="url" href="<?php bloginfo('url');?>"><span itemprop="title">Home</span></a>
                </li>
                <li class="active">Author Archives: <span class="vcard"><a class="url fn n" href="<?php bloginfo('url');?>/author/<?php echo userinfo($id,'username');?>" title="<?php echo userinfo($id,'nickname');?>" rel="me"><?php echo userinfo($id,'nickname');?></a></span></li>
        </ol>

	<?php if( !$oc_users_result || mysqli_num_rows($oc_users_result) == 0 ) :?>
		<p>Sorry, No posts found.</p>
        <?php 
        else : 
        while ($row = mysqli_fetch_assoc($oc_users_result)) :
        ?>
		<h2><a href="<?php bloginfo('url');?>/<?php echo $row['guid'];?>"><?php echo $row['title'];?></a></h2>
			<p><?php echo short($row['description'],250,'...');?></p>
                     	<a class="btn btn-primary" href="<?php bloginfo('url');?>/<?php echo $row['guid'];?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                     	<hr>

	<?php endwhile; 
	?>

	<ul class="pagination"><?php echo $oc_users->navigation("", "active", false, false, false, true,"<li>","</li>") ;?></ul>

        <?php endif; ?>
</div>

<?php include('sidebar.php');?>

<?php include('footer.php');?>