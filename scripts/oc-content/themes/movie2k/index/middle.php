<?php 
    $middlequery  = get_mysqli( "oc_posts WHERE active = 1 and type = 1 GROUP BY imdb ORDER BY pubdate DESC LIMIT 40" );
        while ($RA = mysqli_fetch_array($middlequery)) { 
            $quality = $RA['picturequality'];
            $phpdate = strtotime($RA['pubdate']);
            $mysqldate = date( 'H:i', $phpdate );
                if ($quality==0) {$quality='0';} elseif ($quality==1){$quality='1';} elseif ($quality==2){$quality='2';} elseif ($quality==3){$quality='3';} elseif ($quality==4){$quality='4';} elseif ($quality==5){$quality='5';}else {$quality='0';}

                echo '<table width="100%" style="margin-left:5px; margin-top:7px;" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td valign="top" rowspan="2" width="5px"></td><td valign="top" height="100%"><a href="/'.$RA['guid'].'"><font color="#000000"><strong>'.$RA['title'].'</strong></font></a></td></tr>';   
                echo '<tr><td height="20px" style="padding-left:15px; padding-top:3px; font-size: 12px; vertical-align:top;">';
                echo middle_first($RA['imdb']);
                echo '</td></tr></tbody></table><div id="xline2"></div>';
            }
     mysqli_free_result($middlequery);
?>