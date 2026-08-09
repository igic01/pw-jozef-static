<?php
/**
 * Plugin Name: Paint and Wine Header Shortcode
 * Description: Provides the [paint_wine_header] shortcode.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action(
	'init',
	function () {
		add_shortcode( 'paint_wine_header', 'paint_wine_render_header_shortcode' );
	}
);

function paint_wine_render_header_shortcode() {
	static $assets_rendered = false;

	ob_start();

	if ( ! $assets_rendered ) {
		$assets_rendered = true;
		?>
		<style>
			.paw-header-shortcode.v4e-navbar {
				--v4e-red: #bf2020;
				--v4e-paper: #f7f3ec;
				--v4e-ink: #111111;
				--v4e-soft-ink: #1a1a1a;
				position: relative;
				z-index: 999;
				width: 100%;
				color: var(--v4e-ink);
				background:
					linear-gradient(180deg, rgba(255, 255, 255, 0.82), rgba(247, 243, 236, 0.74)),
					rgba(247, 243, 236, 0.78);
				border: 1px solid rgba(0, 0, 0, 0.16);
				box-shadow: 0 14px 36px rgba(0, 0, 0, 0.14);
				backdrop-filter: blur(14px);
				font-family: "Open Sans Local", Arial, sans-serif;
				isolation: isolate;
				overflow: visible;
			}

			.paw-header-shortcode.v4e-navbar,
			.paw-header-shortcode.v4e-navbar * {
				box-sizing: border-box;
			}

			.paw-header-shortcode.v4e-navbar::before {
				content: "";
				position: absolute;
				inset: 20px;
				border: 1px solid rgba(0, 0, 0, 0.12);
				pointer-events: none;
				z-index: -1;
			}

			.paw-header-shortcode.v4e-navbar::after {
				content: "";
				position: absolute;
				inset: 0;
				background:
					linear-gradient(90deg, rgba(0, 0, 0, 0.04) 0, rgba(0, 0, 0, 0.04) 1px, transparent 1px, transparent 118px),
					linear-gradient(180deg, rgba(191, 32, 32, 0.04), rgba(191, 32, 32, 0.02));
				opacity: 0.7;
				pointer-events: none;
				z-index: -2;
			}

			.paw-header-shortcode .v4e-navbar-inner {
				display: grid;
				grid-template-columns: minmax(150px, 0.6fr) minmax(0, 1080px) minmax(150px, 0.6fr);
				align-items: center;
				gap: clamp(14px, 2vw, 28px);
				width: min(1440px, 100%);
				min-height: 100px;
				margin: 0 auto;
				padding: 14px clamp(18px, 4vw, 42px);
			}

			.paw-header-shortcode .v4e-navbar-logo {
				display: inline-flex;
				align-items: center;
				justify-self: start;
				width: clamp(92px, 9vw, 132px);
				min-width: 92px;
			}

			.paw-header-shortcode .v4e-navbar-logo img {
				display: block;
				width: 100%;
				height: auto;
				max-height: 58px;
				object-fit: contain;
			}

			.paw-header-shortcode .v4e-navbar-menu {
				display: grid;
				grid-template-columns: repeat(8, minmax(0, 1fr));
				gap: clamp(5px, 0.72vw, 12px);
				width: 100%;
				min-width: 0;
			}

			.paw-header-shortcode .v4e-navbar-menu a {
				display: inline-flex;
				align-items: center;
				justify-content: center;
				min-height: 42px;
				padding: 0 6px;
				color: var(--v4e-soft-ink);
				border: 1px solid transparent;
				font-size: clamp(0.68rem, 0.72vw, 0.82rem);
				font-weight: 800;
				letter-spacing: 0.04em;
				line-height: 1.2;
				text-align: center;
				text-decoration: none;
				text-transform: uppercase;
				transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
			}

			.paw-header-shortcode .v4e-navbar-menu a:hover,
			.paw-header-shortcode .v4e-navbar-menu a:focus-visible {
				color: var(--v4e-paper);
				background: var(--v4e-red);
				border-color: var(--v4e-red);
				outline: none;
			}

			.paw-header-shortcode .v4e-navbar-actions {
				display: flex;
				align-items: center;
				justify-content: flex-end;
				justify-self: end;
				gap: 10px;
				min-height: 46px;
				overflow: visible;
			}

			.paw-header-shortcode .v4e-navbar-toggle {
				display: none;
				align-items: center;
				justify-content: center;
				width: 46px;
				height: 46px;
				color: var(--v4e-ink);
				background: rgba(255, 255, 255, 0.66);
				border: 1px solid rgba(0, 0, 0, 0.16);
				cursor: pointer;
			}

			.paw-header-shortcode .v4e-navbar-toggle svg {
				width: 20px;
				height: 20px;
			}

			.paw-header-shortcode .v4e-navbar-translate {
				position: relative;
				z-index: 1001;
				display: inline-flex;
				align-items: center;
				justify-content: center;
				width: auto;
				min-width: 0;
				height: 46px;
				padding: 0;
				background: rgba(255, 255, 255, 0.66);
				border: 1px solid rgba(0, 0, 0, 0.16);
				overflow: visible;
			}

			.paw-header-shortcode .v4e-language-dropdown {
				position: relative;
				display: inline-flex;
				align-items: center;
				height: 100%;
			}

			.paw-header-shortcode .v4e-language-toggle {
				display: inline-flex;
				align-items: center;
				justify-content: center;
				gap: 8px;
				min-width: 58px;
				height: 44px;
				padding: 0 10px;
				color: var(--v4e-ink);
				background: transparent;
				border: 0;
				cursor: pointer;
			}

			.paw-header-shortcode .v4e-language-toggle:focus-visible {
				outline: none;
				box-shadow: inset 0 0 0 1px rgba(191, 32, 32, 0.42);
			}

			.paw-header-shortcode .v4e-language-current {
				display: inline-flex;
				align-items: center;
				justify-content: center;
				width: 24px;
				height: 24px;
			}

			.paw-header-shortcode .v4e-language-arrow {
				width: 14px;
				height: 14px;
				transition: transform 0.25s ease;
			}

			.paw-header-shortcode .v4e-language-dropdown.is-open .v4e-language-arrow {
				transform: rotate(180deg);
			}

			.paw-header-shortcode .v4e-language-options {
				position: absolute;
				top: calc(100% + 6px);
				right: 0;
				display: grid;
				gap: 6px;
				min-width: 58px;
				padding: 8px;
				background: rgba(247, 243, 236, 0.98);
				border: 1px solid rgba(0, 0, 0, 0.16);
				box-shadow: 0 14px 30px rgba(0, 0, 0, 0.14);
				opacity: 0;
				visibility: hidden;
				transform: translateY(-4px);
				transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s ease;
			}

			.paw-header-shortcode .v4e-language-dropdown.is-open .v4e-language-options {
				opacity: 1;
				visibility: visible;
				transform: translateY(0);
			}

			.paw-header-shortcode .v4e-language-options a {
				display: inline-flex;
				align-items: center;
				justify-content: center;
				width: 36px;
				height: 32px;
				color: inherit;
				text-decoration: none;
				border: 1px solid transparent;
				transition: border-color 0.2s ease, background-color 0.2s ease;
			}

			.paw-header-shortcode .v4e-language-options a:hover,
			.paw-header-shortcode .v4e-language-options a:focus-visible,
			.paw-header-shortcode .v4e-language-options .gt-current-lang {
				background: rgba(191, 32, 32, 0.08);
				border-color: rgba(191, 32, 32, 0.42);
				outline: none;
			}

			.paw-header-shortcode .v4e-navbar-translate img {
				display: block;
				width: 24px !important;
				height: 24px !important;
				max-width: 24px;
				max-height: 24px;
				object-fit: cover;
			}

			.paw-header-shortcode .v4e-language-options span {
				position: absolute;
				width: 1px;
				height: 1px;
				padding: 0;
				margin: -1px;
				overflow: hidden;
				clip: rect(0, 0, 0, 0);
				white-space: nowrap;
				border: 0;
			}

			.paw-header-shortcode .v4e-navbar-cart {
				position: relative;
				z-index: 1001;
				display: inline-flex;
				align-items: center;
				justify-content: center;
				width: 46px;
				height: 46px;
				padding: 0;
				background: transparent;
				border: 0;
				overflow: visible;
			}

			.paw-header-shortcode .v4e-navbar-cart > *,
			.paw-header-shortcode .v4e-navbar-cart a,
			.paw-header-shortcode .v4e-navbar-cart .widget,
			.paw-header-shortcode .v4e-navbar-cart .woocommerce,
			.paw-header-shortcode .v4e-navbar-cart [class*="mini-cart"],
			.paw-header-shortcode .v4e-navbar-cart [class*="cart"] {
				display: inline-flex;
				align-items: center;
				justify-content: center;
				margin: 0;
				line-height: 1;
			}

			@media (max-width: 1180px) {
				.paw-header-shortcode .v4e-navbar-inner {
					grid-template-columns: auto auto 1fr;
				}

				.paw-header-shortcode .v4e-navbar-toggle {
					display: inline-flex;
					order: 2;
				}

				.paw-header-shortcode .v4e-navbar-actions {
					order: 3;
				}

				.paw-header-shortcode .v4e-navbar-menu {
					grid-column: 1 / -1;
					order: 4;
					display: none;
					grid-template-columns: repeat(2, minmax(0, 1fr));
					padding: 14px 0 4px;
					border-top: 1px solid rgba(0, 0, 0, 0.14);
				}

				.paw-header-shortcode.is-open .v4e-navbar-menu {
					display: grid;
				}
			}

			@media (max-width: 640px) {
				.paw-header-shortcode.v4e-navbar::before {
					inset: 12px;
				}

				.paw-header-shortcode .v4e-navbar-inner {
					grid-template-columns: 1fr auto auto;
					gap: 8px;
					min-height: 72px;
					padding: 12px 14px;
				}

				.paw-header-shortcode .v4e-navbar-logo {
					width: 88px;
					min-width: 88px;
				}

				.paw-header-shortcode .v4e-navbar-actions {
					gap: 8px;
				}

				.paw-header-shortcode .v4e-navbar-translate {
					height: 42px;
				}

				.paw-header-shortcode .v4e-language-toggle {
					min-width: 54px;
					height: 40px;
					padding: 0 8px;
					gap: 6px;
				}

				.paw-header-shortcode .v4e-navbar-menu {
					grid-template-columns: 1fr;
					gap: 8px;
				}
			}

			@media (max-width: 420px) {
				.paw-header-shortcode .v4e-navbar-inner {
					grid-template-columns: auto 1fr auto;
				}

				.paw-header-shortcode .v4e-navbar-logo {
					width: 78px;
					min-width: 78px;
				}

				.paw-header-shortcode .v4e-navbar-actions {
					grid-column: 1 / -1;
					width: 100%;
					justify-content: flex-end;
				}
			}
		</style>
		<script>
			document.addEventListener("click", function (event) {
				const toggle = event.target.closest(".paw-header-shortcode .v4e-navbar-toggle");
				if (toggle) {
					const navbar = toggle.closest(".paw-header-shortcode");
					const isOpen = navbar.classList.toggle("is-open");
					toggle.setAttribute("aria-expanded", String(isOpen));
					toggle.setAttribute("aria-label", isOpen ? "Zatvori meni" : "Otvori meni");
					return;
				}

				const languageToggle = event.target.closest(".paw-header-shortcode .v4e-language-toggle");
				if (languageToggle) {
					event.stopPropagation();
					const languageDropdown = languageToggle.closest(".v4e-language-dropdown");
					const isOpen = languageDropdown.classList.toggle("is-open");
					languageToggle.setAttribute("aria-expanded", String(isOpen));
					return;
				}

				document.querySelectorAll(".paw-header-shortcode .v4e-language-dropdown.is-open").forEach(function (dropdown) {
					if (!dropdown.contains(event.target)) {
						dropdown.classList.remove("is-open");
						const dropdownToggle = dropdown.querySelector(".v4e-language-toggle");
						if (dropdownToggle) dropdownToggle.setAttribute("aria-expanded", "false");
					}
				});
			});

			document.addEventListener("DOMContentLoaded", function () {
				document.querySelectorAll(".paw-header-shortcode").forEach(function (navbar) {
					const menu = navbar.querySelector(".v4e-navbar-menu");
					const toggle = navbar.querySelector(".v4e-navbar-toggle");
					if (menu && toggle) {
						menu.querySelectorAll("a").forEach(function (link) {
							link.addEventListener("click", function () {
								navbar.classList.remove("is-open");
								toggle.setAttribute("aria-expanded", "false");
								toggle.setAttribute("aria-label", "Otvori meni");
							});
						});
					}

					const languageDropdown = navbar.querySelector(".v4e-language-dropdown");
					if (!languageDropdown) return;

					const languageCurrent = languageDropdown.querySelector(".v4e-language-current");
					const languageOptions = languageDropdown.querySelector(".v4e-language-options");
					const languageLinks = languageOptions ? Array.from(languageOptions.querySelectorAll("a")) : [];
					if (!languageCurrent || !languageLinks.length) return;

					function setCurrentLanguage(link) {
						if (!link) return;
						const flag = link.querySelector("img");
						languageCurrent.innerHTML = "";

						if (flag) {
							languageCurrent.appendChild(flag.cloneNode(true));
							return;
						}

						languageCurrent.textContent = link.textContent.trim().slice(0, 2).toUpperCase();
					}

					const currentLanguage = languageOptions.querySelector(".gt-current-lang");
					setCurrentLanguage((currentLanguage && currentLanguage.closest("a")) || languageLinks[0]);

					languageLinks.forEach(function (link) {
						link.addEventListener("click", function () {
							setCurrentLanguage(link);
							languageDropdown.classList.remove("is-open");
							const languageToggle = languageDropdown.querySelector(".v4e-language-toggle");
							if (languageToggle) languageToggle.setAttribute("aria-expanded", "false");
						});
					});
				});
			});

			document.addEventListener("keydown", function (event) {
				if (event.key !== "Escape") return;
				document.querySelectorAll(".paw-header-shortcode .v4e-language-dropdown.is-open").forEach(function (dropdown) {
					dropdown.classList.remove("is-open");
					const dropdownToggle = dropdown.querySelector(".v4e-language-toggle");
					if (dropdownToggle) dropdownToggle.setAttribute("aria-expanded", "false");
				});
			});
		</script>
		<?php
	}
	?>
	<nav class="v4e-navbar paw-header-shortcode" aria-label="Main navigation">
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

	return ob_get_clean();
}
