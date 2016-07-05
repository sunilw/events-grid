<?php

$args = array() ;
$events = tribe_get_events( $args );

?>

<div class="sw-events-grid">

    <?php
    foreach ($events as $event ) { ?>

        <div class="debug">
            <?php //    var_dump(get_post_meta($event->ID))   ?>

            <?php

            $event_meta = get_post_meta($event->ID) ;

            // var_dump($event_meta) ;

            // get the venue metadata
            $venue_id = $event->_EventVenueID ;
            $venue = get_post_meta($venue_id) ;
            // var_dump($venue) ;
            ?>
        </div>


        <div class="event-card">
            <h3><?php echo $event->post_title  ?></h3>

            <div class="event-details">

                <div class="event-location">
                    <h4>City: <?php  echo $venue['_VenueCity'][0] ;  ?></h4>
                </div>

                <?php    if ( !empty($event_meta['_EventURL'][0]) ) {  ?>
                    <div class="event-url">
                        <p>Event Website:  <a href="<?php  echo $event_meta['_EventURL'][0]  ;  ?>"><?php  echo $event_meta['_EventURL'][0]  ;  ?></a></p>
                    </div>
                <?php  } ?>

                <div class="event-excerpt">
                    <?php    echo $event->post_excerpt;  ?>
                </div>
            </div>

        </div> <!-- ENDS .event-card -->

    <?php }  ?>



</div>  <!-- ENDS .sw-events-grid -->
