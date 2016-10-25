<?php
/**
 * Gravity Wiz // Gravity Forms // Set Number of List Field Rows by Field Value
 *
 * Add/remove list field rows automatically based on the value entered in the specified field. Removes the add/remove
 * that normally buttons next to List field rows.
 *
 * @version	  1.0
 * @author    David Smith <david@gravitywiz.com>
 * @license   GPL-2.0+
 * @link      http://gravitywiz.com/2012/06/03/set-number-of-list-field-rows-by-field-value/
 */
class GWAutoListFieldRows {

	private static $_is_script_output;

	function __construct( $args ) {

		$this->_args = wp_parse_args( $args, array(
			'form_id'       => false,
			'input_html_id' => false,
			'list_field_id' => false
		) );

		extract( $this->_args ); // gives us $form_id, $input_html_id, and $list_field_id

		if( ! $form_id || ! $input_html_id || ! $list_field_id )
			return;

		add_filter( 'gform_pre_render_' . $form_id, array( $this, 'pre_render' ) );

	}

	function pre_render( $form ) {
		?>

		<style type="text/css"> #field_<?php echo $form['id']; ?>_<?php echo $this->_args['list_field_id']; ?> .gfield_list_icons { display: none; } </style>

		<?php

		add_filter( 'gform_register_init_scripts', array( $this, 'register_init_script' ) );

		if( ! self::$_is_script_output )
			$this->output_script();

		return $form;
	}

	function register_init_script( $form ) {

		// remove this function from the filter otherwise it will be called for every other form on the page
		remove_filter( 'gform_register_init_scripts', array( $this, 'register_init_script' ) );

		$args = array(
			'formId'      => $this->_args['form_id'],
			'listFieldId' => $this->_args['list_field_id'],
			'inputHtmlId' => $this->_args['input_html_id']
		);

		$script = "new gwalfr(" . json_encode( $args ) . ");";
		$key = implode( '_', $args );

		GFFormDisplay::add_init_script( $form['id'], 'gwalfr_' . $key , GFFormDisplay::ON_PAGE_RENDER, $script );

	}

	function output_script() {
		?>

		<script type="text/javascript">

			window.gwalfr;

			(function($){

				gwalfr = function( args ) {

					this.formId      = args.formId,
						this.listFieldId = args.listFieldId,
						this.inputHtmlId = args.inputHtmlId;

					this.init = function() {

						var gwalfr = this,
							triggerInput = $( this.inputHtmlId );

						// update rows on page load
						this.updateListItems( triggerInput, this.listFieldId, this.formId );

						// update rows when field value changes
						triggerInput.change(function(){
							gwalfr.updateListItems( $(this), gwalfr.listFieldId, gwalfr.formId );
						});

					}

					this.updateListItems = function( elem, listFieldId, formId ) {

						var listField = $( '#field_' + formId + '_' + listFieldId ),
							count = parseInt( elem.val() );
						rowCount = listField.find( 'table.gfield_list tbody tr' ).length,
							diff = count - rowCount;

						if( diff > 0 ) {
							for( var i = 0; i < diff; i++ ) {
								listField.find( '.add_list_item:last' ).click();
							}
						} else {

							// make sure we never delete all rows
							if( rowCount + diff == 0 )
								diff++;

							for( var i = diff; i < 0; i++ ) {
								listField.find( '.delete_list_item:last' ).click();
							}

						}
					}

					this.init();

				}

			})(jQuery);

		</script>

		<?php
	}

}

// EXAMPLE #1: Number field for the "input_html_id"
//new GWAutoListFieldRows( array(
//	'form_id' => 240,
//	'list_field_id' => 3,
//	'input_html_id' => '#input_240_4'
//) );

// EXAMPLE #2: Single Product Field's Quantity input as the "input_html_id"
new GWAutoListFieldRows( array(
	'form_id' => 8,
	'list_field_id' => 10,
	'input_html_id' => '#ginput_quantity_8_17'
) );

