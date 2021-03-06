<?php include(THEMES.'header.php');
   $confirm = isset($_GET['confirm'])?$_GET['confirm']:"";
if ($confirm == '1'){
header("location:/page/xxx");
   $username = 'ocim';
   $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
   setcookie("xxx", $username, time()+3600, '/', $domain, false);
}
   $hidexxx = isset($_GET['hidexxx'])?$_GET['hidexxx']:"";
if ($hidexxx == 'yes'){
header("location:/");
   $username = 'hidexxxs';
   $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
   setcookie("hidexxx", $username, time()+3600, '/', $domain, false);
}
?>
<div align="center" id="maincontent4">
    <br><br><br><br><b><h1>Please confirm you are 18 years or above before continuing. If you are not 18 please exit.</h1>
    <br><br><br><br>
    <form style="display:inline" method="post" action="/page/xxxcheck&confirm=1">
        <input type="submit" value="I'm 18+ years old!"">
    </form>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <form style="display:inline" method="get" action="/page/random">
        <input type="submit" value="Exit!">
    </form>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <form style="display:inline" method="post" action="/page/xxxcheck&hidexxx=yes">
        <input type="submit" value="Please hide the XXX area on this computer! (cookie based)">
    </form>
    <br><br><br>
    If you want to access this area, please be sure you have the cookies enabled. Please check your browser preference, if you canÂ´t access the XXX movies after clicking on the 18 year button.<br>Sometimes adblocker can make problems, too!    <br><br><br><br><br>
</b></div>
<?php include(THEMES.'footer.php');?>