<?php include(THEMES.'header.php');
$q5 = get_mysqli("oc_posts ORDER BY id DESC LIMIT 1");
$row5 = mysqli_fetch_assoc($q5);
$next = $row5['id'] + 1;
$next2 = $row5['id'] + 2;
$next3 = $row5['id'] + 3;
$next4 = $row5['id'] + 4;
$next5 = $row5['id'] + 5;
?>
<script language="javascript">

  function checkradio(feld){
    for (i=0; i<feld.length; i++){
        if(feld[i].checked == true){
          return feld[i].value;
        }
    }
  }
  function changeThumbnail() {
    if (checkradio(document.addmovie.thumbnail)=='upload') {
      document.getElementById('thumb_upload').style.display='block';
      document.getElementById('thumb_link').style.display='none';
    } else {
      document.getElementById('thumb_upload').style.display='none';
      document.getElementById('thumb_link').style.display='block';          
    }
  }  
  function changeThumbnails() {
    if (checkradio(document.addmovie.hosterc)=='embed') {
      document.getElementById('hoster_embed').style.display='block';
      document.getElementById('hoster_link').style.display='none';
    } else {
      document.getElementById('hoster_embed').style.display='none';
      document.getElementById('hoster_link').style.display='block';          
    }
  } 
</script>
<script type="text/javascript">
  function change2xxx() {
      if (document.addmovie.xxx.checked==true) {
          document.getElementById('genre_xxx').style.display = "block";
          document.getElementById('genre_xxx2').style.display = "block";
          document.getElementById('genre_xxx3').style.display = "block";        
          document.getElementById('xxxinfo').style.display = "block";
            document.getElementById('genre_nonxxx').style.display = "none";
            document.getElementById('genre_nonxxx2').style.display = "none";
            document.getElementById('genre_nonxxx3').style.display = "none";
            document.getElementById('moredetails').style.display = "block";
      } else {
            document.getElementById('genre_xxx').style.display = "none";
            document.getElementById('genre_xxx2').style.display = "none";
            document.getElementById('genre_xxx3').style.display = "none";       
            document.getElementById('genre_nonxxx').style.display = "block";   
            document.getElementById('genre_nonxxx2').style.display = "block";
            document.getElementById('genre_nonxxx3').style.display = "block";        
            document.getElementById('xxxinfo').style.display = "none";
      }
      return TRUE;
  }
    </script>
<script type="text/javascript">
$(document).ready(function()
{
    $('#formposturl').on('submit', function(e)
    {
        e.preventDefault();
        $('#submit').attr('disabled', ''); // disable upload button
        //show uploading message
        $("#output").html('<div class="redirecting">Submiting.. Please wait..</div>');
    
        $(this).ajaxSubmit({
        target: '#output',
        success : afterSuccess
         });
    });
});
 
