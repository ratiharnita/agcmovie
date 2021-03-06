<?php include('header.php'); 
if ( $action == 'offline' ){
$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    mysqli_query($db, "UPDATE oc_posts SET report = 'offline' WHERE id = '$po'") or die(mysqli_error($db));
mysqli_close($db);
}  
if (!empty($post['images'])) {$images = $post['images'];} else {$images = '/oc-content/themes/movie2k/images/noposter.gif';}
?>
<div id="tdmoviesheader">
     <span style="padding-left: 2px; font-weight: bold;">Mirrors</span>
     <h1 style="padding-left: 191px; font-weight: bold;display:inline;font-size:14px;">Watch movie</h1>
</div>

<div id="sidebar">
     <?php include('sidebar.php');?>
</div><!--end sidebar-->

<div class="post">

     <div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">
          <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="<?php echo get_home_url()?>"><span itemprop="title">Home</span></a></span> 
          » 
          <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="/category/<?php echo Categories($post['terms'],'slug');?>"><span itemprop="title"><?php echo Categories($post['terms'],'name');?></span></a></span> 
          » 
          <?php echo $post['title'];?>
     </div>

     <div style="float:left;margin-right:10px;">
          <a href="<?php echo get_current_url();?>">
               <img src="<?php echo $images;?>" border="0" style="width:105px;max-width:105px;max-height:160px;min-height:140px;" alt="<?php echo $post['title'];?>" title="<?php echo $post['title'];?>">
          </a>
     </div>

     <div>
          <h1 style="font-size:18px;display:inline;">
               <?php echo $post['title'];?>
               <?php if ( $post['type'] == 3 ){;?>, Season <?php echo $post['season'];?>, Episode <?php echo $post['episode'];?><?php }?>
          </h1> 

          <span style="padding-left:10px;">
               <img src="/oc-content/themes/movie2k/images/flag/<?php echo strtolower($post['language']);?>.png" width="24" height="14" border="0">
          </span> 

          <span style="padding-left:10px;">
               Quality: <img src="/oc-content/themes/movie2k/images/<?php echo $post['picturequality'];?>.gif" alt="Movie quality <?php echo $post['picturequality'];?>" title="Movie quality <?php echo $post['picturequality'];?>" style="vertical-align:top;">
          </span> 

          <?php if ( is_admin() ){?>
               <a title="Edit" href="/page/list-movie&post_type=<?php echo $post['id'];?>&edit=yes" rel="nofollow" target="_blank">Edit</a>
          <?php }?>
     </div>

     <p><?php echo nl2br($post['description'])?></p>

     <div style="clear: both;"></div>

     <div class="margin_top">
          <img src="/oc-content/themes/movie2k/images/question.png"><a href="#" onclick="javascript:$('#help1').slideToggle('normal');return false;" style="font-weight:bolder;">The movie does not play properly? Click here please!</a>
     </div>

     <div id="help1" style="display: none;">
          <br><img src="/oc-content/themes/movie2k/images/flashPlayer2.gif" width="15" height="15" border="0"> The movie does not play properly?<br>You need the Flash Web-Player to watch Flash movies! <a href="http://get.adobe.com/flashplayer/" target="_blank">Click here to download it for free!</a><br><img src="/oc-content/themes/movie2k/images/divx.gif" width="15" height="15" border="0"><img src="/oc-content/themes/movie2k/images/flashPlayer2.gif" width="15" height="15" border="0">The movie stream is too slow?<br>Check the mirror links on the left menu. Here you see hoster listed, which might be faster!<br>
     </div>

     <a id="load_trailer" style="font-weight: bold;position:absolute;top:229px;left:925px;font-size:12px;vertical-align:top; background: #018e9f; color: #fff; padding: 5px 10px; border-radius: 5px;" onclick="load_trailer('<?php echo $post['title'];?>', '<?php echo $post['year'];?>', '<?php echo $post['language'];?>', 'Englisch'); return false;" href="">Trailer</a>
     <div class="trailerb">
          <a class="trailerclose" onclick="close_trailer(); return false;" href="#">✖</a>
          <div class="trailercontent"></div>
     </div>

     <div style="clear:both"></div><br>
          <?php echo $partembed;?>
     <br clear="left">

          <?php echo $embed;?>

     <div style="clear:both"></div>

     <div id="details">
          <?php if ( $post['type'] !== '2' && $post['type'] !== '4' ) {?>
          <div style="height:5px;">&nbsp;</div>IMDB Rating: <a href="<?php echo $post['imdb'];?>" rel="nofollow" target="_blank"><?php echo $post['rating'];?></a> 
          | <?php }?><?php if ( is_login() ){?><a href="/post.php?po=<?php echo $post['id'];?>&action=offline" onclick="return confirm('REPORT AS OFFLINE?');" rel="nofollow"><u style="font-size:12px; vertical-align:top;">REPORT AS OFFLINE</u></a><?php }?>  
          <?php if ( $post['type'] !== '2' && $post['type'] !== '4' ) {?>
          <script>function gotoHosterlistLink2() {location.href=(document.hosterlistdropdown.hosterlist[document.hosterlistdropdown.hosterlist.selectedIndex].value);return TRUE;}</script>
          <form name="hosterlistdropdown" style="display:inline;">| <select name="hosterlist" style="width: 200px; height: 15px; font-size: 11px; vertical-align:top;" onchange="gotoHosterlistLink2();"><?php same_hoster($post['imdb'],$post['hoster']);?></select></form><?php }?>

          <br>Genre: <a href="/category/<?php echo Categories($post['terms'],'slug');?>"><?php echo Categories($post['terms'],'name');?></a><?php if(!empty($post['terms3'])) {?>, <a href="/category/<?php echo Categories($post['terms2'],'slug');?>"><?php echo Categories($post['terms2'],'name');?></a>, <a href="/category/<?php echo Categories($post['terms3'],'slug');?>"><?php echo Categories($post['terms3'],'name');?></a><?php } elseif (!empty($post['terms2'])){?>, <a href="/category/<?php echo Categories($post['terms2'],'slug');?>"><?php echo Categories($post['terms2'],'name');?></a><?php } ;?> 

          | Length: <?php if (!empty($post['duration'])){echo $post['duration'].' minutes';} else {echo 'N/A';}?> | Land/Year: <?php echo $post['country'];?>/<?php echo $post['year'];?><br><?php if ($post['type'] !== '2' && $post['type'] !== '4'){;?>Regie : <?php $remove = array("#","(",")","[","]"," - "," â€“ ","=","+","/","Voice"); $tag = str_replace($remove,"",$post['director']); $tags = explode(",", $tag); for($i = 0; $i < count($tags); $i++){echo '<a href="/index.php?do=regie&id='.permalink($tags[$i]).'" rel="nofollow">'.$tags[$i].'</a>, ';}?> | <?php };?>Actors: <?php $actor = str_replace($remove,"",$post['actors']); $actors = explode(",", $actor); for($i = 0; $i < count($tags); $i++){echo '<a href="/index.php?do=cast&id='.permalink($actors[$i]).'" rel="nofollow">'.$actors[$i].'</a>, ';};?><br>
            <b style="font-weight:bolder;">
            </b>
          </div>
