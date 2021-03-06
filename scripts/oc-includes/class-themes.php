<?php
/**
 * Theme, template, and pagination functions.
 *
 * @package OcimPress
 * @subpackage Theme
 */

require_once( BASEPATH . OCINC . '/pagination.php' );
require_once( BASEPATH . OCINC . '/function.php' );
    $db     = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $oc_home               = new MyPagina(1000);
    $oc_home->number_links = 4;
    $oc_home->sql          = "SELECT * FROM oc_posts where active = 1 and type NOT IN ('2') order by id desc";
    $oc_home_result        = $oc_home->get_page_result();

    $oc_random               = new MyPagina(1000);
    $oc_random->number_links = 4;
    $oc_random->sql          = "SELECT * FROM oc_posts where active = 1 and type NOT IN ('2') order by rand() desc";
    $oc_random_result        = $oc_random->get_page_result();

    $theme_category_query      = mysqli_query($db,"SELECT * FROM oc_terms where slug = '$id'") or die('Error: ' . mysqli_error($db));
    $theme_category_row        = mysqli_fetch_array($theme_category_query);
    $theme_categoryid          = $theme_category_row['id'];
if (mysqli_num_rows($theme_category_query) > 0) {
  if(!empty( $id ) ){
    $theme_category_query_posts  = mysqli_query($db,"SELECT * FROM oc_posts where active = 1 and type NOT IN ('2') and terms = '$theme_categoryid'") or die('Error: ' . mysqli_error($db));

    $oc_category               = new MyPagina(1000);
    $oc_category->number_links = 4;
    $oc_category->sql          = "SELECT * FROM oc_posts where active = 1 and type NOT IN ('2') and terms = '$theme_categoryid' order by id desc";
    $oc_category_result        = $oc_category->get_page_result();

  }
}
if( $do=='search' ){
    $oc_search                 = new MyPagina(1000);
    $oc_search->number_links   = 4;
    if(empty($id)) { 
        $oc_search->sql        = "SELECT * FROM oc_posts where active = 1 and type NOT IN ('2') and title = '$id' order by id desc";
    } else {
        $oc_search->sql        = "SELECT * FROM oc_posts where active = 1 and type NOT IN ('2') and (title like '%$id%' or description like '%$id%') order by id desc";
    }
    $oc_search_result          = $oc_search->get_page_result();
}

if( $do=='tag' ){
    $oc_tag_id            = permalink($id,' ');
  if(!empty( $oc_tag_id ) ){
    $oc_tag               = new MyPagina(1000);
    $oc_tag->number_links = 4;
    $oc_tag->sql          = "SELECT * FROM oc_posts where active = 1 and type NOT IN ('2') and tags like '%$oc_tag_id%' order by id desc";
    $oc_tag_result        = $oc_tag->get_page_result();

   }
}

if( $do=='author' ){

    $oc_author               = new MyPagina(1000);
    $oc_author->number_links = 4;
    $oc_author->sql          = "SELECT * FROM oc_users where active = 1 order by id desc";
    $oc_author_result        = $oc_author->get_page_result();

    $oc_authors               = new MyPagina(1000);
    $oc_authors->number_links = 4;
    $oc_authors->sql          = "SELECT * FROM oc_posts where active = 1 and type NOT IN ('2') and user = '$id' order by id desc";
    $oc_authors_result        = $oc_authors->get_page_result();

    $class_users_query      = get_mysqli("oc_users where username = '$id'");
    $class_users_row        = mysqli_fetch_array($class_users_query);
    $class_usersid          = $class_users_row['username'];

if( !empty($class_usersid) ){
    $oc_users               = new MyPagina(1000);
    $oc_users->number_links = 4;
    $oc_users->sql          = "SELECT * FROM oc_posts where active = 1 and type NOT IN ('2') and user = '$class_usersid' order by id desc";
    $oc_users_result        = $oc_users->get_page_result();
}
}
mysqli_close($db);