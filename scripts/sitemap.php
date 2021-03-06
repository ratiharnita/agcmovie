<?php 
require( dirname( __FILE__ ) . '/oc-load.php' );
            header("Content-Type: text/xml;charset=iso-8859-1");
            echo '<?xml version="1.0" encoding="UTF-8"?>
             <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

            echo '<url><loc>'.get_bloginfo('url').'/</loc><changefreq>daily</changefreq><priority>1.0</priority></url>';

            $query = get_mysqli("oc_posts WHERE active = 1 and type NOT IN ('2') ORDER BY id DESC LIMIT 100");
            while($row = mysqli_fetch_array($query)){
                $date = date('Y-m-d', strtotime($row['pubdate']));
                $link = get_bloginfo('url').'/'.$row['guid'];  
                echo '<url><loc>'.$link.'</loc><lastmod>'.$date.'</lastmod><changefreq>Monthly</changefreq><priority>0.8</priority></url>';
            }
            ?>
</urlset>