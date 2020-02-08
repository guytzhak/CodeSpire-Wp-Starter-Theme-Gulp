<?php
/**
 * Transient Loader Class
 *
 * Give the ability to save blocks and update them when the content of the site is save/create/update/delete
 */

if ( ! class_exists( 'Codespire_Transient_Loader' ) ) {
	/**
	 * A class that provides a way to add `async` or `defer` attributes to scripts.
	 */
	class Codespire_Transient_Loader {
		
		static $prefix = 'cstl_';
		private $actions = [
			'menu' => [
				'main_menu' => ['main_menu', 'cs_get_header_menu', 'main_menu'],
			],
			'post_type' => [
			
			]
		];
		
		public static function cs_get_transient($name) {
			return get_transient(self::$prefix . $name) ? get_transient(self::$prefix . $name) : false;
		}
		
		public static function cs_set_transients($name, $value) {
			return isset($value) && !empty($value) ? set_transient(self::$prefix . $name, $value) : false;
		}
		
		public static function cs_delete_transient($name) {
			return delete_transient(self::$prefix . $name);
		}
		
		public static function refresh_transient($name, $func, $args) {
			self::cs_delete_transient(self::$prefix . $name);
			return call_user_func_array($func, $args);
		}
		
	}
}