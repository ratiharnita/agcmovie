<?php 
    $RPQ  = get_mysqli("oc_posts WHERE active = 1 and type = 1 GROUP BY imdb ORDER BY RAND() LIMIT 30");
        while ($RA = mysqli_fetch_array($RPQ)) { 
            $phpdate = strtotime($RA['pubdate']);
            $mysqldate = date( 'H:i', $phpdate );
            $quality = $RA['picturequality'];
                if ($quality==0) {$quality='0';} elseif ($quality==1){$quality='1';} elseif ($quality==2){$quality='2';} elseif ($quality==3){$quality='3';} elseif ($quality==4){$quality='4';} elseif ($quality==5){$quality='5';}else {$quality='0';}

                echo '<div id="sidebar-home"><div style="float: left;"><a href="/'.$RA['guid'].'"><img src="/oc-includes/plugins/timthumb.php?src='.$RA['images'].'&w=105&h=157&zc=1&q=100" alt="'.$RA['title'].'" title="'.$RA['title'].'" border="0" style="width:105px;max-width:105px;max-height:160px;min-height:140px;"></a>&nbsp;<br></div><div style="min-height: 170px;"><h2 style="font-size: 13px;"><a href="/'.$RA['guid'].'"><font color="#000000"><strong>'.$RA['title'].'</strong></font></a><font color="#000000"></font></h2>';  
                echo '<table id="tablemoviesindex" style="margin-top:10px;"><tbody>';   
                echo random_movie($RA['imdb']);
                echo '</tbody></table></div><div id="xline"></div></div>';   
            } 
     mysqli_free_result($RPQ);
?>


<div class="ads160x600">
<?php bloginfo('ads_160x600');?>
</div>