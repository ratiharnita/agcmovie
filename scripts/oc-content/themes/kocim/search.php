<?php 
/**
 * The template for displaying Search pages
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
                <li class="active">You Are Searching "<?php echo $id;?>"</li>
        </ol>

	<?php if( !$oc_search_result || mysqli_num_rows($oc_search_result) == 0 ) :?>
		<p>It looks like nothing was found at this location. Maybe try a search?</p>
			<form method="GET" action="/index.php" accept-charset="UTF-8" id="search">
				<span class="add-on">
					<span class="glyphicon glyphicon-search"></span>
				</span>
                        	<input type="hidden" name="do" value="search">
				<input id="inputIcon" placeholder="Search...." name="id" type="text">
			</form>
        <?php 
        else : 
        while ($row = mysqli_fetch_assoc($oc_search_result)) :
        ?>
		<h2><a href="<?php bloginfo('url');?>/<?php echo $row['guid'];?>"><?php echo $row['title'];?></a></h2>
			<p><?php echo short($row['description'],250,'...');?></p>
                     	<a class="btn btn-primary" href="<?php bloginfo('url');?>/<?php echo $row['guid'];?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                     	<hr>

	<?php endwhile; 
	?>

	<ul class="pagination"><?php echo $oc_search->navigation("", "active", false, false, false, true,"<li>","</li>") ;?></ul>

        <?php endif; ?>
</div>

<?php include('sidebar.php');?>

<?php include('footer.php');?>