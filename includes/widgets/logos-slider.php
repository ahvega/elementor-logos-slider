<?php
if (!defined('ABSPATH')) exit;

/**
 * Elementor Logos Slider Widget
 *
 * Displays a continuous scrolling slider of logos with hover effects and fade transitions.
 * Features include infinite scroll, hover effects, grayscale to color transition,
 * and customizable fade-in/fade-out effects at container edges.
 *
 * @since 1.0.0
 * @since 1.1.0 Added fade-in/fade-out transition effects
 */
class Elementor_Logos_Slider_Widget extends \Elementor\Widget_Base {
    /**
     * Get widget name.
     *
     * Retrieve the widget name used in Elementor editor.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'logos-slider';
    }

    /**
     * Get widget title.
     *
     * Retrieve the widget title displayed in Elementor editor.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title() {
        return __('Logos Slider', 'elementor-logos-slider');
    }

    /**
     * Get widget icon.
     *
     * Retrieve the widget icon displayed in Elementor editor.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-slider-push';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the widget belongs to in Elementor panel.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['custom-logos'];
    }

    /**
     * Get widget script dependencies.
     *
     * Retrieve the list of scripts the widget depends on.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget script dependencies.
     */
    public function get_script_depends() {
        return ['elementor-logos-slider'];
    }

    /**
     * Get widget style dependencies.
     *
     * Retrieve the list of styles the widget depends on.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget style dependencies.
     */
    public function get_style_depends() {
        return ['elementor-logos-slider'];
    }

