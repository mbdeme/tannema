<?php
/*
 * BP Profile Search - form template 'bps-form-legacy'
 *
 * See http://dontdream.it/bp-profile-search/form-templates/ if you wish to modify this template or develop a new one.
 *
 * Move new or modified templates to the 'buddypress/members' directory in your theme's root,
 * otherwise they will be overwritten during the next BP Profile Search update.
 *
 */

// 1st section: set the default value of the template options

if ( ! isset ( $options['collapsible'] ) ) {
	$options['collapsible'] = 'No';
}

// 2nd section: display the form to select the template options

if ( is_admin() && ! ( isset( $_GET['elementor_preview'] ) || ( isset( $_GET['action'] ) && $_GET['action'] == 'elementor' ) ) ) {
	?>
    <p><strong><?php esc_html_e( 'Collapsible Form', 'bp-profile-search' ); ?></strong></p>
    <select name="options[collapsible]">
        <option
                value='Yes' <?php selected( $options['collapsible'], 'Yes' ); ?>><?php esc_html_e( 'Yes', 'bp-profile-search' ); ?></option>
        <option
                value='No' <?php selected( $options['collapsible'], 'No' ); ?>><?php esc_html_e( 'No', 'bp-profile-search' ); ?></option>
    </select>
	<?php
	return 'end_of_options 4.9';
}

// 3rd section: display the search form

$F = bps_escaped_form_data( '4.9' );

$toggle_id = 'bps_toggle' . $F->unique_id;
$form_id   = 'bps_' . $F->location . $F->unique_id;

if ( $F->location != 'directory' ) {
	echo "<div id='buddypress'>";
} elseif ( $options['collapsible'] == 'Yes' ) {

	?>
    <div class="item-list-tabs bps_header">
        <ul>
            <li><?php esc_html_e( 'Advanced Search', 'sweetdate' ); ?></li>
            <li class="last">
                <input id="<?php echo esc_attr( $toggle_id ); ?>" type="submit"
                       value="<?php esc_html_e( 'Toggle filters', 'sweetdate' ); ?>">
            </li>
        </ul>

        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $('#<?php echo esc_attr( $form_id ); ?>').hide();
                $('#<?php echo esc_attr( $toggle_id ); ?>').click(function () {
                    $('#<?php echo esc_attr( $form_id ); ?>').toggle('slow');
                });
            });
        </script>
        <div class="clear clearfix"></div>
    </div>
	<?php
}

echo "<form action='$F->action' method='$F->method' id='$form_id' class='" . apply_filters( 'bp_search_extra_class', 'custom' ) . " form-search'>\n";

