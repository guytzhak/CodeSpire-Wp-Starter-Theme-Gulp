<?php

function register_acf_block_types() {
	
	// register a testimonial block.
	acf_register_block_type(
		[
			'name'              => 'hero',
			'title'             => __('Hero', 'cs'),
			'description'       => __('A custom hero block.'),
			'render_template'   => 'template-parts/blocks/hero.php',
			'category'          => 'layout',
			'icon'              => 'welcome-view-site',
			'keywords'          => [ 'hero', 'slider' ],
		]
	);
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
	add_action('acf/init', 'register_acf_block_types');
}
