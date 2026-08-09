<?php
/**
 * Plugin Name: Paint & Wine Products Shortcode
 * Description: Renders a WooCommerce product grid with optional category filters and ACF-backed event fields.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'paint_wine_register_products_shortcode' );

function paint_wine_register_products_shortcode() {
	add_shortcode( 'paint_wine_products', 'paint_wine_render_products_shortcode' );
}

function paint_wine_render_products_shortcode( $atts ) {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return '';
	}

	$atts = shortcode_atts(
		array(
			'title'              => 'Mjesečni Raspored',
			'subtitle'           => 'Ne brinite, ne treba vam nikakvo iskustvo.',
			'category'           => '',
			'categories'         => '',
			'exclude'            => '',
			'exclude_category'   => '',
			'exclude_categories' => '',
			'show_filters'       => 'yes',
			'all_label'          => 'Sve',
			'limit'              => 40,
			'button_label'       => 'Rezerviši',
			'empty_message'      => 'Trenutno nema proizvoda za prikaz.',
			'date_field'         => 'event_date',
			'time_field'         => 'event_time',
			'meta_field'         => '',
			'difficulty_field'   => 'difficulty',
			'accent_field'       => '',
			'button_label_field' => '',
			'orderby'            => 'menu_order',
			'order'              => 'ASC',
			'style'              => '',
		),
		$atts,
		'paint_wine_products'
	);

	$selected_slugs = paint_wine_parse_category_slugs( $atts['category'], $atts['categories'] );
	$excluded_slugs = paint_wine_parse_category_slugs( $atts['exclude_category'], $atts['exclude_categories'] );
	$excluded_ids   = paint_wine_parse_excluded_product_ids( $atts['exclude'] );
	$limit          = min( 40, max( 1, absint( $atts['limit'] ) ) );
	$order          = 'DESC' === strtoupper( $atts['order'] ) ? 'DESC' : 'ASC';
	$orderby        = sanitize_key( $atts['orderby'] );
	$valid_orderby  = array( 'menu_order', 'title', 'date', 'modified', 'rand' );
	$style          = sanitize_key( $atts['style'] );

	if ( ! in_array( $orderby, $valid_orderby, true ) ) {
		$orderby = 'menu_order';
	}

	$query_args = array(
		'post_type'           => 'product',
		'post_status'         => 'publish',
		'posts_per_page'      => $limit,
		'ignore_sticky_posts' => true,
		'orderby'             => $orderby,
		'order'               => $order,
	);

	if ( ! empty( $excluded_ids ) ) {
		$query_args['post__not_in'] = $excluded_ids;
	}

	$tax_query = array();

	if ( ! empty( $selected_slugs ) ) {
		$tax_query[] = array(
			'taxonomy' => 'product_cat',
			'field'    => 'slug',
			'terms'    => $selected_slugs,
		);
	}

	if ( ! empty( $excluded_slugs ) ) {
		$tax_query[] = array(
			'taxonomy' => 'product_cat',
			'field'    => 'slug',
			'terms'    => $excluded_slugs,
			'operator' => 'NOT IN',
		);
	}

	if ( ! empty( $tax_query ) ) {
		if ( count( $tax_query ) > 1 ) {
			$tax_query['relation'] = 'AND';
		}

		$query_args['tax_query'] = $tax_query;
	}

	$query = new WP_Query( $query_args );

	if ( ! $query->have_posts() ) {
		return '<p>' . esc_html( $atts['empty_message'] ) . '</p>';
	}

	$products      = array();
	$filter_terms  = array();
	$show_filters  = 'yes' === strtolower( $atts['show_filters'] );
	$instance_id   = 'v5e-schedule-' . wp_unique_id();

	while ( $query->have_posts() ) {
		$query->the_post();

		$product = wc_get_product( get_the_ID() );

		if ( ! $product ) {
			continue;
		}

		$product_terms = get_the_terms( $product->get_id(), 'product_cat' );
		$card_terms    = array();

		if ( ! is_wp_error( $product_terms ) && ! empty( $product_terms ) ) {
			foreach ( $product_terms as $term ) {
				if ( empty( $selected_slugs ) || in_array( $term->slug, $selected_slugs, true ) ) {
					$card_terms[] = array(
						'slug' => $term->slug,
						'name' => $term->name,
					);
					$filter_terms[ $term->slug ] = $term->name;
				}
			}
		}

		if ( empty( $card_terms ) && ! empty( $selected_slugs ) ) {
			continue;
		}

		$date_value         = paint_wine_get_field_value( $atts['date_field'], $product->get_id() );
		$time_value         = paint_wine_get_field_value( $atts['time_field'], $product->get_id() );
		$meta_value         = paint_wine_get_field_value( $atts['meta_field'], $product->get_id() );
		$difficulty_value   = paint_wine_get_field_value( $atts['difficulty_field'], $product->get_id() );
		$accent_value       = paint_wine_get_field_value( $atts['accent_field'], $product->get_id() );
		$button_label_field = paint_wine_get_field_value( $atts['button_label_field'], $product->get_id() );
		$timestamp          = paint_wine_parse_event_timestamp( $date_value );
		$display_date       = $timestamp ? wp_date( 'd.m.Y.', $timestamp ) : $date_value;
		$display_meta       = paint_wine_build_meta_text( $meta_value, $time_value, $timestamp );
		$button_label       = $button_label_field ? $button_label_field : $atts['button_label'];
		$display_accent     = $difficulty_value ? paint_wine_format_difficulty( $difficulty_value ) : $accent_value;
		$image_html         = $product->get_image( 'large', array( 'loading' => 'lazy' ) );

		if ( ! $image_html ) {
			$image_html = wc_placeholder_img( 'large' );
		}

		$products[] = array(
			'id'           => $product->get_id(),
			'name'         => $product->get_name(),
			'link'         => get_permalink( $product->get_id() ),
			'price_html'   => $product->get_price_html(),
			'image_html'   => $image_html,
			'date'         => $display_date,
			'meta'         => $display_meta,
			'difficulty'   => $difficulty_value,
			'accent'       => $display_accent,
			'button_label' => $button_label,
			'term_slugs'   => wp_list_pluck( $card_terms, 'slug' ),
		);
	}

	wp_reset_postdata();

	if ( empty( $products ) ) {
		return '<p>' . esc_html( $atts['empty_message'] ) . '</p>';
	}

	if ( ! empty( $selected_slugs ) ) {
		$ordered_filter_terms = array();

		foreach ( $selected_slugs as $slug ) {
			if ( isset( $filter_terms[ $slug ] ) ) {
				$ordered_filter_terms[ $slug ] = $filter_terms[ $slug ];
			}
		}

		$filter_terms = $ordered_filter_terms;
	} else {
		asort( $filter_terms, SORT_NATURAL | SORT_FLAG_CASE );
	}

	$render_filters = $show_filters && count( $filter_terms ) > 1;
	$default_filter = empty( $selected_slugs ) || $render_filters ? 'all' : ( array_key_first( $filter_terms ) ?: 'all' );

	ob_start();
	paint_wine_render_products_assets();

	if ( 'neon' === $style ) {
		paint_wine_render_products_neon( $atts, $products, $filter_terms, $render_filters, $default_filter, $instance_id );
		return ob_get_clean();
	}
	?>
	<section id="<?php echo esc_attr( $instance_id ); ?>" class="v5e-schedule" aria-label="<?php echo esc_attr( $atts['title'] ); ?>" data-v5e-default-filter="<?php echo esc_attr( $default_filter ); ?>">
		<div class="v5e-shell">
			<div class="v5e-head">
				<h2 class="v5e-title"><?php echo esc_html( $atts['title'] ); ?></h2>
				<?php if ( $atts['subtitle'] ) : ?>
					<p class="v5e-subtitle"><?php echo esc_html( $atts['subtitle'] ); ?></p>
				<?php endif; ?>
			</div>

			<?php if ( $render_filters ) : ?>
				<div class="v5e-controls" role="tablist" aria-label="<?php esc_attr_e( 'Kategorije proizvoda', 'hello-commerce' ); ?>">
					<button class="v5e-filter is-active" type="button" data-v5e-filter="all"><?php echo esc_html( $atts['all_label'] ); ?></button>
					<?php foreach ( $filter_terms as $slug => $name ) : ?>
						<button class="v5e-filter" type="button" data-v5e-filter="<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $name ); ?></button>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<div class="v5e-grid">
				<?php foreach ( $products as $item ) : ?>
					<article class="v5e-card" data-v5e-categories="<?php echo esc_attr( implode( ',', $item['term_slugs'] ) ); ?>">
						<?php if ( $item['date'] ) : ?>
							<div class="v5e-date"><?php echo esc_html( $item['date'] ); ?></div>
						<?php endif; ?>

						<?php if ( $item['meta'] ) : ?>
							<div class="v5e-meta"><?php echo esc_html( $item['meta'] ); ?></div>
						<?php endif; ?>

						<a class="v5e-image" href="<?php echo esc_url( $item['link'] ); ?>" aria-label="<?php echo esc_attr( $item['name'] ); ?>">
							<?php echo wp_kses_post( $item['image_html'] ); ?>
						</a>

						<div class="v5e-name"><?php echo esc_html( $item['name'] ); ?></div>

						<div class="v5e-priceRow">
							<div class="v5e-price"><?php echo wp_kses_post( $item['price_html'] ); ?></div>
							<?php if ( $item['accent'] ) : ?>
								<div class="v5e-accent"><?php echo esc_html( $item['accent'] ); ?></div>
							<?php endif; ?>
						</div>

						<div class="v5e-buy">
							<a class="v5e-button" href="<?php echo esc_url( $item['link'] ); ?>"><?php echo esc_html( $item['button_label'] ); ?></a>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}

function paint_wine_render_products_neon( $atts, $products, $filter_terms, $render_filters, $default_filter, $instance_id ) {
	?>
	<section id="<?php echo esc_attr( $instance_id ); ?>" class="v5e-schedule v5e-schedule--neon npk-section" aria-label="<?php echo esc_attr( $atts['title'] ); ?>" data-v5e-default-filter="<?php echo esc_attr( $default_filter ); ?>">
		<div class="v5e-shell npk-shell">
			<div class="npk-card npk-booking-wrap">
				<div class="npk-booking-head">
					<span class="npk-pill">Rezervisi</span>
					<h2 class="npk-heading"><?php paint_wine_render_neon_heading( $atts['title'] ); ?></h2>
					<?php if ( $atts['subtitle'] ) : ?>
						<p class="npk-text"><?php echo esc_html( $atts['subtitle'] ); ?></p>
					<?php endif; ?>
				</div>

				<?php if ( $render_filters ) : ?>
					<div class="v5e-controls npk-filter-row" role="tablist" aria-label="<?php esc_attr_e( 'Kategorije proizvoda', 'hello-commerce' ); ?>">
						<button class="v5e-filter is-active" type="button" data-v5e-filter="all"><?php echo esc_html( $atts['all_label'] ); ?></button>
						<?php foreach ( $filter_terms as $slug => $name ) : ?>
							<button class="v5e-filter" type="button" data-v5e-filter="<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $name ); ?></button>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<div class="v5e-grid npk-booking-grid">
					<?php foreach ( $products as $item ) : ?>
						<article class="v5e-card npk-book-card" data-v5e-categories="<?php echo esc_attr( implode( ',', $item['term_slugs'] ) ); ?>">
							<a class="v5e-image npk-book-image" href="<?php echo esc_url( $item['link'] ); ?>" aria-label="<?php echo esc_attr( $item['name'] ); ?>">
								<?php echo wp_kses_post( $item['image_html'] ); ?>
							</a>

							<div class="npk-book-badges">
								<?php if ( $item['date'] ) : ?>
									<span class="v5e-date npk-tag"><?php echo esc_html( $item['date'] ); ?></span>
								<?php endif; ?>

								<?php if ( $item['accent'] ) : ?>
									<span class="v5e-accent npk-tag npk-tag--pink"><?php echo esc_html( $item['accent'] ); ?></span>
								<?php endif; ?>
							</div>

							<h3 class="v5e-name npk-book-title"><?php echo esc_html( $item['name'] ); ?></h3>

							<?php if ( $item['meta'] ) : ?>
								<p class="v5e-meta npk-book-meta"><?php echo esc_html( $item['meta'] ); ?></p>
							<?php endif; ?>

							<div class="v5e-priceRow npk-book-footer">
								<div class="v5e-price npk-book-price"><?php echo wp_kses_post( $item['price_html'] ); ?></div>
								<a class="v5e-button npk-book-link" href="<?php echo esc_url( $item['link'] ); ?>"><?php echo esc_html( $item['button_label'] ); ?></a>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
	<?php
}

function paint_wine_render_neon_heading( $title ) {
	$title = trim( wp_strip_all_tags( (string) $title ) );

	if ( '' === $title ) {
		return;
	}

	$words = preg_split( '/\s+/', $title );

	if ( ! is_array( $words ) || count( $words ) < 2 ) {
		echo '<span class="pink">' . esc_html( $title ) . '</span>';
		return;
	}

	$highlight = array_pop( $words );

	echo esc_html( implode( ' ', $words ) . ' ' );
	echo '<span class="pink">' . esc_html( $highlight ) . '</span>';
}

function paint_wine_parse_category_slugs( $category, $categories ) {
	$raw = array();

	if ( $category ) {
		$raw[] = $category;
	}

	if ( $categories ) {
		$raw = array_merge( $raw, explode( ',', $categories ) );
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

function paint_wine_parse_excluded_product_ids( $exclude ) {
	if ( ! $exclude ) {
		return array();
	}

	$ids   = array();
	$slugs = array();
	$raw   = explode( ',', $exclude );

	foreach ( $raw as $value ) {
		$value = trim( wp_unslash( $value ) );

		if ( '' === $value ) {
			continue;
		}

		if ( ctype_digit( $value ) ) {
			$ids[] = absint( $value );
			continue;
		}

		$slug = sanitize_title( $value );

		if ( $slug ) {
			$slugs[] = $slug;
		}
	}

	if ( ! empty( $slugs ) ) {
		$slug_posts = get_posts(
			array(
				'post_type'              => 'product',
				'post_status'            => 'any',
				'posts_per_page'         => count( $slugs ),
				'fields'                 => 'ids',
				'post_name__in'          => array_values( array_unique( $slugs ) ),
				'no_found_rows'          => true,
				'update_post_meta_cache' => false,
				'update_post_term_cache' => false,
			)
		);

		$ids = array_merge( $ids, $slug_posts );
	}

	return array_values( array_unique( array_filter( array_map( 'absint', $ids ) ) ) );
}

function paint_wine_get_field_value( $field_name, $post_id ) {
	if ( ! $field_name ) {
		return '';
	}

	if ( function_exists( 'get_field' ) ) {
		$value = get_field( $field_name, $post_id );
	} else {
		$value = get_post_meta( $post_id, $field_name, true );
	}

	if ( is_array( $value ) ) {
		return trim( wp_strip_all_tags( implode( ' ', $value ) ) );
	}

	return is_scalar( $value ) ? trim( wp_strip_all_tags( (string) $value ) ) : '';
}

function paint_wine_parse_event_timestamp( $value ) {
	if ( ! $value ) {
		return null;
	}

	if ( preg_match( '/^\d{8}$/', $value ) ) {
		$parsed = DateTime::createFromFormat( 'Ymd', $value, wp_timezone() );
		return $parsed ? $parsed->getTimestamp() : null;
	}

	$timestamp = strtotime( $value );

	return $timestamp ?: null;
}

function paint_wine_build_meta_text( $meta_value, $time_value, $timestamp ) {
	if ( $meta_value ) {
		return $meta_value;
	}

	$parts = array();

	if ( $timestamp ) {
		$parts[] = wp_date( 'l', $timestamp );
	}

	if ( $time_value ) {
		$parts[] = $time_value;
	}

	return implode( ' · ', $parts );
}

function paint_wine_format_difficulty( $value ) {
	$value = trim( (string) $value );

	if ( '' === $value ) {
		return '';
	}

	if ( is_numeric( $value ) ) {
		$count = max( 1, min( 8, absint( $value ) ) );
		return str_repeat( '/', $count );
	}

	return $value;
}

function paint_wine_render_products_assets() {
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

		.v5e-schedule {
			--v5e-red: #bf2020;
			--v5e-white: #ffffff;
			--v5e-paper: #f7f3ec;
			--v5e-ink: #111111;
			position: relative;
			width: 100%;
			background: var(--v5e-paper);
			border: 1px solid rgba(0, 0, 0, 0.12);
			overflow: hidden;
			font-family: "Open Sans Local", Arial, sans-serif;
			color: var(--v5e-ink);
		}

		.v5e-schedule,
		.v5e-schedule * {
			box-sizing: border-box;
		}

		.v5e-schedule::before {
			content: "";
			position: absolute;
			inset: 20px;
			border: 1px solid rgba(0, 0, 0, 0.16);
			pointer-events: none;
		}

		.v5e-schedule::after {
			content: "";
			position: absolute;
			inset: 0;
			background:
				linear-gradient(90deg, rgba(0, 0, 0, 0.035) 0, rgba(0, 0, 0, 0.035) 1px, transparent 1px, transparent 120px),
				linear-gradient(180deg, rgba(191, 32, 32, 0.025), rgba(191, 32, 32, 0.025));
			background-size: 120px 100%, 100% 100%;
			opacity: 0.5;
			pointer-events: none;
		}

		.v5e-shell {
			position: relative;
			z-index: 1;
			display: flex;
			flex-direction: column;
		}

		.v5e-head {
			padding: clamp(34px, 5vw, 64px) clamp(22px, 4vw, 48px) 28px;
			border-bottom: 1px solid rgba(0, 0, 0, 0.12);
			text-align: center;
		}

		.v5e-title {
			margin: 0;
			color: var(--v5e-red);
			font-family: "Archivo Black", Arial, sans-serif;
			font-size: clamp(2.4rem, 5vw, 4.9rem);
			font-weight: 400;
			line-height: 0.95;
			letter-spacing: 0;
			text-transform: uppercase;
		}

		.v5e-subtitle {
			margin: 18px auto 0;
			max-width: 36ch;
			font-size: clamp(1rem, 1.7vw, 1.2rem);
			line-height: 1.6;
		}

		.v5e-controls {
			display: flex;
			justify-content: center;
			gap: 10px;
			flex-wrap: wrap;
			padding: 20px 22px 0;
		}

		.v5e-filter {
			min-width: 110px;
			padding: 12px 18px;
			border: 1px solid rgba(0, 0, 0, 0.16);
			background: rgba(255, 255, 255, 0.55);
			color: var(--v5e-ink);
			font-size: 0.9rem;
			font-weight: 700;
			letter-spacing: 0.14em;
			text-transform: uppercase;
			cursor: pointer;
			transition: background-color 0.25s ease, color 0.25s ease, border-color 0.25s ease, transform 0.25s ease;
		}

		.v5e-filter:hover {
			transform: translateY(-1px);
		}

		.v5e-filter.is-active {
			background: var(--v5e-red);
			color: var(--v5e-white);
			border-color: var(--v5e-red);
		}

		.v5e-grid {
			display: grid;
			grid-template-columns: repeat(4, minmax(0, 1fr));
			gap: 18px;
			padding: 28px clamp(22px, 4vw, 48px) clamp(26px, 4vw, 42px);
			align-content: start;
		}

		.v5e-card {
			display: flex;
			flex-direction: column;
			gap: 12px;
			padding: 18px;
			border: 1px solid rgba(0, 0, 0, 0.12);
			background: rgba(255, 255, 255, 0.68);
			box-shadow: 12px 12px 0 rgba(0, 0, 0, 0.04);
		}

		.v5e-card[hidden] {
			display: none;
		}

		.v5e-date {
			color: var(--v5e-red);
			font-family: "Archivo Black", Arial, sans-serif;
			font-size: 2rem;
			font-weight: 400;
			line-height: 0.95;
		}

		.v5e-meta {
			color: var(--v5e-red);
			font-size: 0.82rem;
			font-weight: 700;
			letter-spacing: 0.05em;
			text-transform: uppercase;
		}

		.v5e-image {
			display: block;
			aspect-ratio: 1 / 1;
			overflow: hidden;
			border: 1px solid rgba(0, 0, 0, 0.12);
			background: #d8e2ee;
		}

		.v5e-image img {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}

		.v5e-name {
			font-size: 1.35rem;
			font-weight: 700;
			line-height: 1.15;
		}

		.v5e-priceRow {
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: 12px;
		}

		.v5e-price {
			color: #7aa05f;
			font-size: 1.7rem;
			font-weight: 700;
			line-height: 1;
		}

		.v5e-price .amount {
			color: inherit;
		}

		.v5e-accent {
			color: var(--v5e-red);
			font-size: 1.2rem;
			font-weight: 700;
			letter-spacing: 0.18em;
		}

		.v5e-buy {
			display: flex;
			align-items: center;
			margin-top: auto;
			padding-top: 4px;
		}

		.v5e-button {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			width: 100%;
			min-height: 42px;
			padding: 11px 16px;
			border: 0;
			background: var(--v5e-red);
			color: var(--v5e-white);
			font-size: 0.9rem;
			font-weight: 700;
			text-decoration: none;
			cursor: pointer;
			transition: background-color 0.25s ease, transform 0.25s ease;
		}

		.v5e-button:hover {
			background: #a51a1a;
			transform: translateY(-1px);
		}

		.v5e-schedule.v5e-schedule--neon {
			--npk-bg: #050816;
			--npk-panel: rgba(11, 16, 35, 0.72);
			--npk-line: rgba(111, 233, 255, 0.22);
			--npk-text: #ecf6ff;
			--npk-muted: rgba(236, 246, 255, 0.72);
			--npk-cyan: #66f7ff;
			--npk-pink: #ff4fcf;
			--npk-violet: #8f63ff;
			--npk-lime: #99ff66;
			--npk-orange: #ff9d00;
			--npk-shadow: 0 24px 80px rgba(0, 0, 0, 0.44);
			padding: clamp(18px, 3vw, 28px);
			border: 0;
			background:
				radial-gradient(circle at 12% 18%, rgba(102, 247, 255, 0.18), transparent 18%),
				radial-gradient(circle at 88% 10%, rgba(255, 79, 207, 0.18), transparent 20%),
				radial-gradient(circle at 70% 78%, rgba(153, 255, 102, 0.12), transparent 18%),
				linear-gradient(180deg, #040612 0%, #060a18 36%, #070d20 100%);
			color: var(--npk-text);
			font-family: "Open Sans Local", Arial, sans-serif;
			isolation: isolate;
		}

		.v5e-schedule--neon::before {
			inset: 0;
			border: 0;
			background:
				linear-gradient(90deg, rgba(255, 255, 255, 0.03) 0, rgba(255, 255, 255, 0.03) 1px, transparent 1px, transparent 120px),
				linear-gradient(180deg, rgba(255, 255, 255, 0.02) 0, rgba(255, 255, 255, 0.02) 1px, transparent 1px, transparent 120px);
			opacity: 0.32;
		}

		.v5e-schedule--neon::after {
			background: radial-gradient(circle at center, rgba(143, 99, 255, 0.08), transparent 48%);
			mix-blend-mode: screen;
			opacity: 1;
		}

		.v5e-schedule--neon .v5e-shell {
			width: min(1240px, 100%);
			margin: 0 auto;
			display: block;
		}

		.v5e-schedule--neon .npk-card,
		.v5e-schedule--neon .npk-book-card {
			position: relative;
			overflow: hidden;
			border: 1px solid var(--npk-line);
			background:
				linear-gradient(180deg, rgba(255, 255, 255, 0.06), rgba(255, 255, 255, 0.015)),
				var(--npk-panel);
			backdrop-filter: blur(14px);
			box-shadow: var(--npk-shadow);
		}

		.v5e-schedule--neon .npk-card::before,
		.v5e-schedule--neon .npk-book-card::before {
			content: "";
			position: absolute;
			inset: 12px;
			border: 1px solid rgba(255, 255, 255, 0.08);
			pointer-events: none;
		}

		.v5e-schedule--neon .npk-booking-wrap {
			display: grid;
			gap: 22px;
			padding: clamp(22px, 3vw, 34px);
			border-radius: 30px;
		}

		.v5e-schedule--neon .npk-booking-head {
			display: grid;
			gap: 12px;
			text-align: center;
			justify-items: center;
		}

		.v5e-schedule--neon .npk-pill {
			display: inline-flex;
			align-items: center;
			gap: 10px;
			width: fit-content;
			min-height: 40px;
			padding: 0 16px;
			border-radius: 999px;
			border: 1px solid rgba(255, 255, 255, 0.1);
			background: rgba(7, 11, 24, 0.6);
			color: var(--npk-text);
			font-size: 0.76rem;
			font-weight: 700;
			letter-spacing: 0.18em;
			text-transform: uppercase;
		}

		.v5e-schedule--neon .npk-pill::before {
			content: "";
			width: 28px;
			height: 8px;
			border-radius: 999px;
			background: linear-gradient(90deg, var(--npk-cyan), var(--npk-pink), var(--npk-orange));
			box-shadow: 0 0 18px rgba(102, 247, 255, 0.5);
		}

		.v5e-schedule--neon .npk-heading,
		.v5e-schedule--neon .npk-book-title {
			margin: 0;
			font-family: "Archivo Black", Arial, sans-serif;
			font-weight: 400;
			text-transform: uppercase;
			line-height: 0.94;
			letter-spacing: 0;
		}

		.v5e-schedule--neon .npk-heading {
			font-size: clamp(2rem, 5vw, 4rem);
		}

		.v5e-schedule--neon .npk-heading .pink,
		.v5e-schedule--neon .npk-book-title .pink {
			color: var(--npk-pink);
		}

		.v5e-schedule--neon .npk-heading .cyan,
		.v5e-schedule--neon .npk-book-title .cyan {
			color: var(--npk-cyan);
		}

		.v5e-schedule--neon .npk-text,
		.v5e-schedule--neon .npk-book-meta {
			margin: 0;
			color: var(--npk-muted);
			font-size: clamp(0.98rem, 1.2vw, 1.06rem);
			line-height: 1.7;
		}

		.v5e-schedule--neon .npk-filter-row {
			display: flex;
			justify-content: center;
			flex-wrap: wrap;
			gap: 10px;
			padding: 0;
		}

		.v5e-schedule--neon .v5e-filter {
			min-width: 0;
			min-height: 40px;
			padding: 0 16px;
			border-radius: 999px;
			border: 1px solid rgba(102, 247, 255, 0.18);
			background: rgba(102, 247, 255, 0.08);
			color: var(--npk-cyan);
			font-family: "Open Sans Local", Arial, sans-serif;
			font-size: 0.78rem;
			font-weight: 700;
			letter-spacing: 0.08em;
			text-transform: uppercase;
			box-shadow: none;
		}

		.v5e-schedule--neon .v5e-filter:hover {
			border-color: rgba(255, 79, 207, 0.3);
			background: rgba(255, 79, 207, 0.12);
			color: var(--npk-text);
			box-shadow: 0 0 20px rgba(255, 79, 207, 0.14);
		}

		.v5e-schedule--neon .v5e-filter.is-active {
			border-color: rgba(255, 79, 207, 0.36);
			background: linear-gradient(135deg, rgba(102, 247, 255, 0.18), rgba(255, 79, 207, 0.18));
			color: var(--npk-text);
			box-shadow: 0 0 22px rgba(102, 247, 255, 0.16);
		}

		.v5e-schedule--neon .npk-booking-grid {
			display: grid;
			grid-template-columns: repeat(4, minmax(0, 1fr));
			gap: 16px;
			padding: 0;
		}

		.v5e-schedule--neon .v5e-card.npk-book-card {
			display: grid;
			gap: 14px;
			padding: 18px;
			border-radius: 24px;
		}

		.v5e-schedule--neon .v5e-card[hidden] {
			display: none;
		}

		.v5e-schedule--neon .npk-book-image {
			display: block;
			aspect-ratio: 1 / 1;
			border-radius: 18px;
			overflow: hidden;
			border: 1px solid rgba(255, 255, 255, 0.1);
			background: #0a1023;
		}

		.v5e-schedule--neon .npk-book-image img {
			display: block;
			width: 100%;
			height: 100%;
			object-fit: cover;
			filter: saturate(1.25) contrast(1.08);
			transition: transform 0.45s ease;
		}

		.v5e-schedule--neon .npk-book-card:hover .npk-book-image img {
			transform: scale(1.08);
		}

		.v5e-schedule--neon .npk-book-badges {
			display: flex;
			flex-wrap: wrap;
			gap: 8px;
		}

		.v5e-schedule--neon .npk-tag {
			display: inline-flex;
			align-items: center;
			min-height: 30px;
			padding: 0 12px;
			border-radius: 999px;
			background: rgba(102, 247, 255, 0.08);
			border: 1px solid rgba(102, 247, 255, 0.18);
			color: var(--npk-cyan);
			font-size: 0.78rem;
			font-weight: 700;
			letter-spacing: 0.08em;
			line-height: 1;
			text-transform: uppercase;
		}

		.v5e-schedule--neon .npk-tag--pink {
			background: rgba(255, 79, 207, 0.1);
			border-color: rgba(255, 79, 207, 0.2);
			color: var(--npk-pink);
		}

		.v5e-schedule--neon .npk-book-title {
			color: var(--npk-text);
			font-size: clamp(1.2rem, 2.1vw, 1.7rem);
		}

		.v5e-schedule--neon .npk-book-footer {
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: 10px;
			margin-top: auto;
		}

		.v5e-schedule--neon .npk-book-price {
			color: var(--npk-lime);
			font-size: 1.05rem;
			font-weight: 700;
			line-height: 1;
		}

		.v5e-schedule--neon .npk-book-price .amount {
			color: inherit;
		}

		.v5e-schedule--neon .npk-book-link {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			width: auto;
			min-height: 38px;
			padding: 0 14px;
			border-radius: 999px;
			color: var(--npk-text);
			text-decoration: none;
			font-size: 0.76rem;
			font-weight: 700;
			letter-spacing: 0.1em;
			text-transform: uppercase;
			background: rgba(255, 79, 207, 0.12);
			border: 1px solid rgba(255, 79, 207, 0.24);
			transition: transform 0.28s ease, box-shadow 0.28s ease, border-color 0.28s ease;
		}

		.v5e-schedule--neon .npk-book-link:hover {
			background: rgba(255, 79, 207, 0.16);
			box-shadow: 0 0 20px rgba(255, 79, 207, 0.22);
			transform: translateY(-2px);
		}

		@media (max-width: 1100px) {
			.v5e-schedule--neon .npk-booking-grid {
				grid-template-columns: repeat(2, minmax(0, 1fr));
			}
		}

		@media (max-width: 640px) {
			.v5e-schedule.v5e-schedule--neon {
				padding: 12px;
			}

			.v5e-schedule--neon .npk-booking-wrap {
				padding: 20px 18px;
				border-radius: 24px;
			}

			.v5e-schedule--neon .npk-booking-grid {
				grid-template-columns: 1fr;
			}

			.v5e-schedule--neon .npk-book-footer {
				align-items: stretch;
				flex-direction: column;
			}

			.v5e-schedule--neon .npk-book-link {
				width: 100%;
			}
		}

		@media (max-width: 1180px) {
			.v5e-grid {
				grid-template-columns: repeat(2, minmax(0, 1fr));
			}
		}

		@media (max-width: 720px) {
			.v5e-schedule::before {
				inset: 12px;
			}

			.v5e-schedule.v5e-schedule--neon::before {
				inset: 0;
			}

			.v5e-grid {
				grid-template-columns: 1fr;
				padding: 22px 18px 24px;
			}

			.v5e-head {
				padding: 28px 18px 24px;
			}

			.v5e-controls {
				padding: 18px 18px 0;
			}
		}
	</style>
	<script>
		(function () {
			function setFilter(schedule, filterValue) {
				const filters = Array.from(schedule.querySelectorAll('.v5e-filter'));
				const cards = Array.from(schedule.querySelectorAll('.v5e-card'));

				filters.forEach((button) => {
					button.classList.toggle('is-active', button.dataset.v5eFilter === filterValue);
				});

				cards.forEach((card) => {
					const categories = (card.dataset.v5eCategories || '').split(',').filter(Boolean);
					const matches = filterValue === 'all' || categories.includes(filterValue);
					card.hidden = !matches;
				});
			}

			function initSchedule(schedule) {
				if (schedule.dataset.v5eReady === 'yes') {
					return;
				}

				schedule.dataset.v5eReady = 'yes';

				schedule.addEventListener('click', function (event) {
					const button = event.target.closest('.v5e-filter');
					if (!button || !schedule.contains(button)) {
						return;
					}

					setFilter(schedule, button.dataset.v5eFilter || 'all');
				});

				setFilter(schedule, schedule.dataset.v5eDefaultFilter || 'all');
			}

			function initAllSchedules() {
				document.querySelectorAll('.v5e-schedule').forEach(initSchedule);
			}

			if (document.readyState === 'loading') {
				document.addEventListener('DOMContentLoaded', initAllSchedules);
			} else {
				initAllSchedules();
			}
		})();
	</script>
	<?php
}
