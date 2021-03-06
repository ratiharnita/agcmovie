<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything
 *
 * @package OcimPress
 * @subpackage movie2k clone
 * @since movie2k clone 1.0
 */
include_once('function.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php oc_title(get_bloginfo('name'),' - ');?></title>
    <meta name="description" content="<?php oc_description(get_bloginfo('description'));?>" />
    <meta name="keyword" content="<?php oc_keyword(get_bloginfo('keyword'));?>" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="generator" content="Ocim 1.0" />

    <meta name="robots" content="<?php bloginfo('blog_public'); ?>,follow" />
    <link rel="alternate" type="application/rss+xml" title="My Blog » Feed" href="<?php echo get_home_url(); ?>/rss.php" />
    <link rel="canonical" href="<?php echo get_current_url();?>" />

    <link href="<?php bloginfo('stylesheet_url'); ?>/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>/css/jquery.modal.css" type="text/css" media="screen">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php bloginfo('stylesheet_url'); ?>/js/custom.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.50/jquery.form.min.js"></script>

<style type="text/css">
<!--
body {
  background-image: url(/oc-content/themes/movie2k/images/background.gif);
  background-repeat: repeat-x;
}
-->
</style>
<script>
   if(self == top) {
       document.documentElement.style.display = 'block'; 
   } else {
       top.location = self.location; 
   }
  function showMovie() {
      location.href=(document.moviedropdown.movieurl[document.moviedropdown.movieurl.selectedIndex].value);
  }
  function showPart() {
      location.href=(document.partdropdown.movieparturl[document.partdropdown.movieparturl.selectedIndex].value);
  }

    function showNewContent() {  
        $('#content').show('normal',hideLoader());  
    }  
    function hideLoader() {  
        $('#load').fadeOut('normal');  
    }    
    function showAutoComplete (searchtext) {
        if (searchtext.length>0) {
            document.getElementById('searchAutoComplete').style.display='inline';
            $('#searchAutoComplete').load('/oc-content/themes/movie2k/index/searchAutoCompleteNew.php?id='+escape(searchtext),'',showNewContent);
        }
        return false;
    }
    function closeAutoComplete() {
        document.getElementById('searchAutoComplete').style.display='none';   
        return true;
    }   
</SCRIPT>
    <link rel="SHORTCUT ICON" href="/oc-content/uploads/favicon.png" />
    <?php bloginfo('m2k_header_code');?>
    <?php $hooks->do_action('theme_header');?>
</head>

<BODY leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=<?php echo get_bloginfo('fbapp');?>&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<header id="adminbarheader"></header>
<div style="position:absolute; margin-top:59px; margin-left:30px; color:#FFF; font-size: 10px;"><?php if( $po ) {echo 'Watch '.get_bloginfo('name').' movie, cinema and tv shows and download '.get_bloginfo('name').' free';} elseif ($do == "category") {echo 'Your movie, tv shows and blockbuster database!';} elseif ($do == "search") {echo $id;} else {echo get_bloginfo('description');}?></div>
<a href="<?php echo get_bloginfo('url');?>" id="fkFinger"></a>
<table width="993" border="0" cellspacing="0" cellpadding="0">
  <tbody><tr>
    <td height="45"><table width="993" border="0" cellspacing="0" cellpadding="0">
      <tbody><tr>
        <td width="467"><a href="<?php echo get_bloginfo('url');?>"><img src="/oc-content/uploads/logo.png" border="0" width="206" height="39" alt="<?php echo get_bloginfo('name');?>" title="<?php echo get_bloginfo('name');?>"></a></td>
        <td width="92" align="right" valign="middle"><img src="/oc-content/themes/movie2k/images/news.png" width="15" height="15" align="top" alt="Movie and Cinema News" title="Movie and Cinema News"> <span class="mainmenue"><a href="/">News</a></span></td>
        <?php if ( is_login() ){?><?php }else{?><td width="95" align="right"><img src="/oc-content/themes/movie2k/images/forum.png" width="15" height="15" align="top" alt="User Registration on <?php echo get_domain(get_bloginfo('url'));?>" title="<?php echo $lang['JOIN']; ?> <?php echo get_domain(get_bloginfo('url'));?>"> <span class="mainmenue"><a href="/page/register">Register</a></span></td><?php }?>
        <td width="79" align="right"><img src="/oc-content/themes/movie2k/images/faq.png" width="15" height="15" align="top" alt="Frequently Asked Questions" title="Frequently Asked Questions"> <span class="mainmenue"><a href="/page/faq">FAQ</a></span></td>
        <td width="102" align="right"><img src="/oc-content/themes/movie2k/images/contact.png" width="15" height="15" align="top" alt="Contact" title="Contact"> <span class="mainmenue"><a href="/page/contact">Contact</a></span></td>
        <td width="120" align="right" class="mainmenue"><img src="/oc-content/themes/movie2k/images/add.png" width="15" height="15" align="top" alt="Add a movie" title="Add a movie"> <a href="/page/add">Add a movie</a></td>
      </tr>
    </tbody></table></td>
  </tr>

  <tr>

    <td style="padding-left:30px;" width="993" height="168" background="/oc-content/themes/movie2k/images/header_v1_0.jpg">
 
    <span style="font-size:10px; color: #FFF;">Search</span><br>
    
    <div class="<?php if ( is_login() ):?>days3<?php else:?>days<?php endif;?>">
    <div id="menue">
        <div class="aussen">
            <a class="test123" href="/"><span class="menutag">Movies</span></a>
            <a class="innen-1" href="/">Cinema movies</a>
            <a class="innen" href="/page/updates">Latest updates</a>
            <a class="innen" href="/page/all-movie">All movies</a>
            <a class="innen" href="/page/genres">Genres</a>
            <a class="innen" href="/page/random">Random movie</a>            
            <a class="innen" target="_blank" href="/page/rss">RSS feed</a>
        </div>
        <div class="aussen">
            <a class="test123" href="/page/featuredtvshows"><span class="menutag">TV shows</span></a>
            <a class="innen-1" href="/page/featuredtvshows">Featured</a>
            <a class="innen" href="/page/tvshows-updates">Latest updates</a>
            <a class="innen" href="/page/all-tv-shows">All TV shows</a>
            <a class="innen" href="/page/genres-tvshows">Genres</a>
            <a class="innen" href="/page/random-show">Random Show</a>            
            <a class="innen" target="_blank" href="/page/rss-tvshows">RSS feed</a>
        </div>
        <?php if (isset($_COOKIE["hidexxx"])){?><?php }else{?>
        <div class="aussen">
            <a class="test123" href="/page/xxx"><span class="menutag">XXX movies</span></a>
            <a class="innen-1" href="/page/xxx">Latest updates</a>
            <a class="innen" href="/page/xxx-all">All movies</a>
            <a class="innen" href="/page/genres-xxx">Genres</a>
            <a class="innen" href="/page/random-xxx">Random movie</a>            
            <a class="innen" target="_blank" href="/page/rss-xxx">RSS feed</a>
        </div>
        <?php }?>
        <?php if ( is_login() ){?>
        <div class="aussen">
            <span class="menutag">User</span>
            <a class="innen-1" href="/page/add">Add a movie</a>
            <a class="innen" href="/page/add-tvshow">Add a tvshow</a>
            <a class="innen" href="/page/myuploads">My uploads</a>
            <a class="innen" href="/page/modify">Edit account</a>
            <a class="innen" href="/page/logout">Logout</a>
        </div>
        <?php }?>
        <?php if ( is_admin() ){?>
        <div class="aussen">
            <span class="menutag">Admin</span>
            <a class="innen-1" href="/page/setting">Setting</a>
            <a class="innen" href="/page/list-movie">List Movie</a>
            <a class="innen" href="/page/list-user">List User</a>
            <a class="innen" href="/page/add-genre">Add Genre</a>
            <a class="innen" href="/page/add-genre-tv">Add Genre TV</a>
            <a class="innen" href="/page/add-genre-xxx">Add Genre XXX</a>
            <a class="innen" href="/page/add-hoster">Add Hoster</a>
            <a class="innen" href="/page/add-language">Add Language</a>
        </div>
        <?php }?>
    </div><!-- menue -->
    </div><!-- days-->
    <!-- menuebox -->

    <form method="GET" action="/index.php" style="display:inline; z-index:3;">
            <input type="hidden" name="do" value="search">
            <input name="id" placeholder="Title or IMDb-ID" onkeyup="showAutoComplete(this.value)" onblur="window.setTimeout('closeAutoComplete()',500);" autocomplete="off"> <input type="submit" value="GO">    
            <div id="searchAutoComplete" style="display:none;position:absolute;left:30px;top:146px; z-index:3;"></div>
    </form>

</td>    </tr>

</tbody></table>

<div id="content">