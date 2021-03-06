<?php     
include_once($_SERVER['DOCUMENT_ROOT'] . '/oc-load.php');

    $RAPQ  = get_mysqli("oc_posts WHERE active = 1 and type = 3 ORDER BY Rand()");
    $RAG = mysqli_fetch_array($RAPQ);
    $RAGH = $RAG['guid'];
if( mysqli_num_rows($RAPQ ) > 0 ) {
    header("location:/$RAGH");
}
?>