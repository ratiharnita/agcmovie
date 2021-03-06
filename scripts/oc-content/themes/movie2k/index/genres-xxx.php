<?php include(THEMES.'header.php');
function get_numgenres($name){
    $db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    $GET_ID = "SELECT count(*) FROM oc_posts where active = 1 and type = 4 and terms = '$name' or terms2 = '$name' or terms3 = '$name'";
    $query  = mysqli_query($db, $GET_ID) or die (mysqli_error($db));
              while ($USER = mysqli_fetch_array($query)) { 
                  $output = $USER[0];   
                            echo $output; 
            }
    mysqli_close($db);
}
$genressql = get_mysqli('oc_terms where type = 2 order by name asc');
for ($i = 0; $row = mysqli_fetch_array($genressql); $i++)
{
    $the_genres[$i]['id'] = $row['id'];
    $the_genres[$i]['name'] = $row['name'];
    $the_genres[$i]['slug'] = $row['slug'];
}
?>
<div id="tdmoviesheader" style="margin-bottom:0px;"><div style="float: left; padding: 0 5px; width:155px; font-weight: bold;">Genre</div><div style="float: left; padding: 0 5px; width:175px; font-weight: bold;">Amount of movies</div><div style="float: left; padding: 0 5px; width:155px; font-weight: bold;">Random</div><div style="clear:both;"></div></div>

<?php if (empty($the_genres)) { echo '<div class="post">Sorry, No posts found.</div>';} else { foreach($the_genres as $genre): ?>
<table id="tablemovies" cellpadding="5" cellspacing="5">
  <tbody><tr>
    <td id="tdmovies" width="155"><a href="/category/<?php echo $genre['slug']?>"><?php echo $genre['name']?></a></td>
    <td id="tdmovies" width="175"><?php get_numgenres($genre['id'])?></td>
    <td id="tdmovies" width="155"><a href="/page/random-xxx">Random</a></td>
  </tr>
</tbody></table>
<?php endforeach; }?>

<?php include(THEMES.'footer.php');?>