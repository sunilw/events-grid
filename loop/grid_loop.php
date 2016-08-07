<?php

$args = array(
    //     category_in => 'day-of-action-september-2016'
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
	    
	    /*
	     * get the custom fields
	     */
	    $cfields = tribe_get_custom_fields() ; 
	    
            ?>

	    
        </div>

        <div class="event-card">
	    <?php global $post ;  ?>
	    <?php  
	    $event_fields = tribe_get_custom_fields($event->ID);
	    // var_dump($event_fields) ;	    
	    //var_dump($cfields) ;
	    ?>
	    
	    <!-- <h1><?phpecho $event->ID ;	?></h1> -->

            <header>
                <?php   if (  !empty($venue_meta['_VenueCity']) ) {   ?>
                    <div class="venue-city"><h2><?php  echo $venue_meta['_VenueCity'][0]  ?></h2></div>
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
			<header class="event-meta-header venue"><span>venue</span></header>
                        <div class="event-url">
                            <h3><?php echo $venue_meta['_VenueVenue'][0]  ?></h3>
                        </div>
                    </div>
                <?php  } ?>

		<?php 
		$organizer =  $cfields['event organizer'] ;
		if ( isset($organizer) ) {		?>

		<div class="organizer">
		    <h5>organizer:</h5>
		    <h2><?php  

			echo $cfields['event organizer'] ;
			?></h2>
		</div>

		<?php }  ?>

                <?php
                $event_start_time =  tribe_get_start_date( $event->ID, false, "g:i a" );
		$event_end_time =  tribe_get_end_date( $event->ID, false, "g:i a" );
		
                if ( isset($event_start_time) ) {   ?>
                    <div class="event-time">
			<header class="event-meta-header time"><span>time</span></header>
                        <p>
			    <span class="start"><?php  echo $event_start_time ?></span>			    
			    <?php  if ( isset($event_end_time) ) {   ?>
				<span class="end"> to <?php echo $event_end_time  ?></span>
				<?php }   ?>
			</p>			
                    </div>
                <?php }  ?>

		<?php  
		$fbpage =  $event_fields['event facebook page'] ;
		if (isset($fbpage))  { ?>
		    <div class="event-facebook-page">
			<p> <a href="<?php echo $fbpage  ?>" target="_blank"  >On facebook</a></p>
		    </div>
		<?php }  ?>

                <div class="event-link">
                    <p><a href=" <?php    the_permalink($event->ID)   ?>" class="btn btn-defaul">more information</a>
                    </p>
                </div>

            </div>

        </div> <!-- ENDS .event-card -->
    <?php }  ?>



</div>  <!-- ENDS .sw-events-grid -->
