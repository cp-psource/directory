<?php

$options = $this->get_options( 'general' );

?>

<script type="text/javascript" src="<?php echo $this->plugin_url . 'ui-front/js/ui-front.js'; ?>" >
</script>

<?php if ( isset( $_POST['_wpnonce'] ) ): ?>
<br clear="all" />
<div id="dr-message-error">
	<?php _e( "Nachricht senden fehlgeschlagen: Du hast nicht alle erforderlichen Felder im Kontaktformular korrekt ausgefüllt!", $this->text_domain ); ?>
</div>
<br clear="all" />
<?php endif; ?>

<?php if ( isset( $_GET['sent'] ) ):

if(1 == $_GET['sent'] ): ?>
<br clear="all" />
<div id="dr-message">
	<?php _e( 'Nachricht wird gesendet!', $this->text_domain ); ?>
</div>
<br clear="all" />
<?php else: ?>
<div id="dr-message-error">
	<?php _e( 'E-Mail-Dienst antwortet nicht!', $this->text_domain ); ?>
</div>
<?php
endif;

endif; ?>

<?php if(has_post_thumbnail() ) the_post_thumbnail( array( 450, 300 ), array( 'class' => 'alignleft' ) ); ?>

<div class="entry-meta">
	<?php the_dr_posted_on(); ?>
	<?php do_action('sr_avg_rating'); ?><br />
	<p>
		<span class="comments">
			<?php comments_popup_link(
			__( 'Keine Bewertungen &#187;', DR_TEXT_DOMAIN ),
			__( '1 Bewertung &#187;', DR_TEXT_DOMAIN ),
			__( '% Bewertungen &#187;', DR_TEXT_DOMAIN ),
			'',
			__( 'Bewertungen deaktiviert;', DR_TEXT_DOMAIN )
			); ?>
		</span>
	</p>
	<?php the_dr_posted_in(); ?>

	<?php if ( !is_user_logged_in() ) : ?>
	<?php echo '<p class="must-log-in">' .  sprintf( __( 'Du musst <a href="%s">angemeldet</a> sein, um Einträge zu bewerten.', DR_TEXT_DOMAIN), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post->ID ) ) ) ) . '</p>'; ?>
	<?php else: ?>
	<?php do_action('sr_rate_this'); ?>
	<?php endif; ?>
</div>

<div class="clear"></div>

<?php if( empty( $options['disable_contact_form'] ) ): ?>

<form method="post" action="#" class="contact-user-btn action-form" id="action-form">
	<input type="submit" name="contact_user" value="<?php _e('Kontaktieren', $this->text_domain ); ?>" onclick="dr_listings.toggle_contact_form(); return false;" />
</form>

<div class="clear"></div>

<form method="post" action="#" class="standard-form base dr-contact-form" id="confirm-form">
	<?php
	global $current_user;

	$name   = ( isset( $current_user->display_name ) && '' != $current_user->display_name ) ? $current_user->display_name :
	( ( isset( $current_user->first_name ) && '' != $current_user->first_name ) ? $current_user->first_name : '' );
	$email  = ( isset( $current_user->user_email ) && '' != $current_user->user_email ) ? $current_user->user_email : '';
	?>
	<div class="editfield">
		<label for="name"><?php _e( 'Name', $this->text_domain ); ?> (<?php _e( 'erforderlich', $this->text_domain ); ?>)</label>
		<input type="text" id="name" name ="name" value="<?php echo ( isset( $_POST['name'] ) ) ? $_POST['name'] : $name; ?>" />
		<p class="description"><?php _e( 'Gib hier Deinen vollständigen Namen ein.', $this->text_domain ); ?></p>
	</div>
	<div class="editfield">
		<label for="email"><?php _e( 'Email', $this->text_domain ); ?> (<?php _e( 'erforderlich', $this->text_domain ); ?>)</label>
		<input type="text" id="email" name ="email" value="<?php echo ( isset( $_POST['email'] ) ) ? $_POST['email'] : $email; ?>" />
		<p class="description"><?php _e( 'Gib hier eine gültige E-Mail-Adresse ein.', $this->text_domain ); ?></p>
	</div>
	<div class="editfield">
		<label for="subject"><?php _e( 'Betreff', $this->text_domain ); ?> (<?php _e( 'erforderlich', $this->text_domain ); ?>)</label>
		<input type="text" id="subject" name ="subject" value="<?php echo ( isset( $_POST['subject'] ) ) ? $_POST['subject'] : ''; ?>" />
		<p class="description"><?php _e( 'Gib hier den Betreff Deiner Anfrage ein.', $this->text_domain ); ?></p>
	</div>
	<div class="editfield">
		<label for="message"><?php _e( 'Nachricht', $this->text_domain ); ?> (<?php _e( 'erforderlich', $this->text_domain ); ?>)</label>
		<textarea id="message" name="message"><?php echo ( isset( $_POST['message'] ) ) ? $_POST['message'] : ''; ?></textarea>
		<p class="description"><?php _e( 'Gib hier den Inhalt Deiner Anfrage ein.', $this->text_domain ); ?></p>
	</div>

	<div class="editfield">
		<label for="dr_random_value"><?php _e( 'Sicherheitsbild', $this->text_domain ); ?> (<?php _e( 'erforderlich', $this->text_domain ); ?>)</label>
			<img class="captcha" src="<?php echo admin_url('admin-ajax.php?action=dr-captcha');?>" />
		<input type="text" id="dr_random_value" name ="dr_random_value" value="" size="8" />
		<p class="description"><?php _e( 'Gib die Zeichen aus dem Bild ein.', $this->text_domain ); ?></p>
	</div>

	<div class="submit">
		<p>
			<?php wp_nonce_field( 'send_message' ); ?>
			<input type="submit" class="button confirm" value="<?php _e( 'Senden', $this->text_domain ); ?>" name="contact_form_send" />
			<input type="submit" class="button cancel"  value="<?php _e( 'Abbrechen', $this->text_domain ); ?>" onclick="dr_listings.cancel_contact_form(); return false;" />
		</p>
	</div>

</form>

<?php endif; ?>

<div class="clear"></div>

<?php
//Note that $content is prefilled with the usual expanded the_content from WP by the plugin, we're just wrapping it with extra meta.
echo $content;
?>
<div class="clear"></div>
<div class="dr-custom-block">
	<?php echo do_shortcode('[dr_custom_fields]'); ?>
</div>

<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>

<div id="entry-author-info">
	<div id="author-avatar">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), 60 ); ?>
	</div><!-- #author-avatar -->
	<div id="author-description">
		<h2><?php printf( esc_attr__( 'Über %s', DR_TEXT_DOMAIN ), get_the_author() ); ?></h2>
		<?php the_author_meta( 'description' ); ?>
		<div id="author-link">
			<a href="<?php echo get_author_directory_url( get_the_author_meta( 'ID' ) ); ?>">
				<?php printf( __( 'Alle Einträge von %s <span class="meta-nav">&rarr;</span>', DR_TEXT_DOMAIN ), get_the_author() ); ?>
			</a>
		</div><!-- #author-link    -->
	</div><!-- #author-description -->
</div><!-- #entry-author-info -->
<?php endif; ?>
