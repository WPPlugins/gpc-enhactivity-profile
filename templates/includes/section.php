<?php
/**
 * Template to show the section for the Latest Comments
 *
 * @uses int $number_of_items	The number of items to show in this activities section
 * 
 * <code>
 * <?php
	$number_of_items = 5;
 * ?>
 * </code>
 * 
 */
?>
<div class="bp-widget">
	<h4><?php echo bp_word_or_name( __( "Latest Comments"), __( "%s's Latest Comments"), true, false ) ?> <span><a href="<?php echo bp_displayed_user_domain() . BP_ACTIVITY_SLUG ?>"><?php _e( 'See All', 'buddypress' ) ?> &rarr;</a></span></h4>
	<?php if ( bp_has_activities( 'type=personal&action=new_blog_comment&max='.$number_of_items) ) : ?>
		<ul id="activity-list" class="activity-list item-list">
		<?php while ( bp_activities() ) : bp_the_activity(); ?>
			<li class="<?php bp_activity_css_class() ?>">
				<?php echo GpcEnhactivityProfile::custom_bp_activity_content() ?>
			</li>
		<?php endwhile; ?>
		</ul>
	<?php else: ?>
		<div id="message" class="info">
			<p><?php echo bp_word_or_name( __( "You haven't done any comment recently.", 'buddypress' ), __( "%s hasn't done any comment recently.", 'buddypress' ), true, false ) ?></p>
		</div>
	<?php endif;?>
</div>