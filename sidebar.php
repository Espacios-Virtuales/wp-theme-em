<?php
/**
 * Sidebar Template
 *
 * Contiene el área principal de widgets del tema Escuela Mística.
 * Se incluye mediante `get_sidebar()` en las vistas donde se requiere
 * contenido complementario (blog, páginas, secciones especiales, etc.).
 *
 * Si no existen widgets activos, el archivo puede retornar vacío para optimizar la carga.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Escuela_Mistica
 * @subpackage Template_Parts
 * @since 1.0.0
 *
 * License: GPL-3.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * SPDX-License-Identifier: GPL-3.0-or-later
 *
 * © 2025 Espacios Virtuales — Proyecto Escuela Mística
 * Este archivo forma parte del tema Escuela Mística y se distribuye bajo los
 * términos de la GNU General Public License versión 3 o posterior.
 */

if ( ! is_active_sidebar( 'default-sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'default-sidebar' ); ?>
</aside>


if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<div class="sidebar-widget bg-light p-4 rounded shadow-sm">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</aside>