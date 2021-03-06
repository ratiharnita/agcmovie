<?php 
/**
 * The template for displaying Category pages
 *
 * @package OcimPress 
 * @subpackage movie2k
 * @since movie2k 1.0
 */
include('header.php');
$start = 0;
$limit = get_bloginfo('posts_per_page');
if(isset($_GET['page'])){
    $pages=$_GET['page'];
    $start=($pages-1)*$limit;
}
$terms = get_Categories($id,'id');
$querycategory = get_mysqli("oc_posts WHERE active = 1 and terms = '$terms' or terms2 ='$terms' or terms3 ='$terms' group by imdb LIMIT $start, $limit");

?>
<div id="tdmoviesheader" style="margin-bottom:0px;"><span style="padding-left: 5px; font-weight: bold;">Title</span><span style="padding-left: 480px; font-weight: bold;">Hoster</span> <span style="padding-left: 137px; font-weight: bold;">Year</span> <span style="padding-left: 45px; font-weight: bold;">Q.</span><span style="padding-left: 17px; font-weight: bold;">IMDB Rating</span> <span style="padding-left:32px; font-weight: bold;">Lang.</span></div>

<div id="maincontent4">
<table id="tablemoviesindex"><tbody>
  
<?php while($page = mysqli_fetch_array($querycategory)):
    $quality = $page['picturequality'];
if ($quality==0) {$quality='0';} elseif ($quality==1){$quality='1';} elseif ($quality==2){$quality='2';} elseif ($quality==3){$quality='3';} elseif ($quality==4){$quality='4';} elseif ($quality==5){$quality='5';}else {$quality='0';}
?>
<tr id="coverPreview<?php echo $page['id'];?>">
  <td width="500" id="tdmovies">
   <a href="/<?php echo $page['guid'];?>"><?php echo $page['title'];?></a>
  </td>
  <td width="185" id="tdmovies">
    <a href="<?php echo $page['permalink'];?>">
      <img src="/oc-content/themes/movie2k/images/hoster/<?php echo strtolower($page['hoster']);?>.png" width="16" style="vertical-align:middle;" border="0"> watch on <?php echo $page['hoster'];?></a>
  </td>
  <td width="60" id="tdmovies">
   <?php echo $page['year'];?>
  </td>
  <td width="25" id="tdmovies">
      <img src="/oc-content/themes/movie2k/images/<?php echo $quality;?>.gif" border="0"></td>
  <td id="tdmovies" width="114">&nbsp;&nbsp;&nbsp;<strong><?php echo $page['rating'];?></strong> / 10</td>
  <td align="right" id="tdmovies" width="25"><img border="0" src="/oc-content/themes/movie2k/images/flag/<?php echo strtolower($page['language']);?>.png" width="24" height="14"></td>
</tr>
<script type="text/javascript">
        $(document).ready(function(){
                $("#coverPreview<?php echo $page['id'];?>").hover(function(e){
                $("body").append("<?php if (!empty($page['images'])) {?><p id='coverPreview'><img src='<?php echo $page['images'];?>' alt='Image preview' width=105 /></p><?php } else {};?>");  
            $("#coverPreview").css("top",(e.pageY) + "px").css("left",(e.pageX) + "px").fadeIn("fast");            
                $("#coverPreview<?php echo $page['id'];?>").mousemove(function(e){ $("#coverPreview").css("top",(e.pageY) + "px").css("left",(e.pageX) + "px"); });  
            }, function() { $("#coverPreview").remove(); });
                    
                });
    </script>
<?php endwhile;
      mysqli_free_result($querycategory); ?>
</tbody></table>
<br><br>
<?php 
$rows = mysqli_num_rows(get_mysqli("oc_posts WHERE active = 1 and terms = '$terms' or terms2 ='$terms' or terms3 ='$terms' group by imdb"));
$total=ceil($rows/$limit);

if($pages>1)
{
echo "<a href='$id&page=".($pages-1)."' class='prev'>PREVIOUS</a>";
}
if($pages!=$total)
{
echo "<a href='$id&page=".($pages+1)."' class='prev'>NEXT</a>";
}
echo "<ul class='page'>";
for($i=1;$i<=$total;$i++)
{
if($i==$pages) { echo "<li class='current'>".$i."</li>"; }
else { echo "<li><a href='$id&page=".$i."'>".$i."</a></li>"; }
}
echo "</ul>";
?>
    </div>
<?php include('footer.php');?>