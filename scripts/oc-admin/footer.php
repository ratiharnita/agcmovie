            <div class="row">              
<div id="footer-thankyou" class="col-lg-12"><span class="pull-left">Thank you for creating with <a target="_blank" href="http://ocimpress.com/">OcimPress</a>.</span><span class="pull-right">Version 1.0</span></div>
            </div>
         </div><!-- /#page-wrapper -->
    </div><!-- /#wrapper -->
    <!-- jQuery Version 1.11.0 -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <?php $hooks->do_action('admin_footer');?>
    <!-- Custom Theme JavaScript -->
    <script src="../oc-includes/js/admin.js"></script>
    <script>
    $('.btn').tooltip({
    animated: 'fade',
    placement: 'bottom',
    });
    $('.rel').tooltip({
    animated: 'fade',
    placement: 'bottom',
    });
    </script>
    <?php 
     if ($hook->hook_exist ( 'admin_footer' )) {
	$hook->execute_hook ( 'admin_footer' );
     }
    ?>
<?php ocim_footer(); ?>
</BODY>
</html>