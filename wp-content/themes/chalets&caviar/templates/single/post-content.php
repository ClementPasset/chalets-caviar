<?php $post_class = (true == ashe_options('blog_page_show_dropcaps')) ? 'blog-post ashe-dropcaps' : 'blog-post'; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>

	<?php

	if (have_posts()) :

		// Loop Start
		while (have_posts()) :

			the_post();

	?>



			<?php if (ashe_options('single_page_show_featured_image') === true) : ?>
				<div class="post-media">
					<?php the_post_thumbnail('ashe-full-thumbnail'); ?>
				</div>
			<?php endif; ?>

			<header class="post-header">

				<?php

				$category_list = get_the_category_list(',&nbsp;&nbsp;');
				if (ashe_options('single_page_show_categories') === true && $category_list) {
					echo '<div class="post-categories">' . $category_list . ' </div>';
				}

				?>

				<?php if (get_the_title()) : ?>
					<h1 class="post-title"><?php the_title(); ?></h1>
				<?php endif; ?>

				<?php if (ashe_options('single_page_show_date') || ashe_options('single_page_show_comments')) : ?>
					<div class="post-meta clear-fix">

						<?php if (ashe_options('single_page_show_date') === true) : ?>
							<span class="post-date"><?php the_time(get_option('date_format')); ?></span>
						<?php endif; ?>

						<span class="meta-sep">/</span>

						<?php
						if (ashe_post_sharing_check() && ashe_options('single_page_show_comments') === true) {
							comments_popup_link(esc_html__('0 Comments', 'ashe'), esc_html__('1 Comment', 'ashe'), '% ' . esc_html__('Comments', 'ashe'), 'post-comments');
						}
						?>

					</div>
				<?php endif; ?>

			</header>

			<?php
			$type = get_field('property_type');
			$price = number_format(get_field('property_price'), 0, ',', ' ');
			$price = $type ==='rent' ? $price . ' €/semaine' : $price . ' €';
			?>

			<div class="post-content">
				<?php if (is_singular()) : ?>
					<div class="single-card">
						<h2 class="card__title">Chalet à <?= $type === 'rent' ? 'louer' : 'vendre' ?> :</h2>

						<p class="card__element">Nombre de chambres : <?= get_field('property_bedrooms') ?></p>
						<?php if ($type === 'rent') : ?>
							<p class="card__element">Capacité : <?= get_field('property_capacity') ?> personnes. </p>
						<?php endif ?>
						<?php if ($type === 'buy') : ?>
							<p class="card__element">Superficie : <?= get_field('property_surface') ?>m². </p>
						<?php endif ?>
						<p class="card__element">Nombre de salle de bain : <?= get_field('property_bathrooms') ?></p>
						<p class="card__element">Prix : <?= $price ?></p>
<<<<<<< HEAD
						<a href="/index.php/nous-contacter/" alt="Nous contacter" class="wp-block-button__link">Nous contacter</a>
=======
						<a href="/index.php/nous-contacter/?id_chalet=<?= get_the_ID() ?>" alt="Nous contacter" class="wp-block-button__link">Nous contacter</a>
>>>>>>> 88b6c68 (Single des biens)
					</div>
				<?php else : ?>
					<?php the_content('') ?>
				<?php endif ?>
			</div>

			<footer class="post-footer">

				<?php

				// The Tags
				$tag_list = get_the_tag_list('<div class="post-tags">', '', '</div>');

				if ($tag_list) {
					echo '' . $tag_list;
				}

				?>

				<?php if (ashe_options('single_page_show_author') === true) : ?>
					<span class="post-author"><?php esc_html_e('By', 'ashe'); ?>&nbsp;<?php the_author_posts_link(); ?></span>
				<?php endif; ?>

				<?php

				if (ashe_post_sharing_check()) {
					ashe_post_sharing();
				} else if (ashe_options('single_page_show_comments') === true) {
					comments_popup_link(esc_html__('0 Comments', 'ashe'), esc_html__('1 Comment', 'ashe'), '% ' . esc_html__('Comments', 'ashe'), 'post-comments');
				}

				?>

			</footer>

	<?php

		endwhile; // Loop End
	endif; // have_posts()

	?>

</article>