<?php

$args = array(
    category_in => 'day-of-action-september-2016'
) ;
$events = tribe_get_events( $args );

?>

<div class="sw-events-grid">

    <?php
    foreach ($events as $event ) { ?>

        <div class="debug">
            <?php
            $event_meta = get_post_meta($event->ID) ;
            // var_dump($event_meta) ;

            // get the venue metadata
            $venue_id = $event->_EventVenueID ;
            $venue_meta = get_post_meta($venue_id) ;
            // var_dump($venue_meta) ;
            ?>
        </div>


        <div class="event-card">

            <header>
                <?php   if (  !empty($venue_meta['_VenueCity']) ) {   ?>
                    <div class="city">
                        <h2><?php  echo $venue_meta['_VenueCity'][0]  ?></h2>
                    </div>
                <?php }  ?>
            </header>

	    <?php 
	    /*
	     * For our initial application we won't be using the post title.
	     * But we will probably want to use it if we repurpose the plugin
	     * <h3><?php echo $event->post_title ?></h3>
	    */
	    ?>

            <div class="event-details">

                <?php    if ( !empty($venue_meta['_VenueVenue'][0]) ) {  ?>
                    <div class="venue">
                        <div class="event-url">
                            <h3>
                                <?php echo $venue_meta['_VenueVenue'][0]  ?>
                            </h3>
                        </div>
                    </div>
                <?php  } ?>

		<div class="event-start">
		    <p>From <?php  echo tribe_get_start_date( $event->ID, false, "g:i a" ); ?></p>	    
		</div>

		<div class="event-link">
		    <p><a href=" <?php    the_permalink($event->ID)   ?>">
			More Information
		    </a>
		    </p>                   		    
		</div>

	    </div>
	    
	

	</div> <!-- ENDS .event-card -->

    <?php }  ?>



</div>  <!-- ENDS .sw-events-grid -->
