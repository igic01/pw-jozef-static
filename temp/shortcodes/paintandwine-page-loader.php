<?php
/**
 * Plugin Name: Paint and Wine Page Loader
 * Description: Adds a branded page loader outside cart and checkout.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function paintandwine_should_show_page_loader() {
	if ( is_admin() || wp_doing_ajax() ) {
		return false;
	}

	if ( function_exists( 'is_cart' ) && is_cart() ) {
		return false;
	}

	if ( function_exists( 'is_checkout' ) && is_checkout() ) {
		return false;
	}

	return true;
}

add_action(
	'wp_body_open',
	function () {
		if ( ! paintandwine_should_show_page_loader() ) {
			return;
		}
		?>
		<script>
			document.body.classList.add("paw-page-loading");
		</script>
		<div id="paw-page-loader" class="paw-page-loader" aria-hidden="true">
			<div class="paw-page-loader__mark">
				<img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/04/logo.png' ) ); ?>" alt="" />
			</div>
		</div>
		<noscript>
			<style>
				#paw-page-loader {
					display: none !important;
				}
			</style>
		</noscript>
		<?php
	},
	1
);

add_action(
	'wp_head',
	function () {
		if ( ! paintandwine_should_show_page_loader() ) {
			return;
		}
		?>
		<style>
			body.paw-page-loading {
				overflow: hidden;
			}

			.paw-page-loader {
				--paw-loader-red: #bf2020;
				--paw-loader-paper: #f7f3ec;
				position: fixed;
				inset: 0;
				z-index: 999999;
				display: grid;
				place-items: center;
				background:
					linear-gradient(90deg, rgba(0, 0, 0, 0.04) 0, rgba(0, 0, 0, 0.04) 1px, transparent 1px, transparent 120px),
					linear-gradient(180deg, rgba(191, 32, 32, 0.03), rgba(191, 32, 32, 0.03)),
					var(--paw-loader-paper);
				background-size: 120px 100%, 100% 100%, auto;
				opacity: 1;
				visibility: visible;
				transition: opacity 0.45s ease, visibility 0.45s ease;
			}

			.paw-page-loader::before {
				content: "";
				position: absolute;
				inset: 20px;
				border: 1px solid rgba(0, 0, 0, 0.14);
				pointer-events: none;
			}

			.paw-page-loader__mark {
				position: relative;
				display: grid;
				place-items: center;
				width: clamp(130px, 18vw, 230px);
				aspect-ratio: 1;
				animation: paw-loader-float 1.45s ease-in-out infinite;
			}

			.paw-page-loader__mark::before,
			.paw-page-loader__mark::after {
				content: "";
				position: absolute;
				inset: 0;
				border: 1px solid rgba(191, 32, 32, 0.35);
				border-radius: 50%;
				animation: paw-loader-ring 1.45s ease-out infinite;
			}

			.paw-page-loader__mark::after {
				animation-delay: 0.35s;
			}

			.paw-page-loader__mark img {
				position: relative;
				z-index: 1;
				display: block;
				width: 72%;
				height: auto;
				filter: drop-shadow(0 16px 28px rgba(0, 0, 0, 0.12));
				animation: paw-loader-pulse 1.45s ease-in-out infinite;
			}

			body:not(.paw-page-loading) .paw-page-loader,
			.paw-page-loader.is-hidden {
				opacity: 0;
				visibility: hidden;
				pointer-events: none;
			}

			@keyframes paw-loader-float {
				0%,
				100% {
					transform: translateY(0);
				}

				50% {
					transform: translateY(-8px);
				}
			}

			@keyframes paw-loader-pulse {
				0%,
				100% {
					transform: scale(1);
				}

				50% {
					transform: scale(1.045);
				}
			}

			@keyframes paw-loader-ring {
				0% {
					opacity: 0.65;
					transform: scale(0.72);
				}

				100% {
					opacity: 0;
					transform: scale(1.18);
				}
			}

			@media (prefers-reduced-motion: reduce) {
				.paw-page-loader,
				.paw-page-loader__mark,
				.paw-page-loader__mark::before,
				.paw-page-loader__mark::after,
				.paw-page-loader__mark img {
					animation: none;
					transition: none;
				}
			}
		</style>
		<?php
	},
	1
);

add_action(
	'wp_footer',
	function () {
		if ( ! paintandwine_should_show_page_loader() ) {
			return;
		}
		?>
		<script>
			(function () {
				const loader = document.getElementById("paw-page-loader");

				function hideLoader() {
					document.body.classList.remove("paw-page-loading");
					if (!loader) return;
					loader.classList.add("is-hidden");
					window.setTimeout(function () {
						if (loader && loader.parentNode) {
							loader.parentNode.removeChild(loader);
						}
					}, 600);
				}

				if (document.readyState === "complete") {
					hideLoader();
				} else {
					window.addEventListener("load", hideLoader, { once: true });
					window.setTimeout(hideLoader, 2800);
				}
			})();
		</script>
		<?php
	},
	100
);
