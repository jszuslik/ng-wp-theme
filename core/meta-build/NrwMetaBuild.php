<?php

class NrwMetaBuild {

	public function __construct() {
		add_action('admin_init', array( $this, 'trash_and_redirect' ));
	}

	public static function nrw_do_meta_fields($field_array, $meta) {

		$fields = '';

		$half_field = 0;

		foreach($field_array as $field_group) {
			$fields .= '<div class="nrw-crm-admin-form">';
			$fields .= '<h2 style="font-weight: bold">' . $field_group['name'] . '</h2>';

			$field_count = count($field_group['fields']);
			if($field_group['split_columns']) {
				$half_field = intdiv($field_count, 2);
				$fields .= '<div class="nrw-hlf-column">';
			} else {
				$fields .= '<div>';
			}

			$count = 0;
			foreach($field_group['fields'] as $field) {
				if($field_group['split_columns'] && $count == $half_field) {
					$fields .= '</div><div class="nrw-hlf-column">';
				}

				$type = $field['type'];
				$name = $field['name'];
				$id = $field['id'];
				$label = $field['label'];

				$btn_id = null;
				if(isset($field['btn_id']))
					$btn_id = $field['btn_id'];

				$value = null;
				if(isset($meta[$id]))
					$value = $meta[$id];

				$options = null;
				if(isset($field['options']))
					$options = $field['options'];

				$description = $field['description'];

				switch($type) {
					case 'text':
						$fields .= '<div class="nrw-admin-text-field">';
						$fields .= '<div class="nrw-admin-form-label">' . $label . '</div>';
						$fields .= '<div class="nrw-admin-form-input"><input type="' . $type . '" name="' . $name . '" id="' . $id . '" value="' . $value[0] . '" /></div>';
						$fields .= '</div>';
						break;
					case 'currency':
						$fields .= '<div class="nrw-admin-text-field">';
						$fields .= '<div class="nrw-admin-form-label">' . $label . '</div>';
						$fields .= '<div class="nrw-admin-form-input"><input type="text" data-a-sign="$ " name="' . $name . '" id="' . $id . '" value="' . $value[0] . '" /></div>';
						$fields .= '</div>';
						break;
					case 'phone':
						$fields .= '<div class="nrw-admin-text-field">';
						$fields .= '<div class="nrw-admin-form-label">' . $label . '</div>';
						$fields .= '<div class="nrw-admin-form-input"><input class="nrw_phone" type="text" name="' . $name . '" id="' . $id . '" value="' . $value[0] . '" /></div>';
						$fields .= '</div>';
						break;
					case 'dob':
						$fields .= '<div class="nrw-admin-text-field">';
						$fields .= '<div class="nrw-admin-form-label">' . $label . '</div>';
						$fields .= '<div class="nrw-admin-form-input"><input class="nrw_dob" type="text" name="' . $name . '" id="' . $id . '" value="' . $value[0] . '" /></div>';
						$fields .= '</div>';
						break;
					case 'checkbox':
						$fields .= '<div class="nrw-admin-text-field">';
						$fields .= '<div class="nrw-admin-form-label">' . $label . '</div>';

						$fields .= '<div class="nrw-admin-form-input">';
						$fields .= '<input type="hidden" name="' . $name . '" id="' . $id . '" value="0" />';
						$fields .= '<input type="checkbox" name="' . $name . '" id="' . $id . '" value="1" ' . checked ( TRUE, $value[0], false ) . ' /></div>';
						$fields .= '</div>';
						break;
					case 'textarea':

						break;
					case 'select':
						$fields .= '<div class="nrw-admin-select-field">';
						$fields .= '<div class="nrw-admin-form-label">' . $label . '</div>';
						$fields .= '<div class="nrw-admin-form-select">';
						$fields .= '<select id="' . $id . '" name="' . $name . '">';
						if($value[0] == null) {
							$fields .= '<option selected value="none">None</option>';
						} else {
							$fields .= '<option value="none">None</option>';
						}
						foreach($options as $option) {
							if($value[0] == $option->ID) {
								$fields .= '<option selected value="' . $option->ID . '">' . $option->post_title . '</option>';
							} else {
								$fields .= '<option value="' . $option->ID . '">' . $option->post_title . '</option>';
							}
						}

						$fields .= '</select>';
						$fields .= '</div>';
						$fields .= '</div>';
						break;
					case 'image':

						break;
				}
				$count++;
			}
			$fields .= '</div></div>';

			return $fields;
		}

	}

	public static function create_field_array( $array ) {

		$type = 'text';
		$name = 'Please Enter a Name';
		$id = null;
		$meta = null;
		$options = null;
		$label = __('Please Enter a Label', NRW_TEXT_DOMAIN);
		$description = '';

		if(isset($array['type'])) {
			$type = $array['type'];
		}

		if(isset($array['name'])) {
			$name = $array['name'];
		}

		if(isset($array['id'])) {
			$id = $array['id'];
		}

		if(isset($array['meta_id'])) {
			$meta = $array['meta_id'];
		}

		if(isset($array['label'])) {
			$label = $array['label'];
		}

		if(isset($array['description'])) {
			$description = $array['description'];
		}

		if(isset($array['options'])) {
			$options = $array['options'];
		}

		$meta_array = array(
				'type' => $type,
				'name' => $name,
				'id' => $id,
				'meta_id' => $meta,
				'label' => $label,
				'description' => $description,
				'options' => $options
		);

		return $meta_array;
	}

