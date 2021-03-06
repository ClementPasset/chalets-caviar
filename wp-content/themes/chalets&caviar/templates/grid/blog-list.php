<div class="main-container">

	<?php

	// Category Description
	if (is_category()) {
		get_template_part('templates/grid/category', 'description');
	}

	if (chalcav_is_rent_url()) {
		echo '<h1 class="listing-title">Nos chalets à louer</h1>';
	} elseif (chalcav_is_buy_url()) {
		echo '<h1 class="listing-title">Nos chalets à vendre</h1>';
	} else {
		echo '<h1 class="listing-title">Tous nos chalets</h1>';
	}

	// Blog Grid
	echo '<ul class="blog-grid">';

	if (have_posts()) :

		// Loop Start
		while (have_posts()) :

			the_post();

			// if is preview (boat post)
			if (!(ashe_is_preview() && get_the_ID() == 19)) :

				$post_class = (true == ashe_options('blog_page_show_dropcaps')) ? 'blog-post clear-fix ashe-dropcaps' : 'blog-post clear-fix';

				echo '<li>';

	?>
				<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>

					<div class="post-media">
						<a href="<?php echo esc_url(get_permalink()); ?>"></a>
						<?php the_post_thumbnail('ashe-list-thumbnail'); ?>
					</div>

					<div class="post-content-wrap">
						<header class="post-header">

							<?php

							$category_list = get_the_category_list(',&nbsp;&nbsp;');

							if (ashe_options('blog_page_show_categories') === true && $category_list) {
								echo '<div class="post-categories">' . $category_list . ' </div>';
							}

							?>

							<?php if (get_the_title()) : ?>
								<h2 class="post-title">
									<a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a>
								</h2>
							<?php endif; ?>

							<?php if (ashe_options('blog_page_show_author') || ashe_options('blog_page_show_date') || ashe_options('blog_page_show_comments')) : ?>
								<div class="post-meta clear-fix">

									<?php if (ashe_options('blog_page_show_author') === true) : ?>
										<span class="post-author"><?php the_author_posts_link(); ?></span>
									<?php endif; ?>

									<?php if (ashe_options('blog_page_show_date') === true) : ?>
										<span class="meta-sep">/</span>
										<span class="post-date">Bien publié le <?php the_time(get_option('date_format')); ?></span>
									<?php endif; ?>

									<?php if (ashe_options('blog_page_show_comments') === true && comments_open()) : ?>
										<span class="meta-sep">/</span>
										<?php comments_popup_link(esc_html__('0 Comments', 'ashe'), esc_html__('1 Comment', 'ashe'), '% ' . esc_html__('Comments', 'ashe'), 'post-comments'); ?>
									<?php endif; ?>

								</div>
							<?php endif; ?>

						</header>

						<?php if (ashe_options('blog_page_post_description') !== 'none') : ?>

							<div class="post-content">
								<?php
								$type = get_field('property_type');
								$price = get_field('property_price');
								$options = [
									'property_bedrooms' => 'fas fa-bed',
									'property_bathrooms' => 'fas fa-bath',
									'property_surface' => 'fas fa-expand-arrows-alt'
								];
								$capacity = get_field('property_capacity');
								$options_text = array_reduce(array_keys($options), function ($carry, $item) use ($options) {
									if (get_field($item) !== null) {
										return $carry . '<span><i class="' . $options[$item] . '"></i> ' . get_field($item) . ($item === 'property_surface' ? 'm²' : '') . '</span>&nbsp;&nbsp;&nbsp;&nbsp;';
									}
									return $carry;
								});
								if ($type === 'rent') {
									$price_text = 'Louer : ' . number_format(get_field('property_price'), 0, ',', ' ') . ' €/semaine';
								} elseif ($type === 'buy') {
									$price_text = 'Acheter : ' . number_format(get_field('property_price'), 0, ',', ' ') . ' €';
								}
								?>
								<div class="card">
									<div class="card__price"><?= $price_text ?></div>
									<div class="card__options"><?= $options_text ?></div>
									<?php if ($capacity) : ?>
										<div class="card__capacity">De <?= $capacity ?> personnes.</div>
									<?php endif ?>
								</div>
							</div>

						<?php endif; ?>

						<div class="read-more">
							<a href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Voir le bien', 'ashe'); ?></a>
						</div>

						<?php ashe_post_sharing(); ?>

					</div>

				</article>

		<?php

				echo '</li>';

			endif;

		endwhile; // Loop End

	else :

		?>

		<div class="no-result-found">
			<h3><?php esc_html_e('Nothing Found!', 'ashe'); ?></h3>
			<p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ashe'); ?></p>
			<div class="ashe-widget widget_search">
				<?php get_search_form(); ?>
			</div>

		</div>

	<?php

	endif; // have_posts()

	echo '</ul>';

	?>

	<?php get_template_part('templates/grid/blog', 'pagination'); ?>

</div><!-- .main-container -->