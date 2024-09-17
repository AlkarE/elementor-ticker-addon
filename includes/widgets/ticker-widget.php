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


    $repeater = new \Elementor\Repeater();
    $repeater->add_control(
      'text',
      [
        'label' => __('Word', 'ticker-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Ticker Item', 'ticker-addon'),
        'default' => __('Ticker Item', 'ticker-addon'),
        'label_block' => true,
        'dynamic' => [
          'active' => true,
        ]
      ]
    );

    // Add link control
    $repeater->add_control(
      'link',
      [
        'label' => __('Link', 'ticker-addon'),
        'type' => \Elementor\Controls_Manager::URL,
        'placeholder' => __('https://your-link.com', 'ticker-addon'),
        'default' => [
          'url' => '',
        ],
        'label_block' => true,
        'dynamic' => [
          'active' => true,
        ],
      ]
    );

    $this->add_control(
      'words',
      [
        'label' => __('Ticker words', 'ticker-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
        'default' => [
          [
            'text' => __('Ticker item #1', 'ticker-addon'),
            'link' => ['url' => 'https://example.com'],
          ],
          [
            'text' => __('Ticker item #2', 'ticker-addon'),
            'link' => ['url' => 'https://example.com'],
          ],
          [
            'text' => __('Ticker item #3', 'ticker-addon'),
            'link' => ['url' => 'https://example.com'],
          ],
        ],
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
    $words = $settings['words'];
    // echo '<pre>';
    // print_r($words);
    // echo '</pre>';
    $last_index = count($words) - 1;
    if (!empty($words)) :;
      $out = '<div class="ticker" data-speed="' . esc_attr($settings['speed']['size']) . '" data-direction="' . esc_attr($settings['direction']) . '">';

      foreach ($words as $index => $item) {
        // Ensure the link is set
        $link = isset($item['link']['url']) ? $item['link']['url'] : '#';

        // Link attributes
        $target = !empty($item['link']['is_external']) ? ' target="_blank"' : '';
        $nofollow = !empty($item['link']['nofollow']) ? ' rel="nofollow"' : '';

        $out .= '<span class="ticker-item">';
        $out .= '<a href="' . esc_url($link) . '"' . $target . $nofollow . '>';
        $out .= esc_html(trim($item['text']));
        $out .= '</a></span>';
        if (!empty($icon_html) && $index < $last_index) {
          $out .= "<span class='ticker-icon'>$icon_html</span>";
        }
      }
      $out .= '</div>';

    endif;
    echo $out;
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
        <# _.each(settings.words, function(word, index){ #>
          {{{ word.text.trim() }}}
          <# if (icon_html && index < settings.words.length - 1) { #>
            <span class="ticker-icon">{{{ icon_html }}}</span>
            <# } #>
              <# }); #>

      </div>
  <?php
  }
}
