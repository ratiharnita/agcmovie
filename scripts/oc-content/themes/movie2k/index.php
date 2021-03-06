<?php 
/**
 * The main template file
 *
 * This is the most generic template file in a OcimPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @package OcimPress 
 * @subpackage Movie2k Clone
 * @since Movie2k 1.2
 */
if (file_exists( THEMES .$do. '.php' )) {
	include( THEMES .$do. '.php' );
} else {
?>
<?php include('header.php'); ?>
<div id="tdmoviesheader">
     <span style="padding-left: 2px; font-weight: bold;">Latest Updates</span>
     <span style="padding-left:170px; font-weight: bold;">Cinema movies</span> 
     <?php if ( is_login() ){?>
          <div class="inner dvg-bc">
               <span style="position:absolute;top:231px;left:925px;"><span>
               <a href="/page/logout" class="dvg-bc">Logout</a>
          </div>
     <?php }else{ ?>
     <div style="position:absolute;top:230px;left:710px;" id="dvg-loginform">
          <fieldset class="quick-login">
               <p id="form-quicklogin"></p>
               <form method="post" action="/page/login">
                    <label for="username"><img style="padding-bottom:3px;" src="/oc-content/themes/movie2k/images/profile.gif" alt="Username"></label>
                    <input type="text" name="username" size="10" id="username" class="inputbox" title="Username" value="Username" onclick="if(this.value=='Username')this.value='';" onblur="if(this.value=='')this.value='Username';">  
                    <label for="password"><img style="padding-bottom:3px;" src="/oc-content/themes/movie2k/images/lock.gif" alt="Password"></label>
                    <input type="password" name="password" size="10" id="password" class="inputbox" title="Password">
                    <input type="submit" name="submit" value="Login" class="button2">
               </form>
               <p></p>
          </fieldset>
     </div>
     <?php }?>
</div>

<div id="menu">
     <?php include('index/middle.php');?>
</div><!--end menu-->

<div id="maincontent" >

     <?php $m2k_home = get_mysqli("oc_posts WHERE active= 1 and type= 1 and sticky = 1 order by pubdate desc limit 20");

     if( !$m2k_home || mysqli_num_rows($m2k_home) == 0 ) :?>
          <div class="snippet-entry">	
               <p>Go to Menu Admin -> <a href="/page/list-movie">List Movie</a> -> Sticky.</p>
          </div>
     <?php 
     else : 
     while ( $index = mysqli_fetch_assoc( $m2k_home ) ) :
     ?>
     <div id="maincontentnew">
          <div class="post-res">
               <div class="article-image">
                    <a href="<?php echo $index['guid']?>"><?php if ($index['images'] == null) {?><img src="http://2.bp.blogspot.com/-pbuikOEQaoo/U_eGZySMbxI/AAAAAAAAEq8/mbPo3b7Qzig/s1600/default.png" alt="<?php echo $index['title']?>" class="thumbnail"><?php } else {?><img src="/oc-includes/plugins/timthumb.php?src=<?php echo $index['images'];?>&w=105&h=157&zc=1&q=100" alt="<?php echo $index['title']?>" class="thumbnail"><?php };?>
                    </a>
               </div>

               <div class="article-content">
                    <h2>
                         <a href="<?php echo $index['guid']?>"><?php echo $index['title']?></a> <font color="#000000">&nbsp; <img src="/oc-content/themes/movie2k/images/flag/<?php echo strtolower($index['language']);?>.png" width="24" height="14" border="0" alt="<?php echo $index['title']?>" title="<?php echo $index['title'];?>"></font>
                    </h2>
               </div>

               <div class="postdate">
                    Genre: <a href="/category/<?php echo Categories($index['terms'],'slug');?>"><?php echo Categories($index['terms'],'name');?></a>

                           <?php if(!empty($index['terms3'])) {?>, <a href="/category/<?php echo Categories($index['terms2'],'slug');?>"><?php echo Categories($index['terms2'],'name');?></a>, <a href="/category/<?php echo Categories($index['terms3'],'slug');?>"><?php echo Categories($index['terms3'],'name');?></a><?php } elseif (!empty($index['terms2'])){?>, <a href="/category/<?php echo Categories($index['terms2'],'slug');?>"><?php echo Categories($index['terms2'],'name');?></a>

                           <?php } ;?> 

                     | IMDB Rating: <a target="_blank" rel="nofollow" href="<?php echo $index['imdb']?>"><?php echo $index['rating']?></a> | <a href="#" onclick="javascript:$('#info<?php echo $index['id'];?>').slideToggle('normal');return false;">Info</a>
               </div><!--postdate-->

               <table id="tablemoviesindex" style="margin-top: 5px;">
                    <tbody><?php if (function_exists('category_first')) {category_first($index['imdb']);}?></tbody>
               </table>

          </div><!--post-res-->

          <div id="info<?php echo $index['id'];?>" class="info">
               <strong><?php echo $index['title']?>:</strong><br><?php echo $index['description']?>
          </div>

     </div><!--maincontentnew-->

     <?php 
     endwhile;
     endif;
     mysqli_free_result($m2k_home);
     ?>

</div><!--end maincontent-->

<div id="maincontent2">
     <?php include('index/sidebar.php');?>
</div><!--end sidebar-->

<?php include('footer.php');?>

<?php
}
?>