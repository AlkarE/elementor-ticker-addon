<?php

namespace Ticker;

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

/**
 * Elementor Ticker Widget.
 *
 * @since 1.0.0
 */
class Ticker_Widget extends \Elementor\Widget_Base
{

  /**
   * Get widget name.
   *
   *
   * @since 1.0.0
   * @access public
   * @return string Widget name.
   */
  public function get_name()
  {
    return 'ticker';
  }

  /**
   * Get widget title.
   *
   * Retrieve list widget title.
   *
   * @since 1.0.0
   * @access public
   * @return string Widget title.
   */
  public function get_title()
  {
    return esc_html__('Ticker', 'ticker-addon');
  }

  /**
   * Get widget icon.
   *
   *
   * @since 1.0.0
   * @access public
   * @return string Widget icon.
   */
  public function get_icon()
  {
    return 'eicon-carousel';
  }

  /**
   * Get widget categories.
   *
   *
   * @since 1.0.0
   * @access public
   * @return array Widget categories.
   */
  public function get_categories()
  {
    return ['general'];
  }

  /**
   * Get widget keywords.
   *
   *
   * @since 1.0.0
   * @access public
   * @return array Widget keywords.
   */
  public function get_keywords()
  {
    return ['ticker', 'line'];
  }

  /**
   * Get custom help URL.
   *
   *
   * @since 1.0.0
   * @access public
   * @return string Widget help URL.
   */
  public function get_custom_help_url()
  {
    return 'https://developers.elementor.com/docs/widgets/';
  }


  /**
   * Register list widget controls.
   *
   * Add input fields to allow the user to customize the widget settings.
   *
   * @since 1.0.0
   * @access protected
   */
  protected function register_controls()
  {

    $this->start_controls_section(
      'content_section',
      [
        'label' => esc_html__('Content', 'ticker-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );
    $this->add_control(
      'words',
      [
        'label' => __('Ticker Words', 'text-domain'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Enter words separated by commas', 'ticker-addon'),
      ]
    );

    $this->add_control(
      'speed',
      [
        'label' => __('Ticker speed', 'ticker-adddon'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'description' => __('The speed in pixels per second', 'ticker_addon'),
        'size_units' => [], // Remove units
        'range' => [
          'px' => [
            'min' => 1,
            'max' => 500,
          ],
        ],
        'default' => [
          'unit' => '', // No units
          'size' => 100, // Default speed
        ],
      ],
    );

    $this->add_control(
      'icon',
      [
        'label' => __('Select Icon', 'ticker-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
          'value' => 'fas fa-star',
          'library' => 'solid',
        ],
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'style_content_section',
      [
        'label' => esc_html__('Ticker Style', 'ticker-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );


    $this->add_control(
      'ticker_size',
      [
        'label' => __('Ticker Size', 'ticker-addon'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', 'em', 'rem'],
        'selectors' => [
          '{{WRAPPER}} .ticker' => 'font-size: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_control(
      'ticker_padding',
      [
        'label' => __('Ticker item space', 'ticker-addon'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'selectors' => [
          '{{WRAPPER}} .ticker .ticker-icon' => 'padding-left: {{SIZE}}{{UNIT}};padding-right: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_control(
      'direction',
      [
        'label' => __('Direction', 'text-domain'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
          'left' => __('Left', 'ticker-addon'),
          'right' => __('Right', 'ticker-addon'),
        ],
        'default' => 'left',
      ]
    );




    $this->add_control(
      'ticker_color',
      [
        'label' => __('Ticker Color', 'text-domain'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .ticker' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'style_marker_section',
      [
        'label' => esc_html__('Marker Style', 'ticker-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );


    $this->add_control(
      'icon_color',
      [
        'label' => __('Icon Color', 'text-domain'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .ticker .ticker-icon' => 'color: {{VALUE}};',
        ],
      ]
    );
    $this->add_control(
      'icon_size',
      [
        'label' => __('Icon Size', 'text-domain'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', 'em', 'rem'],
        'selectors' => [
          '{{WRAPPER}} .ticker .ticker-icon' => 'font-size: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->end_controls_section();
  }

  public function get_script_depends()
  {
    return ['ticker', 'ticker-init'];
  }

  /**
   * Render ticker widget output on the frontend.
   *
   * Written in PHP and used to generate the final HTML.
   *
   * @since 1.0.0
   * @access protected
   */
  protected function render()
  {
    $settings = $this->get_settings_for_display();
    $icon_html = !empty($settings['icon']['value']) ? '<i class="' . esc_attr($settings['icon']['value']) . '"></i>' : '';
    $words = explode("|", $settings['words']);
    $last_index = count($words) - 1;
    if (!empty($words)) :;
      $out = '<div class="ticker" data-speed="' . esc_attr($settings['speed']['size']) . '" data-direction="' . esc_attr($settings['direction']) . '">';
      foreach ($words as $index => $word) {
        $out .= trim($word);
        if (!empty($icon_html) && $index < $last_index) {
          $out .= "<span class='ticker-icon'>$icon_html</span>";
        }
      }
      $out .= '</div>';
      echo $out;

    endif;
  }

  /**
   * Render ticker widget output in the editor.
   *
   * Written as a Backbone JavaScript template and used to generate the live preview.
   *
   * @since 1.0.0
   * @access protected
   */
  protected function content_template()
  {
?>
    <# const icon_html=settings.icon.value ? '<i class="' + settings.icon.value + '"></i>' : '' ; #>
      <div class="ticker" data-speed="{{ settings.speed.size }}" data-direction="{{ settings.direction }}">
        <# _.each(settings.words.split('|'), function(word, index){ #>
          {{{ word.trim() }}}
          <# if (icon_html && index < settings.words.split("|").length - 1) { #>
            <span class="ticker-icon">{{{ icon_html }}}</span>
            <# } #>
              <# }); #>

      </div>
  <?php
  }
}
