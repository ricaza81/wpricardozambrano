<?php
defined( 'ABSPATH' ) or die( 'Cheatin\' uh?' );

define( 'WP_ROCKET_ADVANCED_CACHE', true );
$rocket_cache_path = 'C:\xampp\htdocs\ricardozambrano/wp-content/cache/wp-rocket/';
$rocket_config_path = 'C:\xampp\htdocs\ricardozambrano/wp-content/wp-rocket-config/';

if ( file_exists( 'C:\xampp\htdocs\ricardozambrano\wp-content\plugins\wp-rocket\inc\front/process.php' ) ) {
	include( 'C:\xampp\htdocs\ricardozambrano\wp-content\plugins\wp-rocket\inc\front/process.php' );
} else {
	define( 'WP_ROCKET_ADVANCED_CACHE_PROBLEM', true );
}