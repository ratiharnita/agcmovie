<?php 
/**
 * The main template file
 *
 * This is the most generic template file in a OcimPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @package OcimPress 
 * @subpackage ARSA
 * @since ARSA 1.0
 */
if (file_exists( THEMES .$do. '.php' )) :
	include( THEMES .$do. '.php' );
else :
?>
<?php include('header.php'); ?>
	<div class="col-sm-9">

		<div id="snippet-content">  
			<?php if( !$oc_home_result || mysqli_num_rows($oc_home_result) == 0 ) :?>
                                <div class="snippet-entry">
                                	<h3 itemprop="name">Nothing Found</h3>
	
                                	<p>Ready to publish your first post? <a href="/oc-admin/post-new.php">Get started here</a>.</p>
                                </div>
                        <?php 
                        else : 
                        while ($row = mysqli_fetch_assoc($oc_home_result)) :
                        ?>
				<div class="snippet-entry">

                			<div class="pull-left feed-avatar">
                				<img src="<?php preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $row['description'], $images); if($images[1]) {echo $images[1];} elseif($row['images'] != null) {echo $row['images'];} else {echo 'http://placehold.it/100x100';}?>" width="60" height="60" alt="<?php echo $row['title'];?>">
					</div><!--feed-avatar-->

                			<div class="pull-left snippet-titles">

                				<div class="name"><a href="/author/<?php echo $row['user'];?>"><?php echo $row['user'];?></a> has posted in <span class="language"><i class="fi-price-tag"></i><a href="/category/<?php echo Categories($row['terms'],'slug');?>"><?php echo Categories($row['terms'],'name');?></a></span>
                				</div><!--name-->

                				<h3 itemprop="name"><a href="/<?php echo $row['guid'];?>"><?php echo $row['title'];?></a></h3>  

                				<p class="snippet-footer-details">Posted <?php echo time_ago($row['pubdate']);?></p>

            				</div><!--pull-left-->

                				<div class="clearfix"></div>

            			</div><!--snippet-entry-->
                        <?php 
                        endwhile; 
                        endif;
                        ?>
        	</div><!--snippet-content-->
        		<div class="clearfix"></div>
                <?php if( !$oc_home_result || mysqli_num_rows($oc_home_result) == 0 ) :?>
        	<div class="pagination">
			<?php echo '<ul class="pagination">'.$oc_home->navigation("", "active", false, false, false, true,"<li>","</li>").'</ul>';?>
		</div>
                <?php endif;?>
	</div><!--col-sm-9"-->

	<div class="col-sm-3">
		<?php include('sidebar.php');?>
	</div><!--end sidebar-->

<?php include('footer.php');?>

<?php
endif;
?>