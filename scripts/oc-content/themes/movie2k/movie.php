<?php include('header.php');
$_SESSION['SESSION_ALL'] = isset($_GET['letter']) ? $_GET['letter'] : '';?>
<div style="padding-left:30px">
    <div id="boxwhite">#</div><div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/movies-all-A">A</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/movies-all-B">B</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="./movies-all-C">C</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="./movies-all-D">D</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="./movies-all-E">E</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="./movies-all-F">F</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="./movies-all-G">G</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="./movies-all-H">H</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="./movies-all-I">I</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="./movies-all-J">J</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="./movies-all-K">K</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="./movies-all-L">L</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="./movies-all-M">M</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="./movies-all-N">N</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="./movies-all-O">O</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="./movies-all-P">P</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="./movies-all-Q">Q</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="./movies-all-R">R</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="./movies-all-S">S</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="./movies-all-T">T</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="./movies-all-U">U</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="./movies-all-V">V</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="./movies-all-W">W</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="./movies-all-X">X</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="./movies-all-Y">Y</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="./movies-all-Z">Z</a> </div> <div id="boxspace">&nbsp;</div>    </div>
<br><br>
<div id="tdmoviesheader" style="margin-bottom:0px;"><span style="padding-left: 5px; font-weight: bold;">Title</span><span style="padding-left: 500px; font-weight: bold;">Hoster</span> <span style="padding-left: 137px; font-weight: bold;">Year</span> <span style="padding-left: 45px; font-weight: bold;">Q.</span><span style="padding-left: 17px; font-weight: bold;">IMDB Rating</span><span style="padding-left:32px; font-weight: bold;">Lang.</span></div>

<div id="main_stream"></div>

<div class="animation_image" style="display:none" align="center"><img src="/content/themes/movie4k/images/loading.gif"></div>
<?php
    $V_POSTS_S = "select * from posts where active='1' and iv NOT IN('2','3','4','5') GROUP BY imdbuser";
    $V_POSTS_MQ = mysqli_query($connecDB, $V_POSTS_S) or die (mysqli_error($connecDB));
if( mysqli_num_rows($V_POSTS_MQ) > 0 ) {
$items_per_group = 25;
$results = $connecDB->query("SELECT COUNT(*) as t_records FROM posts where active='1' and iv NOT IN('2','3','4','5') AND title LIKE '%$letter%' GROUP BY imdbuser");
$total_records = $results->fetch_object();
$total_groups = ceil($total_records->t_records/$items_per_group);
$results->close(); 
?>
<script type="text/javascript">
  var track_load = 0;
  var loading  = false;
  var total_groups = <?php echo $total_groups; ?>;
  $('#main_stream').load("/content/themes/movie4k/index/all_movie_more.php", {'group_no':track_load}, function() {track_load++;}); 
           $(window).data('ajaxready', true).scroll(function(e) {
               e.preventDefault();
    if($(window).scrollTop() + $(window).height() == $(document).height())
    {
      if(track_load <= total_groups && loading==false)
      {
        loading = true;
        $('.animation_image').show();
        $.post('/content/themes/movie4k/index/all_movie_more.php',{'group_no': track_load}, function(data){
          $("#main_stream").append(data);
          $('.animation_image').hide();
          track_load++; //loaded group increment
          loading = false; 
        }).fail(function(xhr, ajaxOptions, thrownError) {
          alert(thrownError);
          $('.animation_image').hide();
          loading = false;
        });
      }
    }
  });
</script>
<?php } else {?>
<div id="maincontent4">
<table id="tablemoviesindex"><tbody>
</tbody></table>
    </div>
<?php
}?>

<?php include('footer.php');?>