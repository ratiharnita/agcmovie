<?php include('header.php');?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Dashboard</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-white alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h3>Welcome to OcimPress!</h3>
                        <p>We’ve assembled some links to get you started:</p>
                    <div class="col-lg-4 col-md-4">
                        <h4>Get Started</h4>
                        <a class="button button-primary button-hero" href="/oc-admin/themes.php">Customize Your Site</a>
                        <p>or, <a href="plugins.php">activate your plugins</a></p>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <h4>Next Steps</h4>
                        <ul>
                        <li><span class="glyphicon glyphicon-pencil"></span> <a href="post-new.php" class="welcome-icon">Write your first blog post</a></li>
                        <li><span class="glyphicon glyphicon-plus"></span> <a href="post-new.php?post_type=page" class="welcome-icon">Add an About page</a></li>
                        <li><span class="glyphicon glyphicon-eye-open"></span> <a href="../" class="welcome-icon">View your site</a></li>
		        </ul>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <h4>More Actions</h4>
                        <ul>
                        <li><span class="glyphicon glyphicon-cog"></span> <a href="options-general.php" class="welcome-icon">Manage General Settings</a></li>
                        <li><span class="glyphicon glyphicon-comment"></span> <a href="options-discussion.php" class="welcome-icon">Turn comments on or off</a></li>
                        <li><span class="glyphicon glyphicon-book"></span> <a href="options-reading.php" class="welcome-icon">Reading settings</a></li>
		        </ul>                    </div>
                    </div>
                </div><!-- /.col-lg-12 -->

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo numpost("type NOT IN ('2')");?></div>
                                    <div>All Posts!</div>
                                </div>
                            </div>
                        </div>
                        <a href="edit.php?post_type=post">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo numcomment('comment_approved = 1');?></div>
                                    <div>New Comments!</div>
                                </div>
                            </div>
                        </div>
                        <a href="edit-comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo numusers('active = 1');?></div>
                                    <div>New Users!</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo numpost("active = 0 and type NOT IN ('2')");?></div>
                                    <div>Draft Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="/oc-admin/edit.php?post_type=post&post_status=draft">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

              <div class="col-sm-6">
               <div class="panel panel-primary">
                <div class="panel-heading">
                    <button type="button" class="close" data-toggle="collapse" data-target="#c-published-posts" aria-expanded="true" aria-controls="c-published-posts"><span class="glyphicon glyphicon-chevron-up"></span></button>
                    <h3 class="panel-title">Summary</h3>
                </div>
                <div class="panel-body panel-collapse collapse in" id="c-published-posts">
                   <h4>Recently Published</h4>
                   <ul id="published-posts">
        <?php 
	$indexpsql = get_mysqli("oc_posts WHERE type = 1 and active = 1 order by pubdate desc limit 5");
	while($row = mysqli_fetch_array($indexpsql)){?>
	           <li><span><?php echo date('M d Y, h:i a', strtotime($row['pubdate']));?></span>
                   <a href="<?php if(is_role()){?>post.php?post=<?php echo $row['id'];}else{echo '/'.$row['guid'];}?>"><?php echo $row['title'];?></a></li>
        <?php }?>
                  </ul>
                </div>
               </div>
<?php if(is_role()){?>
               <div class="panel panel-primary">
                <div class="panel-heading">
                    <button type="button" class="close" data-toggle="collapse" data-target="#latest-comments" aria-expanded="true" aria-controls="latest-comments"><span class="glyphicon glyphicon-chevron-up"></span></button>
                    <h3 class="panel-title">Comments</h3>
                </div>
                <div id="latest-comments" class="panel-collapse collapse in">
                  <div id="the-comment-list">
        <?php 
	$indexcsql = get_mysqli("oc_comments order by comment_ID desc limit 5");
	while($rowc = mysqli_fetch_array($indexcsql)){?>
		    <div class="comment comment-item">
                      <img alt="<?php echo $rowc['comment_author'];?>" src="<?php echo gravatar($rowc['comment_author_email']);?>" class="avatar avatar-50 photo avatar-default" height="50" width="50">
			
			<div class="dashboard-comment-wrap">
			<h4 class="comment-meta">From <cite class="comment-author"><a href="<?php echo $rowc['comment_author_url'];?>" rel="external nofollow" class="url"><?php echo $rowc['comment_author'];?></a></cite> on <a href="post.php?post=<?php echo $rowc['comment_post_ID'];?>"><?php echo get_posts("where id='".$rowc['comment_post_ID']."'",'title');?></a> <a target="_blank" class="comment-link" href="/<?php echo get_posts("where id='".$rowc['comment_post_ID']."'",'guid');?>">#</a> </h4>

			<blockquote><p><?php echo strip_tags(limit_word($rowc['comment_content'],25));?>...</p></blockquote>
			<p class="row-actions"><?php if(is_admin()){?><?php if($rowc['comment_approved']==0){?><span class="approve"><a href="edit-comments.php?id=<?php echo $rowc['comment_ID'];?>&action=approvecomment" title="Approve this comment">Approve</a></span><?php }else{?><span class="unapprove"><a href="edit-comments.php?id=<?php echo $rowc['comment_ID'];?>&action=unapprovecomment" title="Unapprove this comment">Unapprove</a></span><?php }?> | <a title="Reply to this comment" target="_blank" href="/<?php echo get_posts("where id='".$row['comment_post_ID']."'",'guid');?>">Reply</a> | <a href="comment.php?id=<?php echo $rowc['comment_ID'];?>" title="Edit comment">Edit</a><span class="spam"><?php if($rowc['comment_approved']==0){?> | <a href="edit-comments.php?id=<?php echo $rowc['comment_ID'];?>&action=deletecomment" title="Delete Permanently this comment">Delete Permanently</a></span><?php }?><?php }?></p>

			</div>
		</div>
        <?php }?>
                            <div class="panel-footer">
	                    <a href="edit-comments.php">All <span class="count">(<?php echo numcomment('comment_approved = 1');?>)</span></a> |
	                    <a href="edit-comments.php?comment_status=moderated">Pending <span class="count">(<?php echo numcomment("comment_approved = 0");?>)</span></a> |
	                    <a href="edit-comments.php?comment_status=approved">Approved <span class="count">(<?php echo numcomment("comment_approved = 1");?>)</span></a>          </div>
</div>
                </div>
               </div>
 <?php };?>
              </div>
             <div class="col-sm-6">

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <button type="button" class="close" data-toggle="collapse" data-target="#feed" aria-expanded="true" aria-controls="feed"><span class="glyphicon glyphicon-chevron-up"></span></button>
                            <h3 class="panel-title">OcimPress News</h3>
                        </div>
                        <div class="panel-body panel-collapse collapse in" id="feed">
                                <?php feedocimpress('http://feeds.feedburner.com/ocimpress');?>
                        </div><!-- panel-body -->
                    </div><!-- panel-primary -->

                </div><!-- col-sm-6 -->
            </div><!-- /.row -->

<?php include('footer.php');?>