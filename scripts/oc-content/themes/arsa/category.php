<?php 
/**
 * The template for displaying Category pages
 *
 * @package OcimPress 
 * @subpackage Arsa
 * @since Arsa 1.0
 */
include('header.php');
?>

	<div class="col-sm-9">
		<div id="snippet-content"> 

			<?php if( !$oc_category_result || mysqli_num_rows($oc_category_result) == 0 ) {?>

						<div class="snippet-entry">
                					<h3 itemprop="name">Not Found</h3>

							<p>It looks like nothing was found at this location. Maybe try a search?</p>
<form method="GET" action="/index.php" accept-charset="UTF-8" id="search">
			<span class="add-on">
				<span class="glyphicon glyphicon-search"></span>
			</span>
                        <input type="hidden" name="do" value="search">
			<input id="inputIcon" placeholder="Search...." name="id" type="text">
		</form>
						</div>
                        <?php 
				} else {
                        ?>

			<div class="breadcrumb">
				<a href="<?php get_home_url();?>">Home</a> » Category Archives: <?php echo ucwords($id) ;?>
			</div>

                        <?php
                          while ($row = mysqli_fetch_assoc($oc_category_result)) 
                        {
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
                        } 
                        }
                        ?>
        	</div><!--snippet-content-->

        		<div class="clearfix"></div>
                <?php if( mysqli_num_rows($oc_category_result) > 0 ) :?>
        	<div class="pagination">
			<?php echo '<ul class="pagination">'.$oc_category->navigation("", "active", false, false, false, true,"<li>","</li>").'</ul>';?>
		</div>
                <?php endif;?>
	</div><!--col-sm-9"-->

	<div class="col-sm-3">
		<?php include('sidebar.php');?>
	</div><!--end sidebar-->

<?php include('footer.php');?>