function afterSuccess()
{  
    $('#submit').removeAttr('disabled'); //enable submit button
    //$('#formposturl').hide();  // reset form
    //$('#formposturl').resetForm();  // reset form 
    
}
function trim(str){
    var str=str.replace(/^\s+|\s+$/,'');
    return str;
}
</script>
<?php if( is_login() ){?>
<div class="formadd">
<h1>Add movie</h1>
<a href="#" onclick="window.open('/page/ui_guidelines','ui_guidelines','width=800,height=660,top=100,left=200,scrollbars=yes,location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,dependent=no'); return false;" rel="nofollow">Please read our guideline before posting your uploads.</a>
<div id="output"></div>
  <form action="/page/addmovie" id="formposturl" name="addmovie" enctype="multipart/form-data" method="post">
        <table><tbody><tr><td width="120">Title*</td><td><input name="title" type="text" placeholder="Use always the movie title which is used on IMDB.com"/><font size="1">Use always the movie title which is used on IMDB.com</font></td></tr>
        <tr><td width="120">XXX movie?:</td><td>
        <input class="interfaceshortforms" type="checkbox" name="xxx" onclick="change2xxx();"> yes 
        <div id="xxxinfo" style="display: none;">Please upload only regular and full porn movies and no clips!<br>Please upload the cover and add description and genres for this xxx-movie!</div></td></tr>
        <tr><td width="120">Language*:</td><td>
        <select class="interfaceforms" name="language"><option value="">Please select</option><?php echo option_category('type = 4');?></select></td></tr>
        </tbody></table>

        <table><tbody><tr><td width="120">Hoster*:</td><td><select class="interfaceforms" name="hoster1"><option value="">Please select</option><?php echo option_category('type = 3 order by name asc');?></select></td></tr>
        <tr><td><br><a href="#" onclick="document.getElementById('addhoster2').style.display='';return false;">&gt;Add hoster<</a></td><td>Part 1: <input class="interfaceforms" name="part1_1"> link or embed code<br>Part 2: <input class="interfaceforms" name="part1_2"><br>Part 3: <input class="interfaceforms" name="part1_3"><br></td></tr>
        </tbody></table>
        <table id="addhoster2" style="display:none;"><tbody><tr><td width="120">Hoster*:</td><td><select class="interfaceforms" name="hoster2"><option value="">Please select</option><?php echo option_category('type = 3 order by name asc');?></select></td></tr>
        <tr><td><br><a href="#" onclick="document.getElementById('addhoster3').style.display='';return false;">&gt;Add hoster<</a></td><td>Part 1: <input class="interfaceforms" name="part2_1"> link or embed code<br>Part 2: <input class="interfaceforms" name="part2_2"><br>Part 3: <input class="interfaceforms" name="part2_3"><br></td></tr>
        </tbody></table>
        <table id="addhoster3" style="display:none;"><tbody><tr><td width="120">Hoster*:</td><td><select class="interfaceforms" name="hoster3"><option value="">Please select</option><?php echo option_category('type = 3 order by name asc');?></select></td></tr>
        <tr><td><br><a href="#" onclick="document.getElementById('addhoster4').style.display='';return false;">&gt;Add hoster<</a></td><td>Part 1: <input class="interfaceforms" name="part3_1"> link or embed code<br>Part 2: <input class="interfaceforms" name="part3_2"><br>Part 3: <input class="interfaceforms" name="part3_3"><br></td></tr>
        </tbody></table>
        <table id="addhoster4" style="display:none;"><tbody><tr><td width="120">Hoster*:</td><td><select class="interfaceforms" name="hoster4"><option value="">Please select</option><?php echo option_category('type = 3 order by name asc');?></select></td></tr>
        <tr><td><br><a href="#" onclick="document.getElementById('addhoster5').style.display='';return false;">&gt;Add hoster<</a></td><td>Part 1: <input class="interfaceforms" name="part4_1"> link or embed code<br>Part 2: <input class="interfaceforms" name="part4_2"><br>Part 3: <input class="interfaceforms" name="part4_3"><br></td></tr>
        </tbody></table>
        <table id="addhoster5" style="display:none;"><tbody><tr><td width="120">Hoster*:</td><td><select class="interfaceforms" name="hoster5"><option value="">Please select</option><?php echo option_category('type = 3 order by name asc');?></select></td></tr>
        <tr><td><br><a href="#" onclick="document.getElementById('addhoster6').style.display='';return false;">&gt;Add hoster<</a></td><td>Part 1: <input class="interfaceforms" name="part5_1"> link or embed code<br>Part 2: <input class="interfaceforms" name="part5_2"><br>Part 3: <input class="interfaceforms" name="part5_3"><br></td></tr>
        </tbody></table>

        <table><tbody>
        <tr><td width="120">Picture Quality:</td><td><select class="interfaceforms" type="checkbox" name="picturequality"><option value="0">Unknown</option><option value="1">Cam</option><option value="2">TS</option><option value="3">TC</option><option value="4">Screener</option><option value="5">DVDRip/BDRip</option></select></td></tr>
        <tr><td width="120">IMDB ID:</td><td><input name="imdb" type="text" placeholder="http://www.imdb.com/title/ttXXXXXXX/"/> (http://www.imdb.com/title/ttXXXXXXX/)</td></tr>
        <tr><td width="120">Genre1:</td><td><div id="genre_nonxxx" style="display: block;"><select class="interfaceforms" name="genre1"><option value="">Please select</option><?php echo option_categories('type = 1 order by name asc');?></select></div>
        <div id="genre_xxx" style="display: none;"><select class="interfaceforms" name="genre1xxx"><option value="">Please select</option><?php echo option_categories('type = 2 order by name asc');?></select></div></td></tr>
        <tr><td width="120">Genre2:</td><td><div id="genre_nonxxx2" style="display: block;"><select class="interfaceforms" name="genre2"><option value="">Please select</option><?php echo option_categories('type = 1 order by name asc');?></select></div>
        <div id="genre_xxx2" style="display: none;"><select class="interfaceforms" name="genre2xxx"><option value="">Please select</option><?php echo option_categories('type = 2 order by name asc');?></select></div></td></tr>
          <tr><td width="120">Genre3:</td><td><div id="genre_nonxxx3" style="display: block;"><select class="interfaceforms" name="genre3"><option value="">Please select</option><?php echo option_categories('type = 1 order by name asc');?></select></div>
        <div id="genre_xxx3" style="display: none;"><select class="interfaceforms" name="genre3xxx"><option value="">Please select</option><?php echo option_categories('type = 2 order by name asc');?></select></div></td></tr>        
        </tbody></table>
        <table id="moredetails" style="display:none"><tbody>
        <tr><td width="120">Cover:</td><td>
        <input class="interfaceshortforms" type="radio" name="thumbnail" value="link" onchange="changeThumbnail()"> Link &nbsp;&nbsp;&nbsp; <input class="interfaceshortforms" type="radio" name="thumbnail" value="upload" onchange="changeThumbnail()" checked> Upload (only .jpg allowed)
        <div id="thumb_upload"><input class="interfaceforms" type="file" name="thumbnailfile"></div>
        <div id="thumb_link" style="display: none;"><input class="interfaceforms" name="thumbnaillink" placeholder="Cover Link"></div></td></tr>
        <tr><td width="120">Description:</td><td>
        <textarea name="description" cols="40" rows="6" maxlength="1000"></textarea></td></tr>
        <tr><td width="120">Duration:</td><td>
        <input name="duration" type="text" placeholder="120 minutes"/></td></tr>
        <tr><td width="120">Year:</td><td>
        <input name="year" type="text" placeholder="2014"/></td></tr>
        <tr><td width="120">Country:</td><td>
        <input name="country" type="text" placeholder="USA"/></td></tr>
        <tr><td width="120">Director:</td><td>
        <input name="director" type="text" /></td></tr>
        <tr><td width="120">Actors:</td><td>
        <input name="actors" type="text" /></td></tr>
        </tbody></table>
        <table><tbody>
        <tr><td width="120"><a href="#" onclick="document.getElementById('moredetails').style.display='';return false;">Add more details!</a></td><td>
        <input type="hidden" name="user_post" id="user_post" value="<?php echo $session;?>"/>
        <input type="hidden" name="uid" id="uid" value="<?php echo $next;?>"/>
        <input type="hidden" name="uid2" id="uid2" value="<?php echo $next2;?>"/>
        <input type="hidden" name="uid3" id="uid3" value="<?php echo $next3;?>"/>
        <input type="hidden" name="uid4" id="uid4" value="<?php echo $next4;?>"/>
        <input type="hidden" name="uid5" id="uid5" value="<?php echo $next5;?>"/>

        <button name="submit" class="submit" id="submit" type="submit">Add movie!</button> <a href="/page/add-tvshow">click here if you want to add a tvshow</a></td></tr></tbody></table>

</form>
</div>
<?php
} else {header("location:/page/login");}
?>

<?php include(THEMES.'footer.php');?>