<br>

<div class="SM_width SM_center" id="SIMILARMOVIES">
<div class="SM_similarmoviesOUTER">Recommended movies
<div class="SM_similarmovies"> <?php if (function_exists('related_movie')) {echo related_movie();}?> 
<div class="SM_clear"></div>
</div>
</div>
</div>

<div style="clear:both"></div><br>
<center><?php bloginfo('ads_468x60');?></center>
<div id="comments" class="comments border">

<script type="text/javascript">
$(document).ready(function() {
    //When page loads...
  $(".tab_content").hide(); //Hide all content
  $("ul.tabs li:first").addClass("active").show(); //Activate first tab
  $(".tab_content:first").show(); //Show first tab content

  //On Click Event
  $("ul.tabs li").click(function() {

    $("ul.tabs li").removeClass("active"); //Remove any "active" class
    $(this).addClass("active"); //Add "active" class to selected tab
    $(".tab_content").hide(); //Hide all tab content

    var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
    $(activeTab).fadeIn(); //Fade in the active ID content
    return false;
  });
});
</script>

<ul class="tabs">
    <li class="active"><a href="#tab1">Facebook Comments</a></li>
    <li class=""><a href="#tab2">Comments (<?php echo numcomment("comment_post_ID = '".$post['id']."' and comment_approved = 1");?>)</a></li>
</ul>
<div class="tab_container">
<div id="tab1" class="tab_content" style="display: block;">
<div class="fb-comments" data-href="<?php echo get_current_url();?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
</div><!--end of tab1-->
<div id="tab2" class="tab_content" style="display: none;">

