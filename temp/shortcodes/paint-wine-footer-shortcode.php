<?php
/**
 * Plugin Name: Paint & Wine Footer Shortcode
 * Description: Provides the [paint_wine_footer] shortcode for Elementor and page content.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'paint_wine_register_footer_shortcode' );

function paint_wine_register_footer_shortcode() {
	add_shortcode( 'paint_wine_footer', 'paint_wine_render_footer_shortcode' );
}

function paint_wine_render_footer_shortcode() {
	ob_start();
	paint_wine_render_footer_assets();
	?>
	<footer class="v4e-footer" aria-label="Paint and Wine footer">
		<div class="v4e-footer-inner">
			<section class="v4e-footer-main" aria-label="O Paint and Wine">
				<h2 class="v4e-footer-title">Paint &amp; Wine</h2>

				<p class="v4e-footer-text">
					Paint&amp;Wine su slikarske radionice za amatere i ljude bez ikakvog slikarskog iskustva
					sa neograničenom konzumacijom vrhunskog vina.
				</p>
			</section>

			<nav class="v4e-footer-nav" aria-label="Footer navigation">
				<h2 class="v4e-footer-heading">Korisni linkovi</h2>
				<ul class="v4e-footer-links">
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
					<li><a href="<?php echo esc_url( home_url( '/raspored' ) ); ?>">Raspored</a></li>
					<li><a href="<?php echo esc_url( home_url( '/privatne-radionice' ) ); ?>">Privatne radionice</a></li>
					<li><a href="<?php echo esc_url( home_url( '/paint-and-kids' ) ); ?>">Paint and Kids</a></li>
					<li><a href="<?php echo esc_url( home_url( '/neon-paint-and-cocktails/' ) ); ?>">NPC</a></li>
					<li><a href="<?php echo esc_url( home_url( '/pw-shop' ) ); ?>">PW Shop</a></li>
					<li><a href="<?php echo esc_url( home_url( '/o-nama' ) ); ?>">O nama</a></li>
					<li><a href="<?php echo esc_url( home_url( '/galerija' ) ); ?>">Galerija</a></li>
				</ul>
			</nav>

			<section class="v4e-footer-location" aria-label="Korisne informacije">
				<div class="v4e-footer-contact" aria-label="Kontakt">
					<h2 class="v4e-footer-heading">Korisne informacije</h2>
					<address class="v4e-footer-address">Adresa: 27 Piperska, Podgorica 81000, Montenegro</address>
					<a href="tel:+38269595059">Telefon: +382 69 595 059</a>
					<a href="mailto:paintandwinepg@gmail.com">E-mail: paintandwinepg@gmail.com</a>
				</div>

				<div class="v4e-footer-map">
					<iframe
						src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2943.6629590449647!2d19.263971100000003!3d42.4561868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x134d95595000a703%3A0xef311651c4b95e9c!2sPaint%20and%20Wine%20Podgorica!5e0!3m2!1sen!2ssk!4v1781190119315!5m2!1sen!2ssk"
						width="600"
						height="450"
						style="border:0;"
						allowfullscreen=""
						loading="lazy"
						referrerpolicy="no-referrer-when-downgrade"
						title="Paint and Wine Podgorica mapa"></iframe>
				</div>
			</section>
		</div>

		<div class="v4e-footer-bottom">
			<p>Paint &amp; Wine Podgorica</p>
			<p>Radionice, vino i druženje</p>
		</div>
	</footer>
	<?php
	return ob_get_clean();
}

function paint_wine_render_footer_assets() {
	static $rendered = false;

	if ( $rendered ) {
		return;
	}

	$rendered = true;
	?>
	<style>
		@font-face {
			font-family: 'Archivo Black';
			src: url('<?php echo esc_url( content_url( 'themes/twentytwentyfive/assets/fonts/myFonts/ArchivoBlack-Regular.ttf' ) ); ?>') format('truetype');
		}

		@font-face {
			font-family: 'Open Sans Local';
			src: url('<?php echo esc_url( content_url( 'themes/twentytwentyfive/assets/fonts/myFonts/open-sans.regular%20%281%29.ttf' ) ); ?>') format('truetype');
		}

		.v4e-footer {
			--v4e-red: #bf2020;
			--v4e-paper: #f7f3ec;
			--v4e-dark: #080808;
			--v4e-ink: #f7f3ec;
			--v4e-soft-ink: rgba(247, 243, 236, 0.78);
			position: relative;
			overflow: hidden;
			color: var(--v4e-ink);
			background:
				linear-gradient(180deg, rgba(18, 18, 18, 0.96), rgba(8, 8, 8, 0.98)),
				var(--v4e-dark);
			border: 1px solid rgba(247, 243, 236, 0.16);
			box-shadow: 0 -24px 70px rgba(0, 0, 0, 0.34);
			font-family: "Open Sans Local", Arial, sans-serif;
			isolation: isolate;
		}

		.v4e-footer,
		.v4e-footer * {
			box-sizing: border-box;
		}

		.v4e-footer::before {
			content: "";
			position: absolute;
			inset: 20px;
			z-index: 1;
			border: 1px solid rgba(247, 243, 236, 0.14);
			pointer-events: none;
		}

		.v4e-footer::after {
			content: "";
			position: absolute;
			inset: 0;
			z-index: -1;
			background:
				linear-gradient(90deg, rgba(247, 243, 236, 0.055) 0, rgba(247, 243, 236, 0.055) 1px, transparent 1px, transparent 118px),
				radial-gradient(circle at 8% 24%, rgba(191, 32, 32, 0.22), transparent 20%),
				linear-gradient(180deg, rgba(191, 32, 32, 0.08), transparent 48%);
			opacity: 0.9;
			pointer-events: none;
		}

		.v4e-footer-inner {
			position: relative;
			z-index: 2;
			display: grid;
			grid-template-columns: minmax(260px, 0.95fr) minmax(180px, 0.55fr) minmax(300px, 0.9fr);
			gap: clamp(28px, 4vw, 58px);
			align-items: start;
			width: min(1320px, calc(100% - 40px));
			margin: 0 auto;
			padding: clamp(44px, 6vw, 78px) 0 clamp(28px, 4vw, 44px);
		}

		.v4e-footer-main,
		.v4e-footer-nav,
		.v4e-footer-location {
			min-width: 0;
		}

		.v4e-footer-main,
		.v4e-footer-nav,
		.v4e-footer-location,
		.v4e-footer-contact {
			display: grid;
			align-content: start;
			gap: 12px;
		}

		.v4e-footer-title,
		.v4e-footer-heading {
			margin: 0;
			color: var(--v4e-ink);
			font-family: "Archivo Black", Arial, sans-serif;
			font-weight: 400;
			line-height: 0.95;
			letter-spacing: 0;
			text-transform: uppercase;
		}

		.v4e-footer-title {
			max-width: 10ch;
			font-size: clamp(2.2rem, 4.1vw, 4.2rem);
		}

		.v4e-footer-heading {
			padding-top: 4px;
			font-size: clamp(1rem, 1.35vw, 1.35rem);
		}

		.v4e-footer-text {
			max-width: 44ch;
			margin: 0;
			color: var(--v4e-soft-ink);
			font-size: clamp(0.86rem, 0.96vw, 0.95rem);
			line-height: 1.62;
		}

		.v4e-footer-contact {
			color: var(--v4e-soft-ink);
			font-size: clamp(0.82rem, 0.92vw, 0.9rem);
			line-height: 1.5;
		}

		.v4e-footer-address,
		.v4e-footer-contact a {
			color: inherit;
			font-style: normal;
			font-weight: 700;
			text-decoration: none;
		}

		.v4e-footer-contact a {
			width: fit-content;
			transition: color 0.25s ease;
		}

		.v4e-footer-contact a:hover,
		.v4e-footer-contact a:focus-visible {
			color: var(--v4e-red);
			outline: none;
		}

		.v4e-footer-links {
			display: grid;
			gap: 9px;
			margin: 0;
			padding: 0;
			list-style: none;
		}

		.v4e-footer-links a {
			display: inline-flex;
			width: fit-content;
			color: var(--v4e-soft-ink);
			font-size: 0.76rem;
			font-weight: 800;
			letter-spacing: 0.04em;
			line-height: 1.35;
			text-decoration: none;
			text-transform: uppercase;
			transition: color 0.25s ease, transform 0.25s ease;
		}

		.v4e-footer-links a:hover,
		.v4e-footer-links a:focus-visible {
			color: var(--v4e-red);
			outline: none;
			transform: translateX(4px);
		}

		.v4e-footer-map {
			position: relative;
			min-height: 170px;
			overflow: hidden;
			background: rgba(247, 243, 236, 0.06);
			border: 1px solid rgba(247, 243, 236, 0.2);
			box-shadow: 0 20px 52px rgba(0, 0, 0, 0.46);
		}

		.v4e-footer-map iframe {
			display: block;
			width: 100%;
			height: 100%;
			min-height: 170px;
			border: 0;
			filter: grayscale(0.22) invert(0.9) hue-rotate(178deg) saturate(0.72) contrast(0.94);
		}

		.v4e-footer-bottom {
			position: relative;
			z-index: 2;
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: 18px;
			width: min(1320px, calc(100% - 40px));
			margin: 0 auto;
			padding: 18px 0 24px;
			border-top: 1px solid rgba(247, 243, 236, 0.16);
			color: rgba(247, 243, 236, 0.58);
			font-size: 0.76rem;
			font-weight: 800;
			letter-spacing: 0.08em;
			text-transform: uppercase;
		}

		.v4e-footer-bottom p {
			margin: 0;
		}

		@media (max-width: 1240px) {
			.v4e-footer-inner {
				grid-template-columns: 1fr;
			}
		}

		@media (max-width: 720px) {
			.v4e-footer::before {
				inset: 12px;
			}

			.v4e-footer-inner {
				width: 100%;
				gap: 30px;
				padding: 34px 18px 26px;
			}

			.v4e-footer-links {
				grid-template-columns: repeat(2, minmax(0, 1fr));
				column-gap: 18px;
			}

			.v4e-footer-map,
			.v4e-footer-map iframe {
				min-height: 220px;
			}

			.v4e-footer-bottom {
				width: calc(100% - 36px);
				flex-direction: column;
				align-items: flex-start;
				padding-bottom: 22px;
			}
		}

		@media (max-width: 440px) {
			.v4e-footer-links {
				grid-template-columns: 1fr;
			}

			.v4e-footer-map,
			.v4e-footer-map iframe {
				min-height: 190px;
			}
		}
	</style>
	<?php
}
