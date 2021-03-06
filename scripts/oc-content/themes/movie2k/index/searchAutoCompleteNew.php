<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/oc-load.php');?>
<table border="1" cellspacing="0" cellpadding="2" width="300" style="font-size:12px;border-color:#000000; border-style:solid;"><tbody>
<?php 
if($id)
{

$sql_res = get_mysqli("oc_posts where (title like '%$id%' OR imdb like '%$id%') group by imdb order by id LIMIT 5");
while($row=mysqli_fetch_array($sql_res))
{
$title = $row['title'];
?>
    <tr onclick="window.location.href = '/index.php?do=search&id=<?php echo $title; ?>'" style="cursor: pointer">
        <td bgcolor="#ffffff" onmouseover="this.style.backgroundColor='#B4CFE5';" onmouseout="this.style.backgroundColor='';">
            <a href="/index.php?do=search&id=<?php echo $row['title']; ?>" style="color:#000000;font-family:Arial;"><?php echo $title; ?></a>
        </td>
    </tr>
<?php
}
mysqli_free_result($sql_res);
}
?>
</tbody></table>