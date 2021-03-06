<?php include('header.php'); 
if (mysqli_num_rows($postq) > 0) : ?>

<!-- Blog Post Content Column -->
        <div class="col-lg-8">

                <!-- Blog Post -->

                <div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">
                <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                        <a itemprop="url" href="<?php bloginfo('url');?>"><span itemprop="title">Home</span></a></span> / 
                        <?php if($post['type'] == 1): ?>
                                <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="<?php bloginfo('url');?>/category/<?php echo Categories($post['terms'],'slug');?>"><span itemprop="title"><?php echo Categories($post['terms'],'name');?></span></a></span> / 
                        <?php endif; ?>
                        <?php echo $post['title']; ?>
                </div> <!-- end breadcrumb -->

                <!-- Title -->
                <h1><?php echo $post['title']; ?></h1>

                <hr>

                <!-- Date/Time -->
                <p>
                        <span class="glyphicon glyphicon-user"></span> by <a href="<?php bloginfo('url');?>/author/<?php echo $post['user']; ?>"><?php echo $post['user']; ?></a> 
                        <span class="glyphicon glyphicon-time"></span> Posted on <?php echo date('M d, Y', strtotime($post['pubdate']));?>
                </p>

                <hr>

                <!-- Post Content -->
                <p><?php echo $post['description']; ?></p>

                <?php if( 'open' == $post['comment_status'] ) : ?>
                        <?php if ( comments_open() ) : ?>
                                <?php if ( comment_registration() ) : ?>
                                        <hr>
                                        <!-- Blog Comments -->
                                        <?php include('comments.php');?>
                                <?php endif; // comment_registration() ?>
                        <?php endif; // comments_open() ?>
                <?php endif; // comment_status ?>

        </div><!-- col-lg-8 -->

<?php include('sidebar.php');?>
<?php 
else:
header("location:/index.php?do=404");
endif;
include('footer.php');?>