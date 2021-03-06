<?php 
/**
 * The template for displaying 404 pages
 *
 * @package OcimPress 
 * @subpackage Kocim
 * @since Kocim 1.1
 */
include('header.php');
?>
<div class="col-md-8">

		<p>It looks like nothing was found at this location. Maybe try a search?</p>
			<form method="GET" action="/index.php" accept-charset="UTF-8" id="search">
				<span class="add-on">
					<span class="glyphicon glyphicon-search"></span>
				</span>
                        	<input type="hidden" name="do" value="search">
				<input id="inputIcon" placeholder="Search...." name="id" type="text">
			</form>

</div>

<?php include('sidebar.php');?>

<?php include('footer.php');?>