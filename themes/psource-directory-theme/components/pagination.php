
<?php if ( is_single() ): ?><!-- start pagination -->

	<div id="post-navigator-single">
		<div class="alignleft"><?php previous_post_link('&laquo;%link') ?></div>
		<div class="alignright"><?php next_post_link('%link&raquo;') ?></div>
	</div>

<?php elseif ( is_page() ): ?>

	<div id="post-navigator">
		<?php link_pages(__( 'Seiten', THEME_TEXT_DOMAIN ), '', __( 'Anzahl', THEME_TEXT_DOMAIN )); ?>
	</div>

<?php elseif ( is_tag() ): ?>

	<div id="post-navigator">
		<div class="alignleft"><?php next_posts_link( __( '&laquo; Vorherige Einträge', THEME_TEXT_DOMAIN ) ) ?></div>
		<div class="alignright"><?php previous_posts_link( __( 'Nächste Einträge &raquo;', THEME_TEXT_DOMAIN ) ) ?></div>
	</div>

<?php elseif ( is_category() || is_archive() ): ?>

	<div id="post-navigator">
		<div class="alignleft"><?php next_posts_link( __( '&laquo; Vorherige Einträge', THEME_TEXT_DOMAIN ) ) ?></div>
		<div class="alignright"><?php previous_posts_link( __( 'Nächste Einträge &raquo;', THEME_TEXT_DOMAIN ) ) ?></div>
	</div>

<?php else: ?>

	<div id="post-navigator">
		<div class="alignleft"><?php next_posts_link( __( '&laquo; Vorherige Einträge', THEME_TEXT_DOMAIN ) ) ?></div>
		<div class="alignright"><?php previous_posts_link( __( 'Nächste Einträge &raquo;', THEME_TEXT_DOMAIN ) ) ?></div>
	</div>

<?php endif; ?><!-- end pagination -->
