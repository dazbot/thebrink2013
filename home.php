<?php 

// Get the header template.
get_header();

?>

<div class="post-content min-height home-content">

    <div class="container full-width">
        
        <div class="row banner">
            <div class="col-sm-12">
                <img src="<?php bloginfo('template_directory'); ?>/images/TheBrinkWordPressHeader120.jpg" alt="The Brink banner" class="full-width">
                <p>An illustrated web serial about witchcraft, war, and the end of the world.</p>
            </div>
        </div>
        
        <?php if ($paged < 2) : ?> 
            <div class="row">
                <div class="col-sm-6">
                    <?php write_home_episode('ASC', 'first'); ?>
                </div>
                <div class="col-sm-6">
                    <?php write_home_episode('DESC', 'most recent'); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php
        
        $columnNumber = 0;
        
        if (have_posts()) : 
            echo '<h2>Previous episodes</h2>';
            while (have_posts()) :
                the_post();
        
                // Increment the column number and write opening/closing divs if necessary.
                $columnNumber++;
                if ($columnNumber > 4) {
                    echo '</div>';
                    $columnNumber = 1;
                }
                if ($columnNumber == 1) {
                    echo '<div class="row">';
                }
                
                // Output the episode mosaic.
                echo '<div class="col-sm-3">';
                write_mosaic(
                         get_permalink($post->ID),
                         get_the_title(), 
                         mysql2date("j M Y", get_the_date()),
                         $post->post_excerpt,
                         get_the_post_thumbnail($post->ID, 'full')
                         );
                echo '</div>';
                
            endwhile;
            echo '</div>';
        endif;
        
        wp_pagenavi();
        
        ?>
            
    </div>

</div>

<?php

    // Show the footer.
    get_footer(); 

?>