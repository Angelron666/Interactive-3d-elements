<?php
/**
 * Widget: Hotspot
 * Widget para mostrar un indicador animado de "Atención 24 Horas" con efecto de pulso
 */

if (!defined('ABSPATH')) {
    exit;
}

class Hotspot_Widget extends \Elementor\Widget_Base {

    /**
     * Nombre del widget
     */
    public function get_name() {
        return 'i3d-hotspot';
    }

    /**
     * Título del widget
     */
    public function get_title() {
        return esc_html__('Hotspot 3D', 'interactive-3d-elements');
    }

    /**
     * Icono del widget
     */
    public function get_icon() {
        return 'eicon-navigation-horizontal';
    }

    /**
     * Categorías del widget
     */
    public function get_categories() {
        return ['interactive-3d'];
    }

    /**
     * Palabras clave para búsqueda
     */
    public function get_keywords() {
        return ['hotspot', 'pulse', 'animation', 'indicator', 'atención', 'animación'];
    }

    /**
     * Registrar controles del widget
     */
    protected function register_controls() {

        // ===================
        // SECCIÓN: CONTENIDO
        // ===================
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Contenido', 'interactive-3d-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => esc_html__('Texto', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Atención 24 Horas', 'interactive-3d-elements'),
                'placeholder' => esc_html__('Ingresa el texto', 'interactive-3d-elements'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__('Enlace', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://tu-enlace.com', 'interactive-3d-elements'),
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label' => esc_html__('Alineación', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Izquierda', 'interactive-3d-elements'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Centro', 'interactive-3d-elements'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Derecha', 'interactive-3d-elements'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .hotspot' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ===================
        // SECCIÓN: ESTILO - CONTENEDOR
        // ===================
        $this->start_controls_section(
            'container_style_section',
            [
                'label' => esc_html__('Contenedor', 'interactive-3d-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'container_height',
            [
                'label' => esc_html__('Altura', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hotspot' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_padding',
            [
                'label' => esc_html__('Espaciado Interno (Padding)', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', 'rem', '%'],
                'selectors' => [
                    '{{WRAPPER}} .hotspot' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'container_background',
                'label' => esc_html__('Fondo', 'interactive-3d-elements'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .hotspot',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'container_border',
                'label' => esc_html__('Borde', 'interactive-3d-elements'),
                'selector' => '{{WRAPPER}} .hotspot',
            ]
        );

        $this->add_responsive_control(
            'container_border_radius',
            [
                'label' => esc_html__('Radio del Borde', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .hotspot' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'container_box_shadow',
                'label' => esc_html__('Sombra', 'interactive-3d-elements'),
                'selector' => '{{WRAPPER}} .hotspot',
            ]
        );

        $this->end_controls_section();

        // ===================
        // SECCIÓN: ESTILO - TEXTO
        // ===================
        $this->start_controls_section(
            'text_style_section',
            [
                'label' => esc_html__('Texto', 'interactive-3d-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Color del Texto', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#2457af',
                'selectors' => [
                    '{{WRAPPER}} .hotspot-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => esc_html__('Tipografía', 'interactive-3d-elements'),
                'selector' => '{{WRAPPER}} .hotspot-text',
            ]
        );

        $this->add_responsive_control(
            'gap',
            [
                'label' => esc_html__('Espaciado entre Punto y Texto', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hotspot' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ===================
        // SECCIÓN: ESTILO - PUNTO DE PULSO
        // ===================
        $this->start_controls_section(
            'pulse_style_section',
            [
                'label' => esc_html__('Punto de Pulso', 'interactive-3d-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pulse_color',
            [
                'label' => esc_html__('Color del Pulso', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#2457af',
            ]
        );

        $this->add_responsive_control(
            'pulse_size',
            [
                'label' => esc_html__('Tamaño del Punto', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 4,
                        'max' => 30,
                    ],
                    'rem' => [
                        'min' => 0.25,
                        'max' => 2,
                        'step' => 0.05,
                    ],
                ],
                'default' => [
                    'unit' => 'rem',
                    'size' => 0.5,
                ],
            ]
        );

        $this->add_control(
            'pulse_animation_duration',
            [
                'label' => esc_html__('Duración de la Animación (s)', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0.5,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 2,
                ],
            ]
        );

        $this->add_control(
            'pulse_scale',
            [
                'label' => esc_html__('Escala del Pulso', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 3,
                ],
                'description' => esc_html__('Cuánto se expande el efecto de pulso', 'interactive-3d-elements'),
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Renderizar widget en el frontend
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $text = $settings['text'];
        $pulse_color = $settings['pulse_color'];
        $pulse_size = $settings['pulse_size'];
        $animation_duration = $settings['pulse_animation_duration'];
        $pulse_scale = $settings['pulse_scale'];

        // Obtener valores de tamaño y unidad
        $size_value = $pulse_size['size'];
        $size_unit = $pulse_size['unit'];
        
        // Habilitar edición inline del texto
        $this->add_inline_editing_attributes('text', 'basic');
        $this->add_render_attribute('text', 'class', 'hotspot-text');
        
        // Configurar enlace si existe
        $link_tag = 'div';
        $this->add_render_attribute('wrapper', 'class', 'hotspot');
        
        if (!empty($settings['link']['url'])) {
            $link_tag = 'a';
            $this->add_link_attributes('wrapper', $settings['link']);
        }
        ?>
        <<?php echo esc_attr($link_tag); ?> <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <span class="animate-pulse" 
                  data-color="<?php echo esc_attr($pulse_color); ?>"
                  data-size="<?php echo esc_attr($size_value . $size_unit); ?>"
                  data-duration="<?php echo esc_attr($animation_duration['size']); ?>"
                  data-scale="<?php echo esc_attr($pulse_scale['size']); ?>"></span>
            <span <?php echo $this->get_render_attribute_string('text'); ?>><?php echo esc_html($text); ?></span>
        </<?php echo esc_attr($link_tag); ?>>

        <style>
        .elementor-element-<?php echo $this->get_id(); ?> .hotspot {
            display: flex;
            flex-direction: row;
            align-items: center;
            text-decoration: none;
        }
        
        .elementor-element-<?php echo $this->get_id(); ?> a.hotspot {
            cursor: pointer;
        }
        
        .elementor-element-<?php echo $this->get_id(); ?> a.hotspot:hover .hotspot-text {
            text-decoration: none;
        }

        .elementor-element-<?php echo $this->get_id(); ?> .animate-pulse {
            position: relative;
            background-color: <?php echo esc_attr($pulse_color); ?>;
            width: <?php echo esc_attr($size_value . $size_unit); ?> !important;
            height: <?php echo esc_attr($size_value . $size_unit); ?> !important;
            border-radius: 50%;
            display: block;
            flex-shrink: 0;
        }

        .elementor-element-<?php echo $this->get_id(); ?> .animate-pulse::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100% !important;
            height: 100% !important;
            border-radius: 50%;
            background-color: <?php echo esc_attr($pulse_color); ?>;
            animation: hotspot-ring-<?php echo $this->get_id(); ?> <?php echo esc_attr($animation_duration['size']); ?>s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes hotspot-ring-<?php echo $this->get_id(); ?> {
            0% { 
                transform: scale(1); 
                opacity: 0.5; 
            }
            100% { 
                transform: scale(<?php echo esc_attr($pulse_scale['size']); ?>); 
                opacity: 0; 
            }
        }
        </style>
        <?php
    }

    /**
     * Renderizar widget en el editor de Elementor
     */
    protected function content_template() {
        ?>
        <#
        var pulseColor = settings.pulse_color || '#2457af';
        var pulseSize = settings.pulse_size.size + settings.pulse_size.unit;
        var animationDuration = settings.pulse_animation_duration.size;
        var pulseScale = settings.pulse_scale.size;
        var uniqueId = 'hotspot-' + view.getID();
        
        var linkTag = 'div';
        var linkAttrs = 'class="hotspot"';
        
        if (settings.link && settings.link.url) {
            linkTag = 'a';
            linkAttrs = 'class="hotspot" href="' + settings.link.url + '"';
            
            if (settings.link.is_external) {
                linkAttrs += ' target="_blank"';
            }
            
            if (settings.link.nofollow) {
                linkAttrs += ' rel="nofollow"';
            }
        }
        #>
        <{{{ linkTag }}} {{{ linkAttrs }}}>
            <span class="animate-pulse" 
                  data-color="{{ pulseColor }}"
                  data-size="{{ pulseSize }}"
                  data-duration="{{ animationDuration }}"
                  data-scale="{{ pulseScale }}"></span>
            <span class="hotspot-text">{{{ settings.text }}}</span>
        </{{{ linkTag }}}>

        <style>
        .elementor-element-{{ view.getIDInt() }} .hotspot {
            display: flex;
            flex-direction: row;
            align-items: center;
            text-decoration: none;
        }
        
        .elementor-element-{{ view.getIDInt() }} a.hotspot {
            cursor: pointer;
        }
        
        .elementor-element-{{ view.getIDInt() }} a.hotspot:hover .hotspot-text {
            text-decoration: none;
        }

        .elementor-element-{{ view.getIDInt() }} .animate-pulse {
            position: relative;
            background-color: {{ pulseColor }};
            width: {{ pulseSize }} !important;
            height: {{ pulseSize }} !important;
            border-radius: 50%;
            display: block;
            flex-shrink: 0;
        }

        .elementor-element-{{ view.getIDInt() }} .animate-pulse::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100% !important;
            height: 100% !important;
            border-radius: 50%;
            background-color: {{ pulseColor }};
            animation: hotspot-ring-{{ view.getIDInt() }} {{ animationDuration }}s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes hotspot-ring-{{ view.getIDInt() }} {
            0% { 
                transform: scale(1); 
                opacity: 0.5; 
            }
            100% { 
                transform: scale({{ pulseScale }}); 
                opacity: 0; 
            }
        }
        </style>
        <?php
    }
}
