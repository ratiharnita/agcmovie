<?php
define( 'OC_CONTENT_URL', 'oc-content');
define( 'OCINC', 'oc-includes' );
define( 'OC_ADMIN', 'oc-admin' );

require_once( BASEPATH . OCINC . '/admin.php' );
require_once( BASEPATH . OCINC . '/admin_bar.php' );
require_once( BASEPATH . OCINC . '/date.php' );
require_once( BASEPATH . OCINC . '/general-template.php' );
require_once( BASEPATH . OCINC . '/theme.php' );
require_once( BASEPATH . OCINC . '/load.php' );
require_once( BASEPATH . OCINC . '/comment-template.php' );
require_once( BASEPATH . OCINC . '/link-template.php' );
require_once( BASEPATH . OCINC . '/function.php' );
require_once( BASEPATH . OCINC . '/class-themes.php' );
require_once( BASEPATH . OCINC . '/post.php' );
require_once( BASEPATH . OCINC . '/xmlrpc.php' );
require_once( BASEPATH . OCINC . '/query.php' );
require_once( BASEPATH . OCINC . '/themehook.php' );
require_once( BASEPATH . OCINC . '/shortcodes.php' );
require_once( BASEPATH . OCINC . '/formatting.php' );
include_once( BASEPATH . OC_ADMIN. '/includes/init.php' );

function widget_shortcode($title = 'Recent Search', $div ='class="list-group"',$h2 = 'class="list-group-item active"'){
if( load_shortcode() ){
?>
                <div <?php echo $div;?>>
                    <h2 <?php echo $h2;?>><?php echo $title;?></h2>
                    <?php do_shortcode( load_shortcode() );?>
                </div>
<?php 
}
}