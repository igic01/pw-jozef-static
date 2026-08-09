<?php
/**
 * Plugin Name: Paint and Wine Product Page Design
 * Description: Scoped product page styling for WooCommerce.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action(
	'wp_enqueue_scripts',
	function () {
		if ( ! paintandwine_is_product_or_cart_page() ) {
			return;
		}

		$dependencies = wp_style_is( 'hello-commerce-woocommerce', 'enqueued' )
			? [ 'hello-commerce-woocommerce' ]
			: [];

		wp_enqueue_style(
			'paintandwine-product-design',
			content_url( 'mu-plugins/assets/product-page.css' ),
			$dependencies,
			'20260610-17'
		);
	},
	30
);

function paintandwine_is_product_page() {
	return function_exists( 'is_product' ) && is_product();
}

function paintandwine_is_cart_page() {
	return function_exists( 'is_cart' ) && is_cart();
}

function paintandwine_is_product_or_cart_page() {
	return paintandwine_is_product_page() || paintandwine_is_cart_page();
}

add_action(
	'wp',
	function () {
		if ( ! paintandwine_is_product_page() ) {
			return;
		}

		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	},
	20
);

function paintandwine_get_product_event_date( $product_id ) {
	$field_names = array( 'event_date', 'Event Date', 'event date' );

	foreach ( $field_names as $field_name ) {
		$value = '';

		if ( function_exists( 'get_field' ) ) {
			$value = get_field( $field_name, $product_id );
		}

		if ( '' === $value || null === $value ) {
			$value = get_post_meta( $product_id, $field_name, true );
		}

		if ( is_array( $value ) ) {
			$value = implode( ', ', array_filter( array_map( 'strval', $value ) ) );
		}

		$value = trim( (string) $value );

		if ( '' !== $value ) {
			return $value;
		}
	}

	return '';
}

add_action(
	'woocommerce_single_product_summary',
	function () {
		if ( ! paintandwine_is_product_page() ) {
			return;
		}

		global $product;

		if ( ! $product instanceof WC_Product ) {
			return;
		}

		$event_date = paintandwine_get_product_event_date( $product->get_id() );

		if ( '' === $event_date ) {
			return;
		}

		echo '<p class="paw-product-event-date">' . esc_html( $event_date ) . '</p>';
	},
	9
);

add_filter(
	'woocommerce_related_products',
	function ( $related_posts ) {
		return paintandwine_is_product_page() ? array() : $related_posts;
	},
	20
);

add_filter(
	'render_block',
	function ( $block_content, $block ) {
		if ( ! paintandwine_is_product_or_cart_page() || empty( $block['blockName'] ) ) {
			return $block_content;
		}

		if ( paintandwine_is_product_page() && 'woocommerce/related-products' === $block['blockName'] ) {
			return '';
		}

		if ( 'core/template-part' === $block['blockName'] ) {
			$attrs = isset( $block['attrs'] ) && is_array( $block['attrs'] ) ? $block['attrs'] : array();
			$slug  = isset( $attrs['slug'] ) ? $attrs['slug'] : '';
			$area  = isset( $attrs['area'] ) ? $attrs['area'] : '';

			if ( 'footer' === $slug || 'footer' === $area ) {
				return '';
			}
		}

		return $block_content;
	},
	20,
	2
);

add_filter(
	'hello-plus-theme/display-default-footer',
	function ( $display ) {
		return paintandwine_is_product_or_cart_page() ? false : $display;
	},
	20
);

add_action(
	'wp_body_open',
	function () {
		if ( ! paintandwine_is_product_or_cart_page() ) {
			return;
		}
		?>
		<nav class="v4e-navbar paw-product-navbar" aria-label="Main navigation">
			<div class="v4e-navbar-inner">
				<a class="v4e-navbar-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Paint and Wine pocetna">
					<img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/04/logo.png' ) ); ?>" alt="Paint and Wine" />
				</a>

				<button class="v4e-navbar-toggle" type="button" aria-label="Otvori meni" aria-expanded="false">
					<svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2">
						<path d="M4 7h16M4 12h16M4 17h16" />
					</svg>
				</button>

				<div class="v4e-navbar-menu">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Po&#269;etna</a>
					<a href="<?php echo esc_url( home_url( '/raspored' ) ); ?>">Raspored</a>
					<a href="<?php echo esc_url( home_url( '/privatne-radionice' ) ); ?>">Privatne radionice</a>
					<a href="<?php echo esc_url( home_url( '/paint-and-kids' ) ); ?>">Paint and Kids</a>
					<a href="<?php echo esc_url( home_url( '/neon-paint-and-cocktails/' ) ); ?>">Neon paint and cocktails</a>
					<a href="<?php echo esc_url( home_url( '/pw-shop' ) ); ?>">P &amp; W Shop</a>
					<a href="<?php echo esc_url( home_url( '/o-nama' ) ); ?>">O nama</a>
					<a href="<?php echo esc_url( home_url( '/galerija' ) ); ?>">Galerija</a>
				</div>

				<div class="v4e-navbar-actions">
					<div class="v4e-navbar-translate" aria-label="Language selector">
						<div class="v4e-language-dropdown">
							<button class="v4e-language-toggle" type="button" aria-label="Promijeni jezik" aria-expanded="false">
								<span class="v4e-language-current" aria-hidden="true"></span>
								<svg class="v4e-language-arrow" viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2">
									<path d="m6 9 6 6 6-6" />
								</svg>
							</button>

							<div class="v4e-language-options">
								<?php echo do_shortcode( '[gt-link lang="sr" label="Crnogorski" widget_look="flags_name"]' ); ?>
								<?php echo do_shortcode( '[gt-link lang="en" label="English" widget_look="flags_name"]' ); ?>
								<?php echo do_shortcode( '[gt-link lang="sq" label="Albanian" widget_look="flags_name"]' ); ?>
								<?php echo do_shortcode( '[gt-link lang="ru" label="Russian" widget_look="flags_name"]' ); ?>
							</div>
						</div>
					</div>

					<div class="v4e-navbar-cart" aria-label="Korpa">
						<?php echo do_shortcode( '[whmc_mini_cart]' ); ?>
					</div>
				</div>
			</div>
		</nav>
		<?php
	},
	5
);

add_action(
	'wp_footer',
	function () {
		if ( ! paintandwine_is_product_or_cart_page() ) {
			return;
		}
		?>
		<div class="paw-product-footer">
			<?php echo do_shortcode( '[paint_wine_footer]' ); ?>
		</div>
		<?php
	},
	20
);

add_action(
	'wp_footer',
	function () {
		if ( ! paintandwine_is_product_or_cart_page() ) {
			return;
		}
		?>
		<script>
			(function () {
				const navbar = document.querySelector(".paw-product-navbar");
				if (!navbar) return;

				const toggle = navbar.querySelector(".v4e-navbar-toggle");
				const menu = navbar.querySelector(".v4e-navbar-menu");
				if (toggle && menu) {
					toggle.addEventListener("click", function () {
						const isOpen = navbar.classList.toggle("is-open");
						toggle.setAttribute("aria-expanded", String(isOpen));
						toggle.setAttribute("aria-label", isOpen ? "Zatvori meni" : "Otvori meni");
					});

					menu.querySelectorAll("a").forEach(function (link) {
						link.addEventListener("click", function () {
							navbar.classList.remove("is-open");
							toggle.setAttribute("aria-expanded", "false");
							toggle.setAttribute("aria-label", "Otvori meni");
						});
					});
				}

				const languageDropdown = navbar.querySelector(".v4e-language-dropdown");
				if (languageDropdown) {
					const languageToggle = languageDropdown.querySelector(".v4e-language-toggle");
					const languageCurrent = languageDropdown.querySelector(".v4e-language-current");
					const languageOptions = languageDropdown.querySelector(".v4e-language-options");
					const languageLinks = languageOptions ? Array.from(languageOptions.querySelectorAll("a")) : [];

					function setCurrentLanguage(link) {
						if (!link || !languageCurrent) return;
						const flag = link.querySelector("img");
						languageCurrent.innerHTML = "";
						if (flag) {
							languageCurrent.appendChild(flag.cloneNode(true));
							return;
						}
						languageCurrent.textContent = link.textContent.trim().slice(0, 2).toUpperCase();
					}

					function closeLanguageDropdown() {
						languageDropdown.classList.remove("is-open");
						if (languageToggle) languageToggle.setAttribute("aria-expanded", "false");
					}

					if (languageToggle && languageOptions) {
						const currentLanguage = languageOptions.querySelector(".gt-current-lang");
						setCurrentLanguage((currentLanguage && currentLanguage.closest("a")) || languageLinks[0]);

						languageToggle.addEventListener("click", function (event) {
							event.stopPropagation();
							const isOpen = languageDropdown.classList.toggle("is-open");
							languageToggle.setAttribute("aria-expanded", String(isOpen));
						});

						languageLinks.forEach(function (link) {
							link.addEventListener("click", function () {
								setCurrentLanguage(link);
								closeLanguageDropdown();
							});
						});

						document.addEventListener("click", function (event) {
							if (!languageDropdown.contains(event.target)) {
								closeLanguageDropdown();
							}
						});

						document.addEventListener("keydown", function (event) {
							if (event.key === "Escape") {
								closeLanguageDropdown();
							}
						});
					}
				}
			})();

			document.querySelectorAll(".wp-block-woocommerce-product-details").forEach(function (details) {
				if (!details.textContent.trim()) {
					details.hidden = true;
				}
			});
		</script>
		<?php
	},
	30
);
