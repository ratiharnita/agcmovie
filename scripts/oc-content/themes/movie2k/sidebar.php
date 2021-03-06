<?php if ( $post['type'] == 3){;?>
<script>
    function gotoEpisode(url) {
        window.location=url;
        return false;
    }
</script>
<table style="margin-left: 5px;" border="0" cellpadding="0" cellspacing="0" width="98%"><tbody>
    <tr>
        <td style="align: left; padding-bottom:5px;width:80px;"><form name="seasonform"><select name="season" onchange="gotoEpisode(this.value);"><option selected="" value="<?php echo $post['season'];?>">Season <?php echo $post['season'];?></option><?php season_list_drop($post['imdb']);?></select></form></td>
        <td style="align: left; padding-bottom:5px;"><div id="episodediv<?php echo $post['episode'];?>" style="display: inline;"><form name="episodeform<?php echo $post['episode'];?>"><select name="episode" style="margin-left:18px;" onchange="gotoEpisode(this.value);"><option selected="" value="<?php echo $post['episode'];?>">Episode <?php echo $post['episode'];?></option><?php episode_list_drop($post['imdb']);?></select></form></div></td>
    </tr>
        <?php if (function_exists('related_tv')) { related_tv($post['imdb']) ;}?>
</tbody></table>

<?php } elseif ( $post['type'] == 1) {?>

<table style="margin-left: 5px;" border="0" cellpadding="0" cellspacing="0" width="98%"><tbody>
    <tr>
        <td valign="top" height="100%" colspan="2" style="padding-bottom:5px;"><font color="#000000" size="2px"><strong>Watch "<?php echo $post['title'];?>" on:</strong></font></td>
   </tr>
        <?php if (function_exists('related_hoster')) { related_hoster($post['imdb']) ;}?>
</tbody></table>

<?php } else {?>

<table style="margin-left: 5px;" border="0" cellpadding="0" cellspacing="0" width="98%"><tbody>
    <tr>
        <td valign="top" height="100%" colspan="2" style="padding-bottom:5px;"><font color="#000000" size="2px"><strong>Watch "<?php echo $post['title'];?>" on:</strong></font></td>
   </tr>
        <?php if (function_exists('related_hoster_xxx')) { related_hoster_xxx($post['title']) ;}?>
</tbody></table>

<?php };?>
<div id="xline2"></div>

<center><?php bloginfo('ads_160x600');?></center>