	public static function get_posts_by_post_type($post_type) {
		global $post;
		$args = array(
			'posts_per_page' => -1,
			'post_type' => $post_type,
			'post_status' => 'private'
		);
		$posts = get_posts($args);
		wp_reset_postdata();
		return $posts;
	}

	public static function list_of_states() {
		$states = array(
			'AL'=>'Alabama',
			'AK'=>'Alaska',
			'AZ'=>'Arizona',
			'AR'=>'Arkansas',
			'CA'=>'California',
			'CO'=>'Colorado',
			'CT'=>'Connecticut',
			'DE'=>'Delaware',
			'DC'=>'District of Columbia',
			'FL'=>'Florida',
			'GA'=>'Georgia',
			'HI'=>'Hawaii',
			'ID'=>'Idaho',
			'IL'=>'Illinois',
			'IN'=>'Indiana',
			'IA'=>'Iowa',
			'KS'=>'Kansas',
			'KY'=>'Kentucky',
			'LA'=>'Louisiana',
			'ME'=>'Maine',
			'MD'=>'Maryland',
			'MA'=>'Massachusetts',
			'MI'=>'Michigan',
			'MN'=>'Minnesota',
			'MS'=>'Mississippi',
			'MO'=>'Missouri',
			'MT'=>'Montana',
			'NE'=>'Nebraska',
			'NV'=>'Nevada',
			'NH'=>'New Hampshire',
			'NJ'=>'New Jersey',
			'NM'=>'New Mexico',
			'NY'=>'New York',
			'NC'=>'North Carolina',
			'ND'=>'North Dakota',
			'OH'=>'Ohio',
			'OK'=>'Oklahoma',
			'OR'=>'Oregon',
			'PA'=>'Pennsylvania',
			'RI'=>'Rhode Island',
			'SC'=>'South Carolina',
			'SD'=>'South Dakota',
			'TN'=>'Tennessee',
			'TX'=>'Texas',
			'UT'=>'Utah',
			'VT'=>'Vermont',
			'VA'=>'Virginia',
			'WA'=>'Washington',
			'WV'=>'West Virginia',
			'WI'=>'Wisconsin',
			'WY'=>'Wyoming',
		);
		return self::set_new_options($states);
	}

	public static function types_of_ownership() {
		$ownership_types = array(
			'EMP' => 'Employee',
			'OTH' => 'Other',
			'PRV' => 'Private',
			'PUB' => 'Public',
			'LLC' => 'LLC',
			'SUB' => 'Subsidary',
			'SOL' => 'Sole Proprietorship'
		);
		return self::set_new_options($ownership_types);
	}

	public static function account_types() {
		$account_types = array(
			'ANA' => 'Analyst',
			'COM' => 'Competitor',
			'CUS' => 'Customer',
			'DIS' => 'Distributor',
			'INT' => 'Integrator',
			'INV' => 'Investor',
			'OTH' => 'Other',
			'PAR' => 'Partner',
			'PRS' => 'Press',
			'PRO' => 'Prospect',
			'RES' => 'Reseller',
			'SUP' => 'Supplier',
			'VEN' => 'Vendor'
		);
		return self::set_new_options($account_types);
	}

	public static function ratings() {
		$ratings = array(
			'ACQ' => 'Acquired',
			'ACT' => 'Active',
			'MAR' => 'Market Failed',
			'CAN' => 'Project Cancelled',
			'SHD' => 'Shutdown'
		);
		return self::set_new_options($ratings);
	}

	public static function lead_source_data() {
		$lead_sources = array(
			'ADV' => 'Advertisement',
			'COL' => 'Cold Call',
			'EMR' => 'Employee Referral',
			'EXR' => 'External Referral',
			'ONL' => 'Online Store',
			'PAR' => 'Partner',
			'PUB' => 'Public Relations',
			'SMA' => 'Sales Mail Alias',
			'SEM' => 'Seminar Internal',
			'TRD' => 'Trade Show',
			'WBD' => 'Web Download',
			'WBR' => 'Web Research',
			'WBC' => 'Web Cases',
			'WBM' => 'Web Mail',
			'CHT' => 'Chat'
		);
		return $lead_sources;
	}

	public static function lead_sources() {
		return self::set_new_options(self::lead_source_data());
	}

	private static function set_new_options($options_array) {
		$options = array();
		foreach($options_array as $key => $value) {
			$options[] = new NrwOption($key, $value);
		}
		return $options;
	}

	public static function trash_and_redirect() {

	}

}
$nrw_meta_build = new NrwMetaBuild();