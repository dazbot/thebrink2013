<?php 

// Get the header template.
get_header();

?>

<div class="post-content min-height">

    <div class="container full-width">
        
        <div class="row">
            <img src="<?php bloginfo('template_directory'); ?>/images/TheBrinkWordPressHeader120.jpg" alt="The Brink banner" class="full-width">
        </div>
        
        <div class="row banner">
            <div class="col-sm-12">
                <p>An illustrated web serial about witchcraft, war, and the end of the world.</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-6">
                <?php writeHomeEpisode('ASC', 'first'); ?>
            </div>
            <div class="col-sm-6">
                <?php writeHomeEpisode('DESC', 'most recent'); ?>
            </div>
        </div>
        
    </div>

</div>

<?php

    // Show the footer.
    get_footer(); 

?>