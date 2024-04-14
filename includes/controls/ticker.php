<?php

namespace Ticker;

/**
 * Elementor ticker control.
 *
 *
 * @since 1.0.0
 */
class Ticker_Control extends \Elementor\Base_Data_Control
{

  /**
   * Get ticker control type.
   *
   *
   * @since 1.0.0
   * @access public
   * @return string Control type.
   */
  public function get_type()
  {
    return 'ticker';
  }

  /**
   * Enqueue ticker script.
   *
   *
   * @since 1.0.0
   * @access public
   */
  public function enqueue()
  {

    // Scripts
    wp_register_script('ticker',  plugins_url('/assets/js/jquery.simplemarquee.js'), ['jquery']);
    wp_enqueue_script('ticker');
  }

  /**
   * Get ticker control default settings.
   *
   *
   * @since 1.0.0
   * @access protected
   * @return array Control default settings.
   */
  protected function get_default_settings()
  {
    return [
      'label_block' => true,
      'rows' => 3,
      'ticker_options' => [],
    ];
  }

  /**
   * Render ticker control output in the editor.
   *
   * Used to generate the control HTML in the editor using Underscore JS
   * template. The variables for the class are available using `data` JS
   * object.
   *
   * @since 1.0.0
   * @access public
   */
  public function content_template()
  {
    $control_uid = $this->get_control_uid();
?>
    <div class="elementor-control-field">

      <# if ( data.label ) {#>
			<label for="<?php echo esc_attr($control_uid); ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<# } #>

			<div class="elementor-control-input-wrapper">
				<textarea id="<?php echo esc_attr($control_uid); ?>" class="elementor-control-tag-area" rows="{{ data.rows }}" data-setting="{{ data.name }}" placeholder="{{ data.placeholder }}"></textarea>
			</div>

		</div>

		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<?php
  }
}
