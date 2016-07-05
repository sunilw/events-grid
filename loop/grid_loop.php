<?php

$args = array() ;
$events = tribe_get_events( $args );

?>

<div class="sw-events-grid">

    <?php
    foreach ($events as $event ) { ?>

        <div class="debug">
            <?php
            $event_meta = get_post_meta($event->ID) ;
            var_dump($event_meta) ;

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
                        <h4><?php  echo $venue_meta['_VenueCity'][0]  ?></h4>
                    </div>
                <?php }  ?>
            </header>

            <h3><?php echo $event->post_title ?></h3>

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
		    <p>Starts <?php  echo tribe_get_start_date( $post->ID, false, "g:i a" ); ?></p>		    
		</div>


                <?php    if ( !empty($event_meta['_EventURL'][0]) ) {  ?>
                    <div class="event-url">
                        <p>Event Page:  <a href="<?php  echo $event_meta['_EventURL'][0]  ;  ?>"><?php  echo $event_meta['_EventURL'][0]  ;  ?></a></p>
                    </div>
                <?php  } ?>

                <div class="event-excerpt">
                    <?php    echo $event->post_excerpt;  ?>
                </div>
            </div>

        </div> <!-- ENDS .event-card -->

    <?php }  ?>



</div>  <!-- ENDS .sw-events-grid -->
