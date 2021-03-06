<?php
if(!isset($_SESSION)) :
        session_start();
        ob_start();
endif;

if(!isset($_SESSION['user'])) :
        $session =  null;
else:
        $session = $_SESSION['user'];
endif;

function bloginfo($show){
        $db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = mysqli_query($db, "SELECT * FROM oc_options WHERE option_name = '$show'") or die (mysqli_error($db));
                while ($row = mysqli_fetch_array($result)) :
                        $output = $row["option_value"];   
                        echo "$output"; 
                endwhile; 
        mysqli_free_result($result);
        mysqli_close($db);
}
function get_bloginfo($value){
        $db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = mysqli_query($db, "SELECT * FROM oc_options WHERE option_name = '$value'") or die (mysqli_error($db));
                while ($row = mysqli_fetch_array($result)) : 
                        $output = $row["option_value"];   
                        return $output; 
                endwhile;  
        mysqli_free_result($result);
        mysqli_close($db);
}
function get_option($table, $value, $column = 'option_name', $result = 'option_value' ){
        $db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $select = "SELECT * FROM $table WHERE $column = '$value'";
        $result = mysqli_query($db, $select) or die (mysqli_error($db));
                while ($row = mysqli_fetch_array($result)) : 
                        $output = $row[$result];   
                        return $output; 
                endwhile; 
        mysqli_free_result($result);
        mysqli_close($db);
}
function get_plugin($show,$value){
        $db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $GET_ID = "SELECT * FROM oc_plugins WHERE filename = '$show'";
        $query  = mysqli_query($db, $GET_ID) or die (mysqli_error($db));
                while ($row = mysqli_fetch_array($query)) : 
                        $output = $row[$value];   
                        return $output; 
                endwhile; 
        mysqli_free_result($query);
        mysqli_close($db);
}
function get_load($column,$where,$value){
        $db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $select = "SELECT * FROM {$column} WHERE {$where}";
        $query  = mysqli_query($db, $select) or die (mysqli_error($db));
                while ($row = mysqli_fetch_array($query)) { 
                        $output = $row[$value];   
                        return $output; 
                } 
        mysqli_free_result($query);
        mysqli_close($db);
}
function get_widget($bef='',$aft='',$title='',$titleaft='',$classbody=''){
        $db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query  = "SELECT * FROM oc_options WHERE autoload='widget' and active = 1";
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
                while ($options = mysqli_fetch_array($result)) { 
                        $output = $bef.$title.$options['option_name'].$titleaft.'<div '.$classbody.'>'.$options['option_value'].'</div>'.$aft;   
                        echo "$output"; 
                } 
        mysqli_free_result($result);
        mysqli_close($db);
}
function get_widgets(){
        $db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $sidebar_ID = "SELECT * FROM oc_options WHERE autoload='widget' and active = 1";
        $result = mysqli_query($db, $sidebar_ID) or die (mysqli_error($db));
                while ($options = mysqli_fetch_array($result)) { 
                        $output = '<div class="list-group"><h2 class="list-group-item active">'.$options['option_name'].'</h2><div class="panel-body">'.$options['option_value'].'</div></div>';   
                        echo $output; 
                } 
        mysqli_free_result($result);
        mysqli_close($db);
}
function load_shortcode(){
        $db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $sidebar_ID = "SELECT * FROM oc_options WHERE autoload = 'shortcode' and active = 1";
        $result = mysqli_query($db, $sidebar_ID) or die (mysqli_error($db));
                while ($options = mysqli_fetch_array($result)) { 
                        $output = $options['option_value']; 
                        return $output; 
                } 
        mysqli_free_result($result);
        mysqli_close($db);
}

function get_mysqli($query){
        $db     = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $select = "SELECT * FROM {$query}";
        $result = mysqli_query($db,$select) or die('Error: ' . mysqli_error($db));
                return $result;
        mysqli_free_result($result);
        mysqli_close($db);
}
function get_mysqli_array($query){
        $db     = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $select = "SELECT * FROM {$query}";
        $query  = mysqli_query($db,$select) or die('Error: ' . mysqli_error($db));
        $row    = mysqli_fetch_array($query);
                        return $row;
        mysqli_free_result($query);
        mysqli_close($db);
}
function get_posts_array($query){
        $db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $select = "SELECT * FROM oc_posts {$query}";
        $query = mysqli_query($db,$select) or die('Error: ' . mysqli_error($db));
        $row = mysqli_fetch_array($query);
        return $row;
                mysqli_close($db);
}
function get_posts($query,$value){
        $db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $select = "SELECT * FROM oc_posts {$query}";
        $query = mysqli_query($db,$select) or die('Error: ' . mysqli_error($db));
        $row = mysqli_fetch_array($query);
        return $row[$value];
                mysqli_close($db);
}