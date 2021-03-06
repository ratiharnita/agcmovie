<?php
//include PHP HOOKS Class
include_once "phphooks.class.php";

//create instance of class
$hook = new phphooks ( );
$plugin_admin = $hook->get_plugins_header ();
	$active_plugins = numplugin ( "action = 1" );

$queryplugin  = "oc_plugins WHERE action = 1";
$resultplugin = get_mysqli($queryplugin);

	$whileplugin   = array();
while($row = $resultplugin->fetch_array()){
	$whileplugin[] = $row;
}
	$plugins = array();
foreach ( $whileplugin as $result_plugin )
	$plugins [] = $result_plugin ['filename'];

//unset means load all plugins in the plugin fold. set it, just load the plugins in this array.
$hook->active_plugins = $plugins;

//set multiple hooks to which plugin developers can assign functions
$hook->set_hooks ( array ('admin_title', 'admin_notices', 'admin_head', 'admin_menu', 'admin_footer', 'init', 'plugins_loaded', 'widget', 'theme_head', 'theme_footer', 'admin_post_options', 'add_shortcode', 'admin_create_table', 'theme_header', 'theme_footer' ) );

//load plugins from folder, if no argument is supplied, a 'plugins/' constant will be used
//trailing slash at the end is REQUIRED!
//this method will load all *.plugin.php files from given directory, INCLUDING subdirectories
	if ($active_plugins < 1) 
        return false;
        else
        $hook->load_plugins ();
        
//now, this is a workaround because plugins, when included, can't access $hook variable, so we
//as developers have to basically redefine functions which can be called from plugin files
function add_hook($tag, $function, $priority = 10) {
	global $hook;
	$hook->add_hook ( $tag, $function, $priority );
}

//same as above
function register_plugin($plugin_id, $data) {
	global $hook;
	$hook->register_plugin ( $plugin_id, $data );
}
     if ($hook->hook_exist ( 'init' )) {
	$hook->execute_hook ( 'init' );
     }
?>