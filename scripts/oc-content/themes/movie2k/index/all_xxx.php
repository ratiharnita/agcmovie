<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/oc-load.php');?>
<div id="maincontent4"><table id="tablemoviesindex"><tbody>
<?php
$sort                 = $_SESSION['SESSION_ALL'];
$items_per_group     = 25;

$group_number        = filter_var($_POST["group_no"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
if(!is_numeric($group_number)){
    header('HTTP/1.1 500 Invalid number!');
    exit();
}
$position = ($group_number * $items_per_group);
    $results       = get_mysqli("oc_posts where active = 1 and type = 4 AND title LIKE '$sort%' GROUP BY title ORDER BY title DESC LIMIT $position, $items_per_group");
if ($results) { 
    while($obj       = $results->fetch_object()){
           $quality  = $obj->picturequality;
    if ($quality==0) {$quality='0';} elseif ($quality==1){$quality='1';} elseif ($quality==2){$quality='2';} elseif ($quality==3){$quality='3';} elseif ($quality==4){$quality='4';} elseif ($quality==5){$quality='5';}else {$quality='0';}
 
?>
<tr id="coverPreview<?php echo $obj->id;?>">
    <td width="550" id="tdmovies"><a href="/<?php echo $obj->guid;?>"><?php echo $obj->title;?></a></td>
    <td width="185" id="tdmovies"><a href="/<?php echo $obj->guid;?>"><img src="/oc-content/themes/movie2k/images/hoster/<?php echo strtolower($obj->hoster);?>.png" width="16" style="vertical-align:middle;" border="0"> <?php echo $obj->hoster;?></a></td>
    <td width="65" id="tdmovies"><?php echo $obj->year;?></td>
    <td width="25" id="tdmovies"><img src="/oc-content/themes/movie2k/images/<?php echo $quality;?>.gif" border="0"></td>
    <td align="right" id="tdmovies" width="25"><img border="0" src="/oc-content/themes/movie2k/images/flag/<?php echo strtolower($obj->language);?>.png" width="24" height="14"></td>
</tr>

<script type="text/javascript">
        $(document).ready(function(){
                $("#coverPreview<?php echo $obj->id;?>").hover(function(e){
                $("body").append("<?php if (!empty($obj->images)) {?><p id='coverPreview'><img src='<?php echo $obj->images;?>' alt='Image preview' width=105 /></p><?php } else {};?>");  
            $("#coverPreview").css("top",(e.pageY) + "px").css("left",(e.pageX) + "px").fadeIn("fast");            
                $("#coverPreview<?php echo $obj->id;?>").mousemove(function(e){ $("#coverPreview").css("top",(e.pageY) + "px").css("left",(e.pageX) + "px"); });  
            }, function() { $("#coverPreview").remove(); });
                    
                });
    </script>

<?php }
}
unset($obj);
?>
</tbody></table></div>