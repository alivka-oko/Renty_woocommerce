<?php
/**
 * Preset Factory
 *
 * Defines a couple of static methods to allow easy access to Preset classes
 *
 * @author  YITH <plugins@yithemes.com>
 * @package YITH\AjaxProductFilter\Classes\Presets
 * @version 4.0
 */

if ( ! defined( 'YITH_WCAN' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'YITH_WCAN_Presets_Factory' ) ) {
	/**
	 * Preset factory class.
	 */
	class YITH_WCAN_Presets_Factory {
		/**
		 * Retrieve a specific preset from ID or slug
		 *
		 * @param string|int|YITH_WCAN_Preset $preset  Preset id or slug.
		 *
		 * @return YITH_WCAN_Preset|bool Preset object or false on failure
		 */
		public static function get_preset( $preset ) {
			try {
				return new YITH_WCAN_Preset( $preset );
			} catch ( Exception $e ) {
				wc_caught_exception( $e, __FUNCTION__, func_get_args() );
				return false;
			}
		}

		/**
		 * Query database to count presets that matches specific parameters
		 *
		 * @param array $args Same parameters allowed for {@see get_presets}.
		 *
		 * @return int Count
		 */
		public static function count_presets( $args = array() ) {
			/**
			 * APPLY_FILTERS: yith_wcan_presets_count_query_args
			 *
			 * Filters arguments of the query used to count presets.
			 *
			 * @param array $args Default arguments.
			 *
			 * @return array
			 */
			$args = apply_filters( 'yith_wcan_presets_count_query_args', $args );

			try {
				$result = WC_Data_Store::load( 'filter_preset' )->count( $args );

				/**
				 * APPLY_FILTERS: yith_wcan_preset_count_query
				 *
				 * Filters presets count.
				 *
				 * @param int   $count Number of presets matching the query.
				 * @param array $args  Arguments of the query.
				 *
				 * @return int
				 */
				return apply_filters( 'yith_wcan_preset_count_query', $result, $args );
			} catch ( Exception $e ) {
				wc_caught_exception( $e, __FUNCTION__, func_get_args() );
				return 0;
			}
		}

		/**
		 * Queries database, to retrieve all presets matching arguments passed
		 *
		 * @param array $args Array of arguments
		 * [
		 *     'id'      => false,
		 *     'slug'    => false,
		 *     's'       => false,
		 *     'orderby' => 'ID',
		 *     'order'   => 'DESC',
		 *     'limit'   => false,
		 *     'offset'  => 0,
		 * ].
		 *
		 * @return YITH_WCAN_Preset[]|bool List of matching presets or false on failure
		 */
		public static function get_presets( $args = array() ) {
			/**
			 * APPLY_FILTERS: yith_wcan_preset_query_args
			 *
			 * Filters arguments of the query used to retrieve presets.
			 *
			 * @param array $args Default arguments.
			 *
			 * @return array
			 */
			$args = apply_filters( 'yith_wcan_preset_query_args', $args );

			try {
				$results = WC_Data_Store::load( 'filter_preset' )->query( $args );

				/**
				 * APPLY_FILTERS: yith_wcan_preset_query
				 *
				 * Filters presets set.
				 *
				 * @param array $results Presets matching the query.
				 * @param array $args    Arguments of the query.
				 *
				 * @return array
				 */
				return apply_filters( 'yith_wcan_preset_query', $results, $args );
			} catch ( Exception $e ) {
				wc_caught_exception( $e, __FUNCTION__, func_get_args() );
				return false;
			}
		}

		/**
		 * Queries database, to retrieve all presets matching arguments passed
		 *
		 * @return array|bool List of preset_id => preset_name, or false on failure.
		 */
		public static function list_presets() {
			try {
				$results = WC_Data_Store::load( 'filter_preset' )->items();

				/**
				 * APPLY_FILTERS: yith_wcan_preset_list
				 *
				 * Filters presets list.
				 *
				 * @param array $results Presets list.
				 *
				 * @return array
				 */
				return apply_filters( 'yith_wcan_preset_list', $results );
			} catch ( Exception $e ) {
				wc_caught_exception( $e, __FUNCTION__, func_get_args() );
				return false;
			}
		}

		/**
		 * Returns an array of supported layouts for the preset
		 *
		 * @return array Array of supported layouts.
		 */
		public static function get_supported_layouts() {
			/**
			 * APPLY_FILTERS: yith_wcan_supported_preset_layouts
			 *
			 * Filters presets supported layouts.
			 *
			 * @param array $layouts Supported layouts.
			 *
			 * @return array
			 */
			return apply_filters(
				'yith_wcan_supported_preset_layouts',
				array(
					'default' => _x( 'Default', '[Admin] Label in new preset page', 'yith-woocommerce-ajax-navigation' ),
				)
			);
		}
	}

	class_alias( 'YITH_WCAN_Presets_Factory', 'YITH_WCAN_Preset_Factory' );
}