// EXAMPLE #2: Single Product Field's Quantity input as the "input_html_id"
new GWAutoListFieldRows( array(
	'form_id' => 8,
	'list_field_id' => 24,
	'input_html_id' => '#ginput_quantity_8_28'
) );

new GWAutoListFieldRows( array(
	'form_id' => 8,
	'list_field_id' => 25,
	'input_html_id' => '#ginput_quantity_8_20'
) );

new GWAutoListFieldRows( array(
	'form_id' => 8,
	'list_field_id' => 31,
	'input_html_id' => '#ginput_quantity_8_21'
) );

new GWAutoListFieldRows( array(
	'form_id' => 8,
	'list_field_id' => 32,
	'input_html_id' => '#ginput_quantity_8_30'
) );

new GWAutoListFieldRows( array(
	'form_id' => 8,
	'list_field_id' => 33,
	'input_html_id' => '#ginput_quantity_8_29'
) );

new GWAutoListFieldRows( array(
	'form_id' => 8,
	'list_field_id' => 36,
	'input_html_id' => '#ginput_quantity_8_22'
) );

new GWAutoListFieldRows( array(
	'form_id' => 8,
	'list_field_id' => 37,
	'input_html_id' => '#ginput_quantity_8_35'
) );

new GWAutoListFieldRows( array(
	'form_id' => 8,
	'list_field_id' => 38,
	'input_html_id' => '#ginput_quantity_8_39'
) );


//Fall Sports

// Football
new GWAutoListFieldRows( array(
	'form_id' => 24,
	'list_field_id' => 72,
	'input_html_id' => '#ginput_quantity_24_28'
) );

// Cheer
new GWAutoListFieldRows( array(
	'form_id' => 24,
	'list_field_id' => 73,
	'input_html_id' => '#ginput_quantity_24_17'
) );

// Volleyball
new GWAutoListFieldRows( array(
	'form_id' => 24,
	'list_field_id' => 74,
	'input_html_id' => '#ginput_quantity_24_20'
) );

// Cross Country
new GWAutoListFieldRows( array(
	'form_id' => 24,
	'list_field_id' => 76,
	'input_html_id' => '#ginput_quantity_24_29'
) );

// Soccer JV
new GWAutoListFieldRows( array(
	'form_id' => 24,
	'list_field_id' => 75,
	'input_html_id' => '#ginput_quantity_24_30'
) );

// Soccer
new GWAutoListFieldRows( array(
	'form_id' => 24,
	'list_field_id' => 77,
	'input_html_id' => '#ginput_quantity_24_22'
) );

// Flag Football
new GWAutoListFieldRows( array(
	'form_id' => 24,
	'list_field_id' => 81,
	'input_html_id' => '#ginput_quantity_24_80'
) );

// Spring Sports
new GWAutoListFieldRows( array(
	'form_id' => 17,
	'list_field_id' => 10,
	'input_html_id' => '#ginput_quantity_17_17'
) );

new GWAutoListFieldRows( array(
	'form_id' => 17,
	'list_field_id' => 24,
	'input_html_id' => '#ginput_quantity_17_28'
) );

new GWAutoListFieldRows( array(
	'form_id' => 17,
	'list_field_id' => 25,
	'input_html_id' => '#ginput_quantity_17_20'
) );

new GWAutoListFieldRows( array(
	'form_id' => 17,
	'list_field_id' => 31,
	'input_html_id' => '#ginput_quantity_17_21'
) );

new GWAutoListFieldRows( array(
	'form_id' => 17,
	'list_field_id' => 32,
	'input_html_id' => '#ginput_quantity_17_30'
) );

new GWAutoListFieldRows( array(
	'form_id' => 17,
	'list_field_id' => 33,
	'input_html_id' => '#ginput_quantity_17_29'
) );

new GWAutoListFieldRows( array(
	'form_id' => 17,
	'list_field_id' => 36,
	'input_html_id' => '#ginput_quantity_17_22'
) );
