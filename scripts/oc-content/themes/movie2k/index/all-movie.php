<?php include(THEMES.'header.php');
$_SESSION['SESSION_ALL'] = $role;?>
<div style="padding-left:30px">
    <div id="boxwhite">#</div><div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=A">A</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=B">B</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=C">C</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=D">D</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=E">E</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=F">F</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=G">G</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=H">H</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=I">I</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=J">J</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=K">K</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=L">L</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=M">M</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=N">N</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=O">O</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=P">P</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=Q">Q</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=R">R</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=S">S</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=T">T</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=U">U</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=V">V</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=W">W</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=X">X</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=Y">Y</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-movie&role=Z">Z</a> </div> <div id="boxspace">&nbsp;</div>    </div>
<br><br>
<div id="tdmoviesheader" style="margin-bottom:0px;"><span style="padding-left: 5px; font-weight: bold;">Title</span><span style="padding-left: 500px; font-weight: bold;">Hoster</span> <span style="padding-left: 115px; font-weight: bold;">Year</span> <span style="padding-left: 25px; font-weight: bold;">Q.</span><span style="padding-left: 17px; font-weight: bold;">IMDB Rating</span><span style="padding-left: 17px; font-weight: bold;">Lang.</span></div>

<div id="main_stream"></div>

<div class="animation_image" style="display:none" align="center"><img src="/oc-content/themes/movie2k/images/loading.gif"></div>
<?php
    $V_POSTS_MQ = get_mysqli("oc_posts where active = '1' and type NOT IN('2','3','4','5') GROUP BY imdb");
if( mysqli_num_rows($V_POSTS_MQ) > 0 ) {
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$items_per_group = 25;
$results = $mysqli->query("SELECT COUNT(*) as t_records FROM oc_posts where active='1' and type NOT IN('2','3','4','5') AND title LIKE '$role%'");
$total_records = $results->fetch_object();
$total_groups = ceil($total_records->t_records/$items_per_group);
$results->close(); 
mysqli_close($mysqli);
?>
<script type="text/javascript">
	var track_load = 0;
	var loading  = false;
	var total_groups = <?php echo $total_groups; ?>;
	$('#main_stream').load("/oc-content/themes/movie2k/index/all_movie_more.php", {'group_no':track_load}, function() {track_load++;}); 
           $(window).data('ajaxready', true).scroll(function(e) {
               e.preventDefault();
		if($(window).scrollTop() + $(window).height() == $(document).height())
		{
			if(track_load <= total_groups && loading==false)
			{
				loading = true;
				$('.animation_image').show();
				$.post('/oc-content/themes/movie2k/index/all_movie_more.php',{'group_no': track_load}, function(data){
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

<?php include(THEMES.'footer.php');?>