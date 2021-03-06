<?php include(THEMES.'header.php');
$_SESSION['SESSION_ALL'] = $role;?>
<div style="padding-left:30px">
    <div id="boxwhite">#</div><div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=A">A</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=B">B</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=C">C</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=D">D</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=E">E</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=F">F</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=G">G</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=H">H</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=I">I</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=J">J</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=K">K</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=L">L</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=M">M</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=N">N</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=O">O</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=P">P</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=Q">Q</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=R">R</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=S">S</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=T">T</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=U">U</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=V">V</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=W">W</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=X">X</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=Y">Y</a> </div> <div id="boxspace">&nbsp;</div><div id="boxgrey"><a href="/page/all-tv-shows&role=Z">Z</a> </div> <div id="boxspace">&nbsp;</div>    </div>
<br><br>
<div id="tdmoviesheader" style="margin-bottom:0px;"><span style="padding-left: 5px; font-weight: bold;">Title</span><span style="padding-left: 500px; font-weight: bold;">Q.</span><span style="padding-left: 17px; font-weight: bold;">IMDB Rating</span><span style="padding-left: 17px; font-weight: bold;">Lang.</span></div>

<div id="main_stream"></div>

<div class="animation_image" style="display:none" align="center"><img src="/oc-content/themes/movie2k/images/loading.gif"></div>
<?php
    $V_POSTS_MQ = get_mysqli("oc_posts where active = '1' and type = 3 GROUP BY imdb");
if( mysqli_num_rows($V_POSTS_MQ) > 0 ) {
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$items_per_group = 25;
$results = $mysqli->query("SELECT COUNT(*) as t_records FROM oc_posts where active='1' and type = 3 AND title LIKE '$role%'");
$total_records = $results->fetch_object();
$total_groups = ceil($total_records->t_records/$items_per_group);
$results->close();
mysqli_close($mysqli);
?>
<script type="text/javascript">
	var track_load = 0;
	var loading  = false;
	var total_groups = <?php echo $total_groups; ?>;
	$('#main_stream').load("/oc-content/themes/movie2k/index/tvshows-all.php", {'group_no':track_load}, function() {track_load++;}); 
           $(window).data('ajaxready', true).scroll(function(e) {
               e.preventDefault();
		if($(window).scrollTop() + $(window).height() == $(document).height())
		{
			if(track_load <= total_groups && loading==false)
			{
				loading = true;
				$('.animation_image').show();
				$.post('/oc-content/themes/movie2k/index/tvshows-all.php',{'group_no': track_load}, function(data){
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