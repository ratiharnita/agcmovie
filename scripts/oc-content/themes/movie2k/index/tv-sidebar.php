<?php 
    $RPQ  = get_mysqli("oc_posts WHERE active = 1 and type = 3 ORDER BY pubdate DESC LIMIT 50");
              while ($RA = mysqli_fetch_array($RPQ)) { 
               $phpdate = strtotime($RA['pubdat']);
               $mysqldate = date( 'H:i', $phpdate );
                  echo '<table width="100%" style="margin-left:5px; margin-top:7px;" border="0" cellspacing="0" cellpadding="0"><tbody>';   
                  echo '<tr><td id="tdmovies"><img style="vertical-align:top;" src="/oc-content/themes/movie2k/images/hoster/'.strtolower($RA['hoster']).'.png" alt="'.$RA['hoster'].' '.$RA['title'].'" title="'.$RA['hoster'].' '.$RA['title'].'" width="16" border="0"> <a href="/'.$RA['guid'].'"><font color="#000000">'.$RA['title'].', Season: '.$RA['season'].', Episode: '.$RA['episode'].'</font></a><div id="xline2"></div></td></tr>';
                  echo '</tbody></table>';
            } 

?>
<br>
<center><?php bloginfo('ads_300x250');?></center>