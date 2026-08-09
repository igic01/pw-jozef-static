<?php
/**
 * Plugin Name: Paint & Wine Gallery Shortcode
 * Description: Renders tagged Media Library images with the [paint_wine_gallery] shortcode.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'paint_wine_gallery_register_media_tags' );
add_action( 'init', 'paint_wine_gallery_register_private_tag', 20 );
add_action( 'init', 'paint_wine_register_gallery_shortcode' );

function paint_wine_gallery_register_media_tags() {
	if ( taxonomy_exists( 'paint_wine_media_tag' ) ) {
		return;
	}

	register_taxonomy(
		'paint_wine_media_tag',
		array( 'attachment' ),
		array(
			'labels'                => array(
				'name'                       => 'Gallery Tags',
				'singular_name'              => 'Gallery Tag',
				'search_items'               => 'Search Gallery Tags',
				'popular_items'              => 'Popular Gallery Tags',
				'all_items'                  => 'All Gallery Tags',
				'edit_item'                  => 'Edit Gallery Tag',
				'update_item'                => 'Update Gallery Tag',
				'add_new_item'               => 'Add New Gallery Tag',
				'new_item_name'              => 'New Gallery Tag Name',
				'separate_items_with_commas' => 'Separate gallery tags with commas',
				'add_or_remove_items'        => 'Add or remove gallery tags',
				'choose_from_most_used'      => 'Choose from the most used gallery tags',
				'not_found'                  => 'No gallery tags found.',
				'menu_name'                  => 'Gallery Tags',
			),
			'public'                => false,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'show_in_quick_edit'    => true,
			'show_in_rest'          => true,
			'hierarchical'          => false,
			'rewrite'               => false,
			'query_var'             => false,
			'meta_box_cb'           => 'post_tags_meta_box',
			'update_count_callback' => '_update_generic_term_count',
		)
	);
}

function paint_wine_register_gallery_shortcode() {
	add_shortcode( 'paint_wine_gallery', 'paint_wine_render_gallery_shortcode' );
}

function paint_wine_gallery_register_private_tag() {
	if ( ! taxonomy_exists( 'paint_wine_media_tag' ) || term_exists( 'private', 'paint_wine_media_tag' ) ) {
		return;
	}

	wp_insert_term(
		'Private',
		'paint_wine_media_tag',
		array(
			'slug' => 'private',
		)
	);
}

function paint_wine_render_gallery_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'title'         => 'Galerija',
			'tag'           => '',
			'tags'          => '',
			'all_label'     => 'Sve',
			'show_filters'  => 'yes',
			'limit'         => 48,
			'initial'       => 12,
			'batch'         => 12,
			'size'          => 'large',
			'orderby'       => 'date',
			'order'         => 'DESC',
			'layout'        => 'mixed',
			'empty_message' => 'Nema fotografija za odabranu kategoriju.',
			'load_more'     => 'Ucitaj jos',
		),
		$atts,
		'paint_wine_gallery'
	);

	$requested_tag_slugs = paint_wine_gallery_parse_tag_slugs( $atts['tag'], $atts['tags'] );
	$tag_slugs           = $requested_tag_slugs;
	$private_tag_slugs   = paint_wine_gallery_get_private_tag_slugs();
	$limit         = min( 120, max( 1, absint( $atts['limit'] ) ) );
	$initial       = min( $limit, max( 1, absint( $atts['initial'] ) ) );
	$batch         = min( $limit, max( 1, absint( $atts['batch'] ) ) );
	$order         = 'ASC' === strtoupper( $atts['order'] ) ? 'ASC' : 'DESC';
	$orderby       = sanitize_key( $atts['orderby'] );
	$layout        = sanitize_key( $atts['layout'] );
	$show_filters  = 'yes' === strtolower( $atts['show_filters'] );
	$valid_orderby = array( 'date', 'title', 'menu_order', 'modified', 'rand' );

	if ( ! in_array( $orderby, $valid_orderby, true ) ) {
		$orderby = 'date';
	}

	$query_args = array(
		'post_type'              => 'attachment',
		'post_status'            => 'inherit',
		'post_mime_type'         => 'image',
		'posts_per_page'         => $limit,
		'orderby'                => $orderby,
		'order'                  => $order,
		'no_found_rows'          => true,
		'update_post_meta_cache' => true,
		'update_post_term_cache' => true,
	);

	$excluded_attachment_ids = paint_wine_gallery_get_excluded_attachment_ids();

	if ( ! empty( $excluded_attachment_ids ) ) {
		$query_args['post__not_in'] = $excluded_attachment_ids;
	}

	if ( ! empty( $tag_slugs ) ) {
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'paint_wine_media_tag',
				'field'    => 'slug',
				'terms'    => $tag_slugs,
			),
		);
	}

	if ( ! empty( $private_tag_slugs ) ) {
		$query_args['tax_query'][] = array(
			'taxonomy' => 'paint_wine_media_tag',
			'field'    => 'slug',
			'terms'    => $private_tag_slugs,
			'operator' => 'NOT IN',
		);
	}

	$query = new WP_Query( $query_args );

	if ( ! $query->have_posts() ) {
		return '<p>' . esc_html( $atts['empty_message'] ) . '</p>';
	}

	$items        = array();
	$filter_terms = array();
	$item_index   = 0;

	while ( $query->have_posts() ) {
		$query->the_post();

		$attachment_id = get_the_ID();
		$image         = wp_get_attachment_image(
			$attachment_id,
			sanitize_key( $atts['size'] ),
			false,
			array(
				'loading'  => 'lazy',
				'decoding' => 'async',
			)
		);

		if ( ! $image ) {
			continue;
		}

		$terms      = get_the_terms( $attachment_id, 'paint_wine_media_tag' );
		$term_slugs = array();
		$term_names = array();

		if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				if ( paint_wine_gallery_is_private_term( $term ) ) {
					continue;
				}

				if ( empty( $tag_slugs ) || in_array( $term->slug, $tag_slugs, true ) ) {
					$term_slugs[] = $term->slug;
					$term_names[] = $term->name;
					$filter_terms[ $term->slug ] = $term->name;
				}
			}
		}

		if ( empty( $term_slugs ) && ! empty( $tag_slugs ) ) {
			continue;
		}

		$caption = wp_get_attachment_caption( $attachment_id );
		$title   = get_the_title( $attachment_id );
		$label   = ! empty( $term_names ) ? $term_names[0] : ( $caption ? $caption : $title );

		$items[] = array(
			'id'         => $attachment_id,
			'title'      => $title,
			'caption'    => $caption,
			'label'      => $label,
			'term_names' => $term_names,
			'term_slugs' => $term_slugs,
			'image'      => $image,
			'full'       => wp_get_attachment_image_url( $attachment_id, 'full' ),
			'shape'      => paint_wine_gallery_get_item_shape( $item_index, $layout ),
		);

		$item_index++;
	}

	wp_reset_postdata();

	if ( empty( $items ) ) {
		return '<p>' . esc_html( $atts['empty_message'] ) . '</p>';
	}

	if ( ! empty( $requested_tag_slugs ) ) {
		$ordered_filter_terms = array();

		foreach ( $requested_tag_slugs as $slug ) {
			if ( isset( $filter_terms[ $slug ] ) ) {
				$ordered_filter_terms[ $slug ] = $filter_terms[ $slug ];
			}
		}

		$filter_terms = $ordered_filter_terms;
	} else {
		asort( $filter_terms, SORT_NATURAL | SORT_FLAG_CASE );
	}

	$instance_id    = 'v4g-gallery-' . wp_unique_id();
	$render_filters = $show_filters && count( $filter_terms ) > 1;

	ob_start();
	paint_wine_render_gallery_assets();
	?>
	<div id="<?php echo esc_attr( $instance_id ); ?>" class="v4g-page" data-v4g-initial="<?php echo esc_attr( $initial ); ?>" data-v4g-batch="<?php echo esc_attr( $batch ); ?>">
		<section class="v4g-gallery" aria-labelledby="<?php echo esc_attr( $instance_id ); ?>-title">
			<div class="v4g-inner">
				<div class="v4g-head">
					<h2 class="v4g-heading" id="<?php echo esc_attr( $instance_id ); ?>-title"><?php echo esc_html( $atts['title'] ); ?></h2>
				</div>

				<?php if ( $render_filters ) : ?>
					<div class="v4g-filters" aria-label="<?php esc_attr_e( 'Filter galerije', 'hello-commerce' ); ?>">
						<button class="v4g-filter is-active" type="button" data-v4g-filter="all"><?php echo esc_html( $atts['all_label'] ); ?></button>
						<?php foreach ( $filter_terms as $slug => $name ) : ?>
							<button class="v4g-filter" type="button" data-v4g-filter="<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $name ); ?></button>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<div class="v4g-grid">
					<?php foreach ( $items as $index => $item ) : ?>
						<button class="v4g-item<?php echo esc_attr( $item['shape'] ); ?>" type="button" data-v4g-categories="<?php echo esc_attr( implode( ',', $item['term_slugs'] ) ); ?>" data-v4g-title="<?php echo esc_attr( $item['title'] ); ?>" data-v4g-label="<?php echo esc_attr( implode( ', ', $item['term_names'] ) ); ?>" data-v4g-full="<?php echo esc_url( $item['full'] ); ?>" data-v4g-index="<?php echo esc_attr( $index ); ?>">
							<figure>
								<?php echo wp_kses_post( $item['image'] ); ?>
								<figcaption class="v4g-caption"><span><?php echo esc_html( $item['label'] ); ?></span></figcaption>
							</figure>
						</button>
					<?php endforeach; ?>
				</div>

				<p class="v4g-empty"><?php echo esc_html( $atts['empty_message'] ); ?></p>

				<div class="v4g-more-wrap">
					<button class="v4g-load-more" type="button" data-v4g-load-more><?php echo esc_html( $atts['load_more'] ); ?></button>
				</div>
			</div>
		</section>

		<div class="v4g-lightbox" aria-hidden="true" data-v4g-lightbox>
			<div class="v4g-lightbox-backdrop" data-v4g-lightbox-close></div>
			<div class="v4g-lightbox-dialog" role="dialog" aria-modal="true" aria-labelledby="<?php echo esc_attr( $instance_id ); ?>-lightbox-title">
				<button class="v4g-lightbox-nav" type="button" aria-label="<?php esc_attr_e( 'Prethodna slika', 'hello-commerce' ); ?>" data-v4g-lightbox-prev>&#8592;</button>
				<div class="v4g-lightbox-panel">
					<button class="v4g-lightbox-close" type="button" aria-label="<?php esc_attr_e( 'Zatvori galeriju', 'hello-commerce' ); ?>" data-v4g-lightbox-close>&times;</button>
					<div class="v4g-lightbox-media">
						<img src="" alt="" data-v4g-lightbox-image />
					</div>
					<div class="v4g-lightbox-meta">
						<div>
							<h3 class="v4g-lightbox-title" id="<?php echo esc_attr( $instance_id ); ?>-lightbox-title" data-v4g-lightbox-title></h3>
							<p class="v4g-lightbox-category" data-v4g-lightbox-category></p>
						</div>
						<div class="v4g-lightbox-count" data-v4g-lightbox-count></div>
					</div>
				</div>
				<button class="v4g-lightbox-nav" type="button" aria-label="<?php esc_attr_e( 'Sljedeca slika', 'hello-commerce' ); ?>" data-v4g-lightbox-next>&#8594;</button>
			</div>
		</div>
	</div>
	<?php
	return ob_get_clean();
}

function paint_wine_gallery_parse_tag_slugs( $tag, $tags ) {
	$raw = array();

	if ( $tag ) {
		$raw[] = $tag;
	}

	if ( $tags ) {
		$raw = array_merge( $raw, explode( ',', $tags ) );
	}

	$slugs = array();

	foreach ( $raw as $value ) {
		$slug = sanitize_title( wp_unslash( trim( $value ) ) );

		if ( $slug ) {
			$slugs[] = $slug;
		}
	}

	return array_values( array_unique( $slugs ) );
}

function paint_wine_gallery_get_all_tag_slugs() {
	$terms = get_terms(
		array(
			'taxonomy'   => 'paint_wine_media_tag',
			'hide_empty' => true,
			'fields'     => 'slugs',
		)
	);

	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		return array();
	}

	return array_values( array_diff( array_unique( array_map( 'sanitize_title', $terms ) ), array( 'private' ) ) );
}

function paint_wine_gallery_get_private_tag_slugs() {
	$terms = get_terms(
		array(
			'taxonomy'   => 'paint_wine_media_tag',
			'hide_empty' => false,
		)
	);

	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		return array( 'private' );
	}

	$slugs = array( 'private' );

	foreach ( $terms as $term ) {
		if ( paint_wine_gallery_is_private_term( $term ) ) {
			$slugs[] = $term->slug;
		}
	}

	return array_values( array_unique( array_map( 'sanitize_title', $slugs ) ) );
}

function paint_wine_gallery_get_excluded_attachment_ids() {
	$attachments = get_posts(
		array(
			'post_type'              => 'attachment',
			'post_status'            => 'inherit',
			'post_mime_type'         => 'image',
			'posts_per_page'         => 200,
			'fields'                 => 'ids',
			'no_found_rows'          => true,
			'update_post_meta_cache' => true,
			'update_post_term_cache' => false,
			'meta_query'             => array(
				'relation' => 'OR',
				array(
					'key'     => '_wp_attached_file',
					'value'   => 'elementor/screenshots/',
					'compare' => 'LIKE',
				),
				array(
					'key'     => '_wp_attached_file',
					'value'   => 'Elementor-post-screenshot_',
					'compare' => 'LIKE',
				),
			),
		)
	);

	return array_map( 'absint', $attachments );
}

function paint_wine_gallery_is_private_term( $term ) {
	if ( empty( $term ) || empty( $term->slug ) ) {
		return false;
	}

	$slug = strtolower( (string) $term->slug );
	$name = isset( $term->name ) ? strtolower( (string) $term->name ) : '';

	return 'private' === $slug || 'private' === $name;
}

function paint_wine_gallery_get_item_shape( $index, $layout ) {
	if ( 'mixed' !== $layout ) {
		return '';
	}

	if ( 0 === $index % 6 || 4 === $index % 9 ) {
		return ' is-wide';
	}

	if ( 2 === $index % 7 ) {
		return ' is-tall';
	}

	return '';
}

function paint_wine_render_gallery_assets() {
	static $rendered = false;

	if ( $rendered ) {
		return;
	}

	$rendered = true;
	?>
	<style>
		@font-face {
			font-family: 'Archivo Black';
			src: url('/wp-content/themes/twentytwentyfive/assets/fonts/myFonts/ArchivoBlack-Regular.ttf') format('truetype');
		}

		@font-face {
			font-family: 'Open Sans Local';
			src: url('/wp-content/themes/twentytwentyfive/assets/fonts/myFonts/open-sans.regular%20%281%29.ttf') format('truetype');
		}

		.v4g-page {
			--v4g-red: #bf2020;
			--v4g-paper: #f7f3ec;
			--v4g-ink: #111111;
			--v4g-muted: #4b4b4b;
			--v4g-border: rgba(0, 0, 0, 0.14);
			--v4g-blue: #d8e2ee;
			width: 100%;
			background: #080808;
			color: var(--v4g-ink);
			font-family: "Open Sans Local", Arial, sans-serif;
		}

		.v4g-page,
		.v4g-page * {
			box-sizing: border-box;
		}

		.v4g-gallery {
			position: relative;
			background: var(--v4g-paper);
			border: 1px solid rgba(0, 0, 0, 0.12);
			overflow: hidden;
			min-height: 100vh;
		}

		.v4g-gallery::before {
			content: "";
			position: absolute;
			inset: 20px;
			border: 1px solid var(--v4g-border);
			pointer-events: none;
		}

		.v4g-gallery::after {
			content: "";
			position: absolute;
			inset: 0;
			background:
				linear-gradient(90deg, rgba(0, 0, 0, 0.04) 0, rgba(0, 0, 0, 0.04) 1px, transparent 1px, transparent 120px),
				linear-gradient(180deg, rgba(191, 32, 32, 0.03), rgba(191, 32, 32, 0.03));
			background-size: 120px 100%, 100% 100%;
			opacity: 0.55;
			pointer-events: none;
		}

		.v4g-inner {
			position: relative;
			z-index: 1;
			width: min(1440px, calc(100% - 40px));
			margin: 0 auto;
			padding: clamp(38px, 6vw, 76px) clamp(18px, 4vw, 48px);
		}

		.v4g-head {
			display: grid;
			grid-template-columns: minmax(260px, 0.72fr) minmax(320px, 1fr);
			gap: clamp(20px, 4vw, 48px);
			align-items: end;
			margin-bottom: 26px;
		}

		.v4g-heading,
		.v4g-lightbox-title {
			margin: 0;
			font-family: "Archivo Black", Arial, sans-serif;
			font-weight: 400;
			line-height: 0.95;
			letter-spacing: 0;
			text-transform: uppercase;
		}

		.v4g-heading {
			color: var(--v4g-red);
			font-size: clamp(2.4rem, 5vw, 4.9rem);
		}

		.v4g-filters {
			position: sticky;
			top: 0;
			z-index: 5;
			display: flex;
			gap: 10px;
			margin: 0 0 28px;
			padding: 12px 0;
			overflow-x: auto;
			background: linear-gradient(180deg, rgba(247, 243, 236, 0.96), rgba(247, 243, 236, 0.86));
			scrollbar-width: thin;
		}

		.v4g-filter {
			flex: 0 0 auto;
			min-height: 44px;
			padding: 0 16px;
			color: var(--v4g-red);
			background: rgba(255, 255, 255, 0.62);
			border: 1px solid rgba(191, 32, 32, 0.26);
			font: inherit;
			font-size: 0.82rem;
			font-weight: 700;
			letter-spacing: 0.08em;
			text-transform: uppercase;
			cursor: pointer;
			transition: background-color 0.25s ease, color 0.25s ease, transform 0.25s ease;
		}

		.v4g-filter:hover,
		.v4g-filter.is-active {
			color: #f7f3ec;
			background: var(--v4g-red);
			transform: translateY(-1px);
		}

		.v4g-grid {
			display: grid;
			grid-template-columns: repeat(4, minmax(0, 1fr));
			grid-auto-flow: dense;
			gap: 18px;
		}

		.v4g-item {
			position: relative;
			min-height: 220px;
			padding: 0;
			overflow: hidden;
			border: 1px solid var(--v4g-border);
			background: var(--v4g-blue);
			box-shadow: 0 18px 38px rgba(0, 0, 0, 0.08);
			cursor: zoom-in;
		}

		.v4g-item.is-hidden,
		.v4g-item.is-deferred {
			display: none;
		}

		.v4g-item.is-wide {
			grid-column: span 2;
		}

		.v4g-item.is-tall {
			grid-row: span 2;
		}

		.v4g-item figure {
			width: 100%;
			height: 100%;
			margin: 0;
		}

		.v4g-item img {
			display: block;
			width: 100%;
			height: 100%;
			min-height: 220px;
			aspect-ratio: 1 / 1;
			object-fit: cover;
			filter: saturate(0.96) contrast(1.02);
			transition: transform 0.45s ease, filter 0.45s ease;
		}

		.v4g-item.is-wide img {
			aspect-ratio: 16 / 9;
		}

		.v4g-item.is-tall img {
			aspect-ratio: 4 / 5;
		}

		.v4g-item:hover img,
		.v4g-item:focus-visible img {
			filter: saturate(1.05) contrast(1.04);
			transform: scale(1.04);
		}

		.v4g-caption {
			position: absolute;
			left: 0;
			right: 0;
			bottom: 0;
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: 14px;
			min-height: 54px;
			padding: 12px 14px;
			color: #f7f3ec;
			background: linear-gradient(180deg, transparent, rgba(0, 0, 0, 0.72));
			font-size: 0.78rem;
			font-weight: 700;
			letter-spacing: 0.08em;
			text-transform: uppercase;
			pointer-events: none;
		}

		.v4g-caption span:last-child {
			color: rgba(247, 243, 236, 0.72);
			font-size: 1.2rem;
			line-height: 1;
		}

		.v4g-empty {
			display: none;
			margin: 28px 0 0;
			color: var(--v4g-muted);
			font-size: 1rem;
			line-height: 1.6;
		}

		.v4g-empty.is-visible {
			display: block;
		}

		.v4g-more-wrap {
			display: flex;
			justify-content: center;
			margin-top: 30px;
		}

		.v4g-more-wrap.is-hidden {
			display: none;
		}

		.v4g-load-more {
			min-height: 46px;
			padding: 0 20px;
			color: #f7f3ec;
			background: var(--v4g-red);
			border: 1px solid var(--v4g-red);
			font: inherit;
			font-size: 0.82rem;
			font-weight: 700;
			letter-spacing: 0.08em;
			text-transform: uppercase;
			cursor: pointer;
			transition: background-color 0.25s ease, color 0.25s ease, transform 0.25s ease;
		}

		.v4g-load-more:hover {
			color: var(--v4g-red);
			background: #f7f3ec;
			transform: translateY(-1px);
		}

		.v4g-lightbox {
			position: fixed;
			inset: 0;
			z-index: 9999;
			display: grid;
			place-items: center;
			padding: 24px;
			opacity: 0;
			visibility: hidden;
			pointer-events: none;
			transition: opacity 0.25s ease, visibility 0.25s ease;
		}

		.v4g-lightbox.is-open {
			opacity: 1;
			visibility: visible;
			pointer-events: auto;
		}

		.v4g-lightbox-backdrop {
			position: absolute;
			inset: 0;
			background: rgba(8, 8, 8, 0.82);
		}

		.v4g-lightbox-dialog {
			position: relative;
			z-index: 1;
			display: grid;
			grid-template-columns: 58px minmax(0, 1fr) 58px;
			gap: 16px;
			align-items: center;
			width: min(1240px, 100%);
			max-height: 92vh;
		}

		.v4g-lightbox-panel {
			position: relative;
			display: grid;
			grid-template-rows: minmax(0, 1fr) auto;
			max-height: 92vh;
			background: var(--v4g-paper);
			border: 1px solid rgba(243, 235, 223, 0.24);
			box-shadow: 0 32px 80px rgba(0, 0, 0, 0.42);
		}

		.v4g-lightbox-panel::before {
			content: "";
			position: absolute;
			inset: 16px;
			border: 1px solid var(--v4g-border);
			pointer-events: none;
		}

		.v4g-lightbox-media {
			min-height: 0;
			background: #080808;
		}

		.v4g-lightbox-media img {
			display: block;
			width: 100%;
			max-height: calc(92vh - 116px);
			object-fit: contain;
			background: #080808;
		}

		.v4g-lightbox-meta {
			position: relative;
			z-index: 1;
			display: flex;
			justify-content: space-between;
			gap: 18px;
			padding: 18px 20px;
			border-top: 1px solid var(--v4g-border);
		}

		.v4g-lightbox-title {
			color: var(--v4g-red);
			font-size: clamp(1.8rem, 4vw, 3rem);
		}

		.v4g-lightbox-category {
			margin: 6px 0 0;
			color: var(--v4g-muted);
			font-size: 0.82rem;
			font-weight: 700;
			letter-spacing: 0.12em;
			text-transform: uppercase;
		}

		.v4g-lightbox-count {
			color: var(--v4g-muted);
			font-weight: 700;
			white-space: nowrap;
		}

		.v4g-lightbox-close,
		.v4g-lightbox-nav {
			display: grid;
			place-items: center;
			color: #f7f3ec;
			background: var(--v4g-red);
			border: 1px solid var(--v4g-red);
			cursor: pointer;
			transition: background-color 0.25s ease, color 0.25s ease, transform 0.25s ease;
		}

		.v4g-lightbox-close {
			position: absolute;
			top: 16px;
			right: 16px;
			z-index: 3;
			width: 46px;
			height: 46px;
			font-size: 1.35rem;
		}

		.v4g-lightbox-nav {
			width: 58px;
			height: 58px;
			font-size: 1.4rem;
		}

		.v4g-lightbox-close:hover,
		.v4g-lightbox-nav:hover {
			color: var(--v4g-red);
			background: #f7f3ec;
			transform: translateY(-1px);
		}

		@media (max-width: 1100px) {
			.v4g-grid {
				grid-template-columns: repeat(3, minmax(0, 1fr));
			}
		}

		@media (max-width: 860px) {
			.v4g-head {
				grid-template-columns: 1fr;
				align-items: start;
			}

			.v4g-grid {
				grid-template-columns: repeat(2, minmax(0, 1fr));
			}

			.v4g-lightbox-dialog {
				grid-template-columns: 1fr;
				gap: 10px;
			}

			.v4g-lightbox-nav {
				position: absolute;
				top: 50%;
				z-index: 2;
				transform: translateY(-50%);
				width: 48px;
				height: 48px;
			}

			.v4g-lightbox-nav:hover {
				transform: translateY(-50%);
			}

			.v4g-lightbox-nav[data-v4g-lightbox-prev] {
				left: 8px;
			}

			.v4g-lightbox-nav[data-v4g-lightbox-next] {
				right: 8px;
			}
		}

		@media (max-width: 640px) {
			.v4g-gallery::before {
				inset: 12px;
			}

			.v4g-inner {
				width: min(100%, calc(100% - 24px));
				padding: 28px 18px 36px;
			}

			.v4g-grid {
				grid-template-columns: 1fr;
			}

			.v4g-item.is-wide,
			.v4g-item.is-tall {
				grid-column: auto;
				grid-row: auto;
			}

			.v4g-lightbox {
				padding: 12px;
			}

			.v4g-lightbox-meta {
				display: grid;
				padding: 16px;
			}
		}
	</style>
	<script>
		(function () {
			function initGallery(root) {
				if (root.dataset.v4gReady === "yes") return;
				root.dataset.v4gReady = "yes";

				const filters = Array.from(root.querySelectorAll("[data-v4g-filter]"));
				const items = Array.from(root.querySelectorAll(".v4g-item"));
				const empty = root.querySelector(".v4g-empty");
				const loadMore = root.querySelector("[data-v4g-load-more]");
				const loadMoreWrap = loadMore ? loadMore.closest(".v4g-more-wrap") : null;
				const lightbox = root.querySelector("[data-v4g-lightbox]");
				const lightboxImage = root.querySelector("[data-v4g-lightbox-image]");
				const lightboxTitle = root.querySelector("[data-v4g-lightbox-title]");
				const lightboxCategory = root.querySelector("[data-v4g-lightbox-category]");
				const lightboxCount = root.querySelector("[data-v4g-lightbox-count]");
				const closeButtons = root.querySelectorAll("[data-v4g-lightbox-close]");
				const prevButton = root.querySelector("[data-v4g-lightbox-prev]");
				const nextButton = root.querySelector("[data-v4g-lightbox-next]");
				const initialCount = Math.max(1, parseInt(root.dataset.v4gInitial || "12", 10));
				const batchCount = Math.max(1, parseInt(root.dataset.v4gBatch || "12", 10));
				let activeFilter = "all";
				let revealedCount = initialCount;
				let activeIndex = 0;
				let previousBodyOverflow = "";
				let lastTrigger = null;

				function matchingItems() {
					return items.filter((item) => {
						const categories = (item.dataset.v4gCategories || "").split(",").filter(Boolean);
						return activeFilter === "all" || categories.includes(activeFilter);
					});
				}

				function visibleItems() {
					return items.filter((item) => !item.classList.contains("is-hidden") && !item.classList.contains("is-deferred"));
				}

				function updateLoadMore(matches) {
					if (!loadMoreWrap) return;
					loadMoreWrap.classList.toggle("is-hidden", matches.length <= revealedCount);
				}

				function applyFilter(filter, resetCount) {
					activeFilter = filter;
					if (resetCount) revealedCount = initialCount;

					const matches = matchingItems();
					items.forEach((item) => {
						const matchIndex = matches.indexOf(item);
						const isMatch = matchIndex >= 0;
						item.classList.toggle("is-hidden", !isMatch);
						item.classList.toggle("is-deferred", isMatch && matchIndex >= revealedCount);
					});

					filters.forEach((button) => {
						button.classList.toggle("is-active", button.dataset.v4gFilter === filter);
					});

					if (empty) empty.classList.toggle("is-visible", matches.length === 0);
					updateLoadMore(matches);
				}

				function setLightbox(index) {
					const currentItems = visibleItems();
					if (!currentItems.length) return;

					activeIndex = (index + currentItems.length) % currentItems.length;
					const item = currentItems[activeIndex];
					const img = item.querySelector("img");
					const fullSrc = item.dataset.v4gFull || img.currentSrc || img.src;

					lightboxImage.src = fullSrc;
					lightboxImage.alt = img.alt;
					lightboxTitle.textContent = item.dataset.v4gTitle || img.alt;
					lightboxCategory.textContent = item.dataset.v4gLabel || "";
					lightboxCount.textContent = (activeIndex + 1) + " / " + currentItems.length;
				}

				function openLightbox(item) {
					const currentItems = visibleItems();
					const index = currentItems.indexOf(item);
					if (index < 0) return;

					previousBodyOverflow = document.body.style.overflow;
					lastTrigger = item;
					setLightbox(index);
					lightbox.classList.add("is-open");
					lightbox.setAttribute("aria-hidden", "false");
					document.body.style.overflow = "hidden";
					nextButton.focus();
				}

				function closeLightbox() {
					lightbox.classList.remove("is-open");
					lightbox.setAttribute("aria-hidden", "true");
					lightboxImage.src = "";
					document.body.style.overflow = previousBodyOverflow;
					if (lastTrigger) lastTrigger.focus();
				}

				filters.forEach((button) => {
					button.addEventListener("click", () => applyFilter(button.dataset.v4gFilter || "all", true));
				});

				items.forEach((item) => {
					item.addEventListener("click", () => openLightbox(item));
				});

				if (loadMore) {
					loadMore.addEventListener("click", () => {
						revealedCount += batchCount;
						applyFilter(activeFilter, false);
					});
				}

				closeButtons.forEach((button) => {
					button.addEventListener("click", closeLightbox);
				});

				prevButton.addEventListener("click", () => setLightbox(activeIndex - 1));
				nextButton.addEventListener("click", () => setLightbox(activeIndex + 1));

				document.addEventListener("keydown", (event) => {
					if (!lightbox.classList.contains("is-open")) return;

					if (event.key === "Escape") closeLightbox();
					if (event.key === "ArrowLeft") setLightbox(activeIndex - 1);
					if (event.key === "ArrowRight") setLightbox(activeIndex + 1);
				});

				applyFilter(activeFilter, true);
			}

			function initAllGalleries() {
				document.querySelectorAll(".v4g-page").forEach(initGallery);
			}

			if (document.readyState === "loading") {
				document.addEventListener("DOMContentLoaded", initAllGalleries);
			} else {
				initAllGalleries();
			}
		})();
	</script>
	<?php
}
