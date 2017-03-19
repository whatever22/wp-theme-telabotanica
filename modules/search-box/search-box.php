<?php function telabotanica_module_search_box($data) {
	$defaults = [
		'id' => false,
		'autocomplete' => true,
		'action' => home_url( '/' ),
		'input_id' => false,
		'input_name' => 's',
		'placeholder' => __('Rechercher une plante, un projet, un mot clé...', 'telabotanica'),
		'value' => get_search_query(),
		'index' => false,
		'suggestions' => false,
		'modifiers' => ['large']
	];

	$data = telabotanica_styleguide_data($defaults, $data);
	$data->modifiers = telabotanica_styleguide_modifiers_array('search-box', $data->modifiers);

	printf(
		'<div class="%s" id="%s" data-autocomplete="%s">',
		implode(' ', $data->modifiers),
		esc_attr($data->id),
		var_export($data->autocomplete, true)
	);
		printf(
			'<form role="search" method="get" action="%s" class="search-box-wrapper">',
			esc_url( $data->action )
		);
			printf(
				'<input name="%s" id="%s" type="text" class="search-box-input" placeholder="%s" value="%s" autocomplete="off" spellcheck="false" />',
				esc_attr($data->input_name),
				esc_attr($data->input_id),
				esc_attr($data->placeholder),
				esc_attr($data->value)
			);
			if ($data->index) :
				printf(
					'<input name="index" type="hidden" value="%s" />',
					esc_attr($data->index)
				);
			endif;
			printf(
				'<button type="submit" class="search-box-button">%s</button>',
				get_telabotanica_module('icon', ['icon' => 'search'])
			);
		echo '</form>';

		if ( $data->suggestions ) :
			$suggestions = array_map(function($suggestion) {
				return sprintf(
					'<a href="%s">%s</a>',
					'#' . $suggestion, // TODO compose URL to search results
					$suggestion
				);
			}, $data->suggestions);

			printf(
				'<div class="search-box-suggestions">%s</div>',
				sprintf(
					__('Par exemple : %s...', 'telabotanica'),
					implode($suggestions, ', ')
				)
			);
		endif;

	echo '</div>';
}
