<?php
/**
 * The default template for displaying content
 *
 * @package OcimPress
 * @subpackage Arsa
 * @since Arsa 1.0
 */
include('header.php'); 
if (mysqli_num_rows($postq) > 0) {?>

     <div class="col-sm-8">
          <div id="snippet-inside">
               <div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#"><span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="<?php echo get_home_url();?>"><span itemprop="title">Home</span></a></span> » <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="/category/<?php echo Categories($post['terms'],'slug');?>"><span itemprop="title"><?php echo Categories($post['terms'],'name');?></span></a></span>
               </div>

               <h1 class="title-post" itemprop="name"><?php echo $post['title']; ?></h1>

               <div class="snippet-inside-det"><div id="snippet-details"><span id="snippet-det">Posted <?php echo time_ago($post['pubdate']);?> <?php if (is_login() == 'administrator'){?><a title="Edit" href="/oc-admin/post.php?post=<?php echo $post['id']; ?>" rel="nofollow" target="_blank">Edit</a><?php }else{?><?php }?></span></div>
               </div>
               <div class="clearfix"></div>

               <div id="snippet-inside-content">
                    <?php echo $post['description']; ?>
               <div style="clear: both;"></div>
                    <div class="separator">→</div>
               </div><!--post-body-->

               Tag: <?php 
                    $remove = array("#","(",")","[","]"," - "," Ã¢â‚¬â€œ ","=","+","/");
                    $tag = str_replace($remove,"",$post['tags']);
                    $tags = explode(",", $tag);
                    for($i = 0; $i < count($tags); $i++){echo '<a href="/tag/'.permalink($tags[$i]).'" rel="nofollow">'.$tags[$i].'</a>, ';};?>

               <div class="related">

                    <h3>Related Posts</h3>
                    <ul>
                         <?php related_posts($post['terms']);?>
                    </ul>
               </div><!--related-posts-->

          </div><!--snippet-inside-->

               <div class="comments" id="comments">
               <?php if( 'open' == $post['comment_status'] ) : ?>
                <?php if ( comments_open() ) : ?>
                   <?php if ( comment_registration() ) { ?>
                    <!-- Blog Comments -->
                      <?php include('comments.php');?>
                    <?php }else{echo '"<a href="/oc-login.php">Login</a> or <a href="/oc-login.php?action=register">Register</a> to post comments"';} // comment_registration() ?>
                  <?php endif; // comments_open() ?>
                <?php endif; // comment_status ?>
               </div><!--comments-->

     </div><!--col-sm-8-->

<div class="col-sm-4">
     <?php include('sidebar.php');?>
</div><!--end sidebar-->

<?php } else {header("location:/index.php?do=404");} 
include('footer.php');?>