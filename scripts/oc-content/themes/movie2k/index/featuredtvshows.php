<?php include(THEMES.'header.php');
$querytv = get_mysqli("oc_posts where active = 1 and type = 3 GROUP BY imdb ORDER BY pubdate DESC limit 15");
?>
<div id="tdmoviesheader"><span style="padding-left: 2px; font-weight: bold;">Last Updates</span><span style="padding-left: 304px; font-weight: bold;">Featured series</span></div>

<div id="tv-sidebar">
<?php include(THEMES.'index/tv-sidebar.php');?>
</div><!--end tv-sidebar-->

<div id="maincontenttvshow">
<center><?php bloginfo('ads_468x60');?></center>
<?php if (empty($querytv)) 
{
    echo '<div class="post-res">Sorry, No TV Show already insert.</div>';
} else { 
    while($index = mysqli_fetch_array($querytv)): 
?>
<div id="maintvshow">
    <div class="post-res">
        <div class="article-image">
            <a href="/<?php echo $index['guid']?>"><?php if ($index['images'] == null) {?><img src="http://1.bp.blogspot.com/-BSTZEhil7rE/T94GXlt43XI/AAAAAAAAAbw/rTwMpis4amU/s1600/no_preview.png" style="width:105px;height:150px;" alt="<?php echo $index['title']?>" class="thumbnail"><?php } else {?><img src="<?php echo $index['images'];?>" alt="<?php echo $index['title']?>" class="thumbnail"><?php };?></a>
        </div>

        <div class="article-content">
            <h2><a href="/<?php echo $index['guid']?>"><?php echo $index['title']?></a></h2>
        </div>

        <div class="postdate">Genre: <a class="cc-<?php echo $index['terms'];?>" href="/category/<?php echo Categories($index['terms'],'slug');?>"><?php echo Categories($index['terms'],'name');?></a> | IMDB Rating: <a target="_blank" rel="nofollow" href="<?php echo $index['imdb'];?>"><?php echo $index['rating'];?></a> | Runtime: <?php echo $index['duration'];?> | Land/Year: <?php echo $index['year'];?>
        </div>

        <table id="tablemoviesindex" style="margin-top: 5px;">
            <tbody><?php tvshows_home($index['imdb']);?>
                <tr> 
                    <td id="tdmovies" width="260"></td>
                    <td id="tdmovies" width="150">Quality: <img src="/oc-content/themes/movie2k/images/<?php echo $index['picturequality'];?>.gif" alt="Movie quality" title="Movie quality" style="vertical-align:top;"></td>
                </tr>
            </tbody>
        </table>
</div><!--post-res-->

</div><!--maincontentnew-->
<?php 
    endwhile; 
    }
?>
    </div>
<?php include(THEMES.'footer.php');?>