$j = 0;
foreach ( $F->fields as $f ) {
	$id      = $f->unique_id;
	$name    = $f->html_name;
	$value   = $f->value;
	$display = $f->display;

	if ( $display == 'none' ) {
		continue;
	}

	if ( $display == 'hidden' ) {
		?>
        <input type="hidden" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>">
		<?php
		continue;
	}

	$alt                 = ( $j ++ % 2 ) ? 'alt' : '';
	$class               = "editfield $id field_$name $alt row";

	echo "<div class='$class'>\n";

	switch ( $display ) {
		case 'range':
			if ( $f->type == 'datebox' ) {

				$from = ( $value['min'] == '' ) ? sq_option( 'buddypress_age_start', 18 ) : $value['min'];
				$to   = ( $value['max'] == '' ) ? sq_option( 'buddypress_age_end', 75 ) : $value['max'];

				echo '<div class="five mobile-four columns">' .
				     "<label class='right inline'>" . $f->label . "</label>" .
				     '</div>';

				echo '<div class="three mobile-two columns">

                <select name="' . $name . '[min]" class="expand customDropdown">';

				echo apply_filters( 'kleo_bp_searchform_before_all_li', '<option value=""> </option>' );

				for ( $i = sq_option( 'buddypress_age_start', 18 ); $i <= sq_option( 'buddypress_age_end', 75 ); $i ++ ) {
					echo '<option value="' . $i . '" ' . get_selected( '-', $i, $from ) . ' >' . $i . '</option>';
				}
				echo '</select>
              </div>
              
              <div class="one mobile-one columns text-center bps-range-separator">
                <label class="inline"> - </label>
              </div>';

				echo '<div class="three mobile-two columns">
                <select name="' . $name . '[max]" class="expand customDropdown">';

				echo apply_filters( 'kleo_bp_searchform_before_all_li', '<option value=""> </option>' );

				for ( $i = sq_option( 'buddypress_age_start', 18 ); $i <= sq_option( 'buddypress_age_end', 75 ); $i ++ ) {
					echo '<option value="' . $i . '" ' . get_selected( '-', $i, $to ) . ' >' . $i . '</option>';
				}
				echo ' </select>
              </div>';

			} else {

				echo '<div class="five mobile-one columns">';
				echo "<label class='right inline'>" . sweet_translate_dynamic( $f->label, 'sweetdate' ) . "</label>";
				echo '</div>';
				echo '<div class="three mobile-one columns">
              <input type="text" name="' . esc_attr( $name ) . '[min]" value="' . $value['min'] . '">
              </div>
              <div class="one mobile-one columns text-center">
                <label class="inline"> - </label>
              </div>';
				echo '<div class="three mobile-one columns">
                  <input type="text" name="' . esc_attr( $name ) . '[max]" value="' . $value['max'] . '">
              </div>';
			}
			break;

		case 'range-select':
			$from = $value['min'];
			$to   = $value['max'];

			echo '<div class="five mobile-one columns">' .
			     "<label class='right inline'>" . $f->label . "</label>" .
			     '</div>';

			echo '<div class="three mobile-one columns">

            <select name="' . $name . '[min]" class="expand customDropdown">';

			echo apply_filters( 'kleo_bp_searchform_before_all_li', '<option value=""> </option>' );

			foreach ( $f->options as $key => $label ) {
				echo '<option value="' . $key . '" ' . get_selected( '-', $key, $from ) . ' >' . $label . '</option>';
			}
			echo '</select>
              </div>
              
              <div class="one mobile-one columns text-center">
                <label class="inline"> - </label>
              </div>';

			echo '<div class="three mobile-one columns">
                <select name="' . $name . '[max]" class="expand customDropdown">';

			echo apply_filters( 'kleo_bp_searchform_before_all_li', '<option value=""> </option>' );

			foreach ( $f->options as $key => $label ) {
				echo '<option value="' . $key . '" ' . get_selected( '-', $key, $to ) . ' >' . $label . '</option>';
			}
			echo ' </select>
              </div>';

			break;

		case 'integer-range':

			if ( $f->type == 'datebox' ) {

				$from = ( $value['min'] == '' ) ? sq_option( 'buddypress_age_start', 18 ) : $value['min'];
				$to   = ( $value['max'] == '' ) ? sq_option( 'buddypress_age_end', 75 ) : $value['max'];

				echo '<div class="five mobile-four columns">' .
				     "<label class='right inline'>" . $f->label . "</label>" .
				     '</div>';

				echo '<div class="three mobile-two columns">

                <select name="' . $name . '[min]" class="expand customDropdown">';

				echo apply_filters( 'kleo_bp_searchform_before_all_li', '<option value=""> </option>' );

				for ( $i = sq_option( 'buddypress_age_start', 18 ); $i <= sq_option( 'buddypress_age_end', 75 ); $i ++ ) {
					echo '<option value="' . $i . '" ' . get_selected( '-', $i, $from ) . ' >' . $i . '</option>';
				}
				echo '</select>
              </div>
              
              <div class="one mobile-one columns text-center bps-range-separator">
                <label class="inline"> - </label>
              </div>';

				echo '<div class="three mobile-two columns">
                <select name="' . $name . '[max]" class="expand customDropdown">';

				echo apply_filters( 'kleo_bp_searchform_before_all_li', '<option value=""> </option>' );

				for ( $i = sq_option( 'buddypress_age_start', 18 ); $i <= sq_option( 'buddypress_age_end', 75 ); $i ++ ) {
					echo '<option value="' . $i . '" ' . get_selected( '-', $i, $to ) . ' >' . $i . '</option>';
				}
				echo ' </select>
              </div>';

			} else {
				echo '<div class="five mobile-one columns">';
				echo "<label class='right inline'>" . sweet_translate_dynamic( $f->label, 'sweetdate' ) . "</label>";
				echo '</div>';
				echo '<div class="three mobile-one columns">
				        <input type="text" name="' . $name . '[min]" value="' . $value['min'] . '" >
			        </div>
                    <div class="one mobile-one columns text-center">
                        <label class="inline"> - </label>
                    </div>';

				echo '<div class="three mobile-one columns">
				        <input type="text" name="' . $name . '[max]" value="' . $value['max'] . '" >
			        </div>';
			}

			break;

		case 'distance':

			$of = esc_html__( 'of', 'bp-profile-search' );
			$km          = esc_html__( 'km', 'bp-profile-search' );
			$miles       = esc_html__( 'miles', 'bp-profile-search' );
			$placeholder = esc_html__( 'Start typing, then select a location', 'bp-profile-search' );
			$icon_url    = plugins_url( 'bp-profile-search/templates/members/locator.png' );
			$icon_title  = esc_html__( 'get current location', 'bp-profile-search' );

			echo '<div class="five mobile-four columns">' .
			     "<label class='right inline'>" . $f->label . "</label>" .
			     '</div>';
			?>
            <div class="seven mobile-two columns">

                <div class="row">

                    <div class="six mobile-two columns kleo-text" style="padding-right: 0;margin-top: 2px;">
                        <input type="number" min="1" name="<?php echo esc_attr( $name ) . '[distance]'; ?>"
                               value="<?php echo esc_attr( $value['distance'] ); ?>">
                    </div>

                    <div class="six mobile-two columns text-center bps-location-units" style="padding-left: 0">
                        <select name="<?php echo esc_attr( $name ) . '[units]'; ?>">
                            <option value="km" <?php selected( $value['units'], "km" ); ?>><?php echo esc_attr( $km ); ?></option>
                            <option
                                    value="miles" <?php selected( $value['units'], "miles" ); ?>><?php echo esc_attr( $miles ); ?></option>
                        </select>
                    </div>

                    <!--<div class="one mobile-one columns text-center bps-range-separator">
							<label class="inline"> <?php /*echo esc_attr( $of ); */
					?> </label>
						</div>-->

                    <div class="twelve mobile-four columns kleo-text">
                        <div style="position: relative;">
                            <input type="search" style="width: 90%;" id="<?php echo esc_attr( $id ); ?>"
                                   class="bps-location-input"
                                   name="<?php echo esc_attr( $name ) . '[location]'; ?>"
                                   value="<?php echo esc_attr( $value['location'] ); ?>"
                                   placeholder="<?php echo esc_attr( $placeholder ); ?>">
                            <img class="bps-locator-icon" id="<?php echo esc_attr( $id ); ?>_icon"
                                 style="cursor: pointer;"
                                 src="<?php echo esc_attr( $icon_url ); ?>"
                                 title="<?php echo esc_attr( $icon_title ); ?>">
                        </div>
                    </div>
                </div>

                <input type="hidden" id="<?php echo esc_attr( $id ); ?>_lat"
                       name="<?php echo esc_attr( $name ) . '[lat]'; ?>"
                       value="<?php echo esc_attr( $value['lat'] ); ?>">
                <input type="hidden" id="<?php echo esc_attr( $id ); ?>_lng"
                       name="<?php echo esc_attr( $name ) . '[lng]'; ?>"
                       value="<?php echo esc_attr( $value['lng'] ); ?>">

                <script>
                    jQuery(function ($) {
                        bps_autocomplete('<?php echo esc_attr( $id ); ?>', '<?php echo esc_attr( $id ); ?>_lat', '<?php echo esc_attr( $id ); ?>_lng');
                        $('#<?php echo esc_attr( $id ); ?>_icon').click(function () {
                            bps_locate('<?php echo esc_attr( $id ); ?>', '<?php echo esc_attr( $id ); ?>_lat', '<?php echo esc_attr( $id ); ?>_lng')
                        });
                    });
                </script>
            </div>
			<?php
			break;

		case 'textarea':
			echo "<div class='five mobile-four columns'>" .
			     "<label class='right inline' for='$id'>" . sweet_translate_dynamic( $f->label, 'sweetdate' ) . "</label>" .
			     "</div>";
			echo "<div class='seven mobile-four columns kleo-textarea'>" .
			     "<input type='text' name='$name' id='$id' value='$value' />" .
			     "</div>";
			break;

		case 'selectbox':

			echo "<div class='five mobile-four columns'>" .
			     "<label class='right inline' for='$id'>" . sweet_translate_dynamic( $f->label, 'sweetdate' ) . "</label>" .
			     "</div>";
			echo "<div class='seven mobile-four columns kleo-selectbox'>" .
			     "<select class='expand' name='$name' id='$id'>";

			$select_options = $f->options;

			foreach ( $select_options as $key => $label ) {
				$selected = ( $key == $value ) ? "selected='selected'" : "";
				echo "<option $selected value='$key'>" . sweet_translate_dynamic( $label, 'sweetdate' ) . "</option>";
			}
			echo "</select></div>";
			break;

		case 'multiselectbox':

			echo "<div class='five mobile-four columns'>" .
			     "<label class='right inline' for='$id'>" . sweet_translate_dynamic( $f->label, 'sweetdate' ) . "</label>" .
			     "</div>";
			echo "<div class='seven mobile-four columns kleo-multiselectbox'>" .
			     "<select " .
			     apply_filters( 'kleo_bp_search_multiselect_attributes', "multiple='multiple' data-customforms='disabled'" ) .
			     " class='expand' name='{$name}[]' id='$id'>";
			foreach ( $f->options as $key => $label ) {
				$selected = in_array( $key, (array) $value ) ? "selected='selected'" : "";
				echo "<option $selected value='$key'>" . sweet_translate_dynamic( $label, 'sweetdate' ) . "</option>";
			}
			echo "</select></div>";
			break;

		case 'radio':

			echo "<div class='five mobile-four columns'>" .
			     "<label class='right'>" . sweet_translate_dynamic( $f->label, 'sweetdate' ) . "<br>";
			echo "<a class='clear-value-" . $id . "' href='#'>" .
			     "<small class='kleo-clear-radio'><i class='icon icon-remove'></i> " . esc_html__( 'Clear', 'sweetdate' ) . "</small>" .
			     "</a>";
			?>
            <script type="text/javascript">jQuery('.clear-value-<?php echo esc_attr( $id ); ?>').click(function () {
                    jQuery('input[name=<?php echo esc_attr( $name ); ?>]').attr('checked', false);
                    jQuery('.field_<?php echo esc_attr( $id ); ?> .custom.radio').removeClass('checked');
                    return false;
                });</script>
			<?php
			echo "</label></div>";
			echo "<div class='seven mobile-four columns kleo-radio field_" . esc_attr( $id ) . "'>";

			foreach ( $f->options as $key => $label ) {
				$checked = in_array( $key, (array) $value ) ? "checked='checked'" : "";
				echo "<label><input $checked type='radio' name='$name' value='$key'> " . sweet_translate_dynamic( $label, 'sweetdate' ) . "</label>";
			}
			echo '</div>';
			break;

		case 'checkbox':

			echo "<div class='five mobile-four columns'>" .
			     "<label class='right'>" . sweet_translate_dynamic( $f->label, 'sweetdate' ) . "</label>" .
			     "</div>";
			echo "<div class='seven mobile-four columns kleo-checkbox'>";

			foreach ( $f->options as $key => $label ) {
				$checked = in_array( $key, $value ) ? "checked='checked'" : "";
				echo "<label><input $checked type='checkbox' name='{$name}[]' value='$key'> " . sweet_translate_dynamic( $label, 'sweetdate' ) . "</label>";
			}
			echo '</div>';

			break;

		case 'number':
			echo "<div class='two columns hz-textbox'>" .
			     "<input type='number' name='$name' id='$id' value='$value' placeholder='" . sweet_translate_dynamic( $f->label, 'sweetdate' ) . "' />" .
			     "</div>";
			break;

		case 'url':
			echo "<div class='two columns hz-textbox'>" .
			     "<input type='number' inputmode='url' name='$name' id='$id' value='$value' placeholder='" . sweet_translate_dynamic( $f->label, 'sweetdate' ) . "' />" .
			     "</div>";
			break;

		case 'textbox':

			echo "<div class='five mobile-four columns'>" .
			     "<label class='right inline' for='$id'>" . sweet_translate_dynamic( $f->label, 'sweetdate' ) . "</label>" .
			     "</div>";
			echo "<div class='seven mobile-four columns kleo-text'>" .
			     "<input type='text' name='$name' id='$id' value='$value' />" .
			     "</div>";
			break;
		default:

			$field_template = 'members/bps-' . $display . '-form-field.php';
			$located     = bp_locate_template( $field_template );
			if ( $located ) {
				include $located;
			} else {
				?>
                <p class="bps-error"><?php echo "BP Profile Search: unknown display <em>$display</em> for field <em>$f->name</em>."; ?></p>
				<?php
			}
			break;
	}

	do_action( 'kleo_bp_search_add_data' );

	if ( ! empty ( $f->description ) && $f->description != '-' ) {
		echo "<div class='seven mobile-four columns kleo-text'>";
		echo "<label class='inline'>$f->description</label>\n";
		echo "</div>";
	}

	echo "</div>\n";
}

echo "<div class='submit'>\n";
?>
    <div class="row">
        <div class="seven offset-by-five columns">
            <button type="submit" class="button radius"><i class="icon-search"></i>
                &nbsp;<?php _e( "SEARCH", 'sweetdate' ); ?></button>
        </div>
    </div>
    <span class="notch"></span>
<?php
echo "</div>\n";
echo "</form>\n";

if ( $F->location != 'directory' ) {
	echo "</div>\n";
}

return 'end_of_template 4.9';
