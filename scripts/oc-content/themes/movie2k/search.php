<?php include(THEMES.'header.php');
        if(!empty( $id ) ){
                $movie2k_search                 = new MyPagina(1000);
                $movie2k_search->number_links   = 4;
                if(empty($id)) { 
                        $movie2k_search->sql        = "SELECT * FROM oc_posts where active = 1 and type NOT IN ('2') group by title order by id desc";
                } else {
                        $movie2k_search->sql        = "SELECT * FROM oc_posts where active = 1 and type NOT IN ('2') and (title like '%$id%' OR imdb like '%$id%') group by title order by id desc";
                }
                $movie2k_search_result          = $movie2k_search->get_page_result();
        }

?>
<div id="tdmoviesheader" style="margin-bottom:0px;">
        <span style="padding-left: 5px; font-weight: bold;">Title</span><span style="padding-left: 527px; font-weight: bold;">Hoster</span> <span style="padding-left: 137px; font-weight: bold;">Year</span> <span style="padding-left: 45px; font-weight: bold;">Q.</span><span style="padding-left: 17px; font-weight: bold;">IMDB Rating</span>
</div>

<div id="maincontent4">
        <table id="tablemoviesindex"><tbody>

        <?php 
        if( !$movie2k_search_result || mysqli_num_rows($movie2k_search_result) == 0 ) :

        else:
        while ($cari = mysqli_fetch_assoc($movie2k_search_result)):
        ?>
        <tr id="coverPreview<?php echo $cari['id']?>">
                <td width="550" id="tdmovies">
                        <a href="/<?php echo $cari['guid']?>"><?php echo $cari['title'];?></a>
                </td>
                <td width="185" id="tdmovies">
                        <a href="/<?php echo $cari['guid']?>"><img src="/oc-content/themes/movie2k/images/flashPlayer2.gif" width="16" style="vertical-align:middle;" border="0"> watch on <?php echo $cari['hoster']?></a>
                </td>
                <td width="80" id="tdmovies">
                        <?php echo $cari['year']?>
                </td>
                <td width="25" id="tdmovies">
                        <img src="/oc-content/themes/movie2k/images/<?php echo $cari['picturequality'];?>.gif" border="0"></td>
                <td id="tdmovies" width="114">&nbsp;&nbsp;&nbsp;<strong><?php echo $cari['rating']?></strong> / 10</td>
        </tr>
        <script type="text/javascript">
        $(document).ready(function(){
                $("#coverPreview<?php echo $cari['id'];?>").hover(function(e){
                $("body").append("<p id='coverPreview'><img src='<?php echo $cari['images'];?>' alt='Image preview' width=105 /></p>");	
    		    $("#coverPreview").css("top",(e.pageY) + "px").css("left",(e.pageX) + "px").fadeIn("fast");						
                $("#coverPreview<?php echo $cari['id'];?>").mousemove(function(e){ $("#coverPreview").css("top",(e.pageY) + "px").css("left",(e.pageX) + "px"); });	
            }, function() { $("#coverPreview").remove(); });
                    
                });
        </script>
        <?php 
        endwhile; 
        endif;
        ?>
        </tbody></table>
        <?php 
        if( $movie2k_search_result || mysqli_num_rows($movie2k_search_result) > 0 ) :
        ?>
        <?php echo $movie2k_search->navigation("", "active", false, false, false, true,"<li>","</li>");?>
        <?php 
        endif;
        ?>
</div>
<?php include('footer.php');?>