    /**
     * Register widget controls.
     *
     * Adds different input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @since 1.1.0 Added fade effect controls
     * @access protected
     */
    protected function _register_controls() {
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'elementor-logos-slider'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'gallery',
            [
                'label' => __('Add Logos', 'elementor-logos-slider'),
                'type' => \Elementor\Controls_Manager::GALLERY,
                'default' => [],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'elementor-logos-slider'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Add Background Mode Control
        $this->add_control(
            'background_mode',
            [
                'label' => __('Background Mode', 'elementor-logos-slider'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'light',
                'options' => [
                    'light' => __('Light Mode', 'elementor-logos-slider'),
                    'dark' => __('Dark Mode', 'elementor-logos-slider'),
                    'custom' => __('Custom Color', 'elementor-logos-slider'),
                ],
            ]
        );

        // Add Custom Background Color Control
        $this->add_control(
            'background_color',
            [
                'label' => __('Background Color', 'elementor-logos-slider'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'condition' => [
                    'background_mode' => 'custom',
                ],
                'selectors' => [
                    '{{WRAPPER}} .logo-slider-section' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Add Invert Logo Colors Control
        $this->add_control(
            'invert_logos',
            [
                'label' => __('Invert Logo Colors', 'elementor-logos-slider'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'elementor-logos-slider'),
                'label_off' => __('No', 'elementor-logos-slider'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'logo_size',
            [
                'label' => __('Logo Size', 'elementor-logos-slider'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 300,
                        'step' => 10,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 120,
                ],
                'selectors' => [
                    '{{WRAPPER}} .logo-item' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'logo_opacity',
            [
                'label' => __('Logo Opacity', 'elementor-logos-slider'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 0.55,
                ],
                'selectors' => [
                    '{{WRAPPER}} .logo-item' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_opacity',
            [
                'label' => __('Hover Opacity', 'elementor-logos-slider'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 0.8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .logo-item:hover' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_control(
            'animation_speed',
            [
                'label' => __('Animation Speed', 'elementor-logos-slider'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 10,
                'max' => 200,
                'step' => 5,
                'default' => 60,
            ]
        );

        // Add Fade Effect Controls
        $this->add_control(
            'enable_fade_effect',
            [
                'label' => __('Enable Fade Effect', 'elementor-logos-slider'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'elementor-logos-slider'),
                'label_off' => __('No', 'elementor-logos-slider'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'description' => __('Enables smooth fade-in/fade-out transitions at the edges of the slider container.', 'elementor-logos-slider'),
            ]
        );

        $this->add_control(
            'fade_width',
            [
                'label' => __('Fade Width', 'elementor-logos-slider'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 5,
                        'max' => 30,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 15,
                ],
                'condition' => [
                    'enable_fade_effect' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .logo-slider-section' => '--fade-width: {{SIZE}}{{UNIT}};',
                ],
                'description' => __('Controls the width of the fade effect at the container edges. Larger values create a more gradual transition.', 'elementor-logos-slider'),
            ]
        );

        $this->end_controls_section();

        // Add Title Section
        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__('Title', 'elementor-logos-slider'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label' => esc_html__('Title', 'elementor-logos-slider'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Our Partners', 'elementor-logos-slider'),
                'placeholder' => esc_html__('Enter your title', 'elementor-logos-slider'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('HTML Tag', 'elementor-logos-slider'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
            ]
        );

        $this->end_controls_section();

        // Add Title Style Section
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__('Title Style', 'elementor-logos-slider'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'title_align',
            [
                'label' => esc_html__('Alignment', 'elementor-logos-slider'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'elementor-logos-slider'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'elementor-logos-slider'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'elementor-logos-slider'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .elementor-logos-slider-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .elementor-logos-slider-title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'elementor-logos-slider'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-logos-slider-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'elementor-logos-slider'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '1',
                    'left' => '0',
                    'unit' => 'em',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-logos-slider-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @since 1.1.0 Added fade effect class and CSS variables
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['gallery'])) {
            return;
        }

        if (!empty($settings['title_text'])) {
            printf(
                '<%1$s class="elementor-logos-slider-title">%2$s</%1$s>',
                $settings['title_tag'],
                esc_html($settings['title_text'])
            );
        }

        // Prepare background color based on mode
        $background_color = '#ffffff';
        if ($settings['background_mode'] === 'dark') {
            $background_color = '#000000';
        } elseif ($settings['background_mode'] === 'custom') {
            $background_color = $settings['background_color'];
        }

        // Prepare logo style class
        $logo_class = 'logo-item';
        if ($settings['invert_logos'] === 'yes') {
            $logo_class .= ' invert-logo';
        }

        // Prepare CSS variables
        $style = sprintf(
            'background-color: %s; ' .
            '--animation-duration: %ss; ' .
            '--logo-size: %spx; ' .
            '--logo-opacity: %s; ' .
            '--logo-hover-opacity: %s; ' .
            '--enable-fade-effect: %s;',
            esc_attr($background_color),
            esc_attr($settings['animation_speed']),
            esc_attr($settings['logo_size']['size']),
            esc_attr($settings['logo_opacity']['size']),
            esc_attr($settings['hover_opacity']['size']),
            esc_attr($settings['enable_fade_effect'] === 'yes' ? '1' : '0')
        );

        $this->add_render_attribute('wrapper', [
            'class' => 'logo-slider-section',
            'style' => $style,
            'data-animation-speed' => $settings['animation_speed']
        ]);
        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <div class="logo-slider-container<?php echo $settings['enable_fade_effect'] === 'yes' ? ' fade-enabled' : ''; ?>">
                <div class="logo-track">
                    <?php
                    // First set of logos
                    foreach ($settings['gallery'] as $image) {
                        echo '<img src="' . esc_attr($image['url']) . '"
                                  alt="' . esc_attr(get_post_meta($image['id'], '_wp_attachment_image_alt', true)) . '"
                                  class="' . esc_attr($logo_class) . '">';
                    }
                    // Duplicate set for infinite scroll
                    foreach ($settings['gallery'] as $image) {
                        echo '<img src="' . esc_attr($image['url']) . '"
                                  alt="' . esc_attr(get_post_meta($image['id'], '_wp_attachment_image_alt', true)) . '"
                                  class="' . esc_attr($logo_class) . '">';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Render widget content template for the Elementor editor.
     *
     * Used to generate the live preview in the Elementor editor.
     *
     * @since 1.0.0
     * @since 1.1.0 Added fade effect class and CSS variables
     * @access protected
     */
    protected function content_template() {
        ?>
        <# if ( settings.title_text ) { #>
            <{{{ settings.title_tag }}} class="elementor-logos-slider-title">{{{ settings.title_text }}}</{{{ settings.title_tag }}}>
        <# } #>

        <#
        // Prepare background color based on mode
        var backgroundColor = '#ffffff';
        if (settings.background_mode === 'dark') {
            backgroundColor = '#000000';
        } else if (settings.background_mode === 'custom') {
            backgroundColor = settings.background_color;
        }

        // Prepare logo style class
        var logoClass = 'logo-item';
        if (settings.invert_logos === 'yes') {
            logoClass += ' invert-logo';
        }

        // Prepare CSS variables
        var style = 'background-color: ' + backgroundColor + '; ' +
                   '--animation-duration: ' + settings.animation_speed + 's; ' +
                   '--logo-size: ' + settings.logo_size.size + 'px; ' +
                   '--logo-opacity: ' + settings.logo_opacity.size + '; ' +
                   '--logo-hover-opacity: ' + settings.hover_opacity.size + '; ' +
                   '--enable-fade-effect: ' + (settings.enable_fade_effect === 'yes' ? '1' : '0') + ';';

        var fadeEnabledClass = settings.enable_fade_effect === 'yes' ? ' fade-enabled' : '';
        #>

        <div class="logo-slider-section" style="{{ style }}" data-animation-speed="{{ settings.animation_speed }}">
            <div class="logo-slider-container{{ fadeEnabledClass }}">
                <div class="logo-track">
                    <# if (settings.gallery && settings.gallery.length) { #>
                        <# _.each(settings.gallery, function(image) { #>
                            <img src="{{ image.url }}" alt="{{ image.alt }}" class="{{ logoClass }}">
                        <# }); #>
                        <# _.each(settings.gallery, function(image) { #>
                            <img src="{{ image.url }}" alt="{{ image.alt }}" class="{{ logoClass }}">
                        <# }); #>
                    <# } #>
                </div>
            </div>
        </div>
        <?php
    }
}