<div class="comment-form">
<?php if( is_login() ){?>
<script>
$(document).ready(function(){
  var form = $('form');
  var submit = $('#submit');

  form.on('submit', function(e) {
    // prevent default action
    e.preventDefault();
    // send ajax request
    $.ajax({
      url: '/oc-content/themes/movie2k/index/comments.php',
      type: 'POST',
      cache: false,
      data: form.serialize(), //form serizlize data
      beforeSend: function(){
        // change submit button value text and disabled it
        submit.val('Submitting...').attr('disabled', 'disabled');
      },
      success: function(data){
        // Append with fadeIn see http://stackoverflow.com/a/978731
        var item = $(data).hide().fadeIn(800);
        $('.comment-box').append(item);

        // reset form and button
        form.trigger('reset');
        submit.val('Submit Comment').removeAttr('disabled');
      },
      error: function(e){
        alert(e);
      }
    });
  });
});
</script>
	<form id="form" method="post">
            <input type="hidden" name="comment_author" id="comment_author" value="<?php echo $session;?>">
            <input type="hidden" name="comment_post_ID" id="comment_post_ID" value="<?php echo $post['id'];?>">
            <input type="hidden" name="comment_author_email" id="comment_author_email" value="<?php echo userinfo($session,'email');?>">
            <input type="hidden" name="comment_approved" id="comment_approved" value="<?php bloginfo('default_comment_status');?>">
            <textarea class="form-control" name="comment_content" id="comment_content" cols="20" rows="3" placeholder="Leave a comment"></textarea>
            <button type="submit" id="submit" class="cmtbtn">Submit Comment</button>
        </form>
        <?php }else{?>
           <div class="error">Please login or register to comment</div>
        <?php };?>

           <div style="clear: both;"></div>
           <div class="comment"><div class="comment-box"></div></div>    
           <div style="clear: both;"></div>

	<?php
		// retrive comments with post id
		$comment_query = get_mysqli("oc_comments WHERE comment_post_ID = '".$post['id']."' and comment_approved = 1 ORDER BY comment_ID DESC LIMIT 25");
	?>

		<?php while($comment = mysqli_fetch_array($comment_query)): ?>
		<div class="comment">
			<div class="avatar">
			    <img src="<?php echo gravatar($comment['comment_author_email']);?>" width="50" height="50" alt="<?php echo $comment['comment_author'] ;?>">
			<header class="comment-header">
					<div class="name"><?php echo $comment['comment_author'] ;?><br><br><?php echo date('m/d/Y h:i', strtotime($comment['comment_date']));?></div>
			</header>
                        </div>
                        <aside class="answer-display"><p><?php echo $comment['comment_content'];?></p></aside>
		</div>
		<?php endwhile;
                  mysqli_free_result($comment_query);
                  ?>

</div><!--end of tab 2-->
</div>

</div><!--comments-->
</div><!--post-->
<script>function load_trailer(e,t,n,r){var i=e+" "+(t<2e3?t+" ":"")+"trailer "+n;var s=encodeURIComponent(i);var o="http://gdata.youtube.com/feeds/api/videos?q="+s+"&format=5&max-results=30&v=2&alt=jsonc&start-index=1";var u=[];var a=false;var f=-1;if(!loaded_trailer){$.ajax({type:"GET",url:o,dataType:"jsonp",beforeSend:function(){},success:function(i){loaded_trailer=true;if(i.data.items){$.each(i.data.items,function(t,n){if(contains_string(n.title,e)&&(contains_string(n.title,"trailer")||contains_string(n.description,"trailer"))&&n.category=="Film"){u.push(n)}});$.each(u,function(e,i){var s=0;if(contains_string(i.title,t)){s=s+1}else if(contains_string(i.description,t)){s=s+.25}else{s=s-1}if(contains_string(i.title,n)||contains_string(i.title,r)){s=s+1}else if(contains_string(i.description,n)||contains_string(i.description,r)){s=s+.2}else{s=s-1}if(f<s){f=s;a=i}});if(a!==false){var s="<iframe src='http://www.youtube.com/embed/"+a.id+"' frameborder='0' type='text/html'></iframe>";$(".trailercontent").html(s);$(".trailerb").slideDown()}}if(a===false){$(".trailercontent").html('<div class="no-trailer">No Trailer found.</div>');$(".trailerb").slideDown()}}})}else{$(".trailerb").slideToggle()}}function close_trailer(){$(".trailerb").slideUp()}function contains_string(e,t){if(e==""||t=="")return false;var n=(e+"").toLowerCase();n=n.replace((t+"").toLowerCase(),"");if(n!=(e+"").toLowerCase()){return true}else{return false}}var loaded_trailer=false</script>
<?php include('footer.php');?>