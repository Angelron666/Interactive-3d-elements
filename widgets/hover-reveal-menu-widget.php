<?php
/**
 * Widget: Hover Reveal Menu
 * Widget para crear menús interactivos con efecto de imagen reveal al hacer hover
 */

if (!defined('ABSPATH')) {
    exit;
}

class Hover_Reveal_Menu_Widget extends \Elementor\Widget_Base {

    /**
     * Nombre del widget
     */
    public function get_name() {
        return 'hover-reveal-menu';
    }

    /**
     * Título del widget
     */
    public function get_title() {
        return esc_html__('Menú Hover Reveal', 'interactive-3d-elements');
    }

    /**
     * Icono del widget
     */
    public function get_icon() {
        return 'eicon-nav-menu';
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
        return ['menú', 'menu', 'hover', 'reveal', 'imagen', 'image', 'interactivo'];
    }

    /**
     * Registrar controles del widget
     */
    protected function register_controls() {

        // ===================
        // SECCIÓN: ELEMENTOS DEL MENÚ
        // ===================
        $this->start_controls_section(
            'menu_items_section',
            [
                'label' => esc_html__('Elementos del Menú', 'interactive-3d-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Repeater para los elementos del menú
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'text',
            [
                'label' => esc_html__('Texto', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Elemento de Menú', 'interactive-3d-elements'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Enlace', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://ejemplo.com', 'interactive-3d-elements'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Imagen', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'menu_items',
            [
                'label' => esc_html__('Elementos', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'text' => esc_html__('Branding', 'interactive-3d-elements'),
                        'link' => ['url' => '#'],
                    ],
                    [
                        'text' => esc_html__('Diseño Gráfico', 'interactive-3d-elements'),
                        'link' => ['url' => '#'],
                    ],
                    [
                        'text' => esc_html__('Interiorismo', 'interactive-3d-elements'),
                        'link' => ['url' => '#'],
                    ],
                    [
                        'text' => esc_html__('Estrategia', 'interactive-3d-elements'),
                        'link' => ['url' => '#'],
                    ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->end_controls_section();

        // ===================
        // SECCIÓN: CONFIGURACIÓN
        // ===================
        $this->start_controls_section(
            'settings_section',
            [
                'label' => esc_html__('Configuración', 'interactive-3d-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'max_width',
            [
                'label' => esc_html__('Ancho Máximo', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 300,
                        'max' => 1400,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 900,
                ],
                'selectors' => [
                    '{{WRAPPER}} .menu-wrapper' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_height',
            [
                'label' => esc_html__('Altura del Contenedor', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh', '%'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1200,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'vh',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hover-reveal-menu-wrapper' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'horizontal_align',
            [
                'label' => esc_html__('Alineación Horizontal', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Izquierda', 'interactive-3d-elements'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Centro', 'interactive-3d-elements'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Derecha', 'interactive-3d-elements'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .hover-reveal-menu-wrapper' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'vertical_align',
            [
                'label' => esc_html__('Alineación Vertical', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Arriba', 'interactive-3d-elements'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__('Centro', 'interactive-3d-elements'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Abajo', 'interactive-3d-elements'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .hover-reveal-menu-wrapper' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'flex_separator',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'flex_direction',
            [
                'label' => esc_html__('Dirección Flex', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__('Fila →', 'interactive-3d-elements'),
                        'icon' => 'eicon-arrow-right',
                    ],
                    'column' => [
                        'title' => esc_html__('Columna ↓', 'interactive-3d-elements'),
                        'icon' => 'eicon-arrow-down',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__('Fila Inversa ←', 'interactive-3d-elements'),
                        'icon' => 'eicon-arrow-left',
                    ],
                    'column-reverse' => [
                        'title' => esc_html__('Columna Inversa ↑', 'interactive-3d-elements'),
                        'icon' => 'eicon-arrow-up',
                    ],
                ],
                'default' => 'column',
                'selectors' => [
                    '{{WRAPPER}} .menu-list' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'flex_wrap',
            [
                'label' => esc_html__('Ajuste de Línea (Wrap)', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'nowrap' => esc_html__('Sin Ajuste', 'interactive-3d-elements'),
                    'wrap' => esc_html__('Ajustar', 'interactive-3d-elements'),
                    'wrap-reverse' => esc_html__('Ajustar Inverso', 'interactive-3d-elements'),
                ],
                'default' => 'nowrap',
                'selectors' => [
                    '{{WRAPPER}} .menu-list' => 'flex-wrap: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'flex_gap',
            [
                'label' => esc_html__('Espaciado entre Elementos (Gap)', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .menu-list' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'flex_justify',
            [
                'label' => esc_html__('Justificar Contenido', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'flex-start' => esc_html__('Inicio', 'interactive-3d-elements'),
                    'center' => esc_html__('Centro', 'interactive-3d-elements'),
                    'flex-end' => esc_html__('Final', 'interactive-3d-elements'),
                    'space-between' => esc_html__('Espacio Entre', 'interactive-3d-elements'),
                    'space-around' => esc_html__('Espacio Alrededor', 'interactive-3d-elements'),
                    'space-evenly' => esc_html__('Espacio Uniforme', 'interactive-3d-elements'),
                ],
                'default' => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .menu-list' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'flex_align_items',
            [
                'label' => esc_html__('Alinear Elementos', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'flex-start' => esc_html__('Inicio', 'interactive-3d-elements'),
                    'center' => esc_html__('Centro', 'interactive-3d-elements'),
                    'flex-end' => esc_html__('Final', 'interactive-3d-elements'),
                    'stretch' => esc_html__('Estirar', 'interactive-3d-elements'),
                    'baseline' => esc_html__('Línea Base', 'interactive-3d-elements'),
                ],
                'default' => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .menu-list' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => esc_html__('Ancho de Imagen', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vw'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1200,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 350,
                ],
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label' => esc_html__('Alto de Imagen', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1200,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 450,
                ],
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => esc_html__('Radio del Borde de Imagen', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'size' => 4,
                    'unit' => 'px',
                ],
            ]
        );

        $this->add_control(
            'image_position',
            [
                'label' => esc_html__('Posición de la Imagen', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'behind' => esc_html__('Detrás del Texto', 'interactive-3d-elements'),
                    'front' => esc_html__('Delante del Texto', 'interactive-3d-elements'),
                ],
                'default' => 'behind',
            ]
        );

        $this->end_controls_section();

        // ===================
        // SECCIÓN: ESTILOS - TEXTO
        // ===================
        $this->start_controls_section(
            'text_style_section',
            [
                'label' => esc_html__('Texto', 'interactive-3d-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .menu-text',
            ]
        );

        $this->add_control(
            'text_initial_style',
            [
                'label' => esc_html__('Estilo del Texto (Estado Inicial)', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'outline' => esc_html__('Outline/Borde (Transparente)', 'interactive-3d-elements'),
                    'solid' => esc_html__('Sólido (Con Color)', 'interactive-3d-elements'),
                ],
                'default' => 'outline',
                'description' => esc_html__('Elige si el texto sin hover es transparente con borde o sólido con color', 'interactive-3d-elements'),
            ]
        );

        $this->add_control(
            'text_initial_color',
            [
                'label' => esc_html__('Color del Texto (Estado Inicial)', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1a1a1a',
                'condition' => [
                    'text_initial_style' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'text_stroke_color',
            [
                'label' => esc_html__('Color del Borde', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1a1a1a',
                'selectors' => [
                    '{{WRAPPER}} .menu-text' => '-webkit-text-stroke-color: {{VALUE}};',
                ],
                'condition' => [
                    'text_initial_style' => 'outline',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_stroke_width',
            [
                'label' => esc_html__('Grosor del Borde', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .menu-text' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'text_initial_style' => 'outline',
                ],
            ]
        );

        $this->add_control(
            'text_fill_color',
            [
                'label' => esc_html__('Color de Relleno (Hover)', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1a1a1a',
            ]
        );

        $this->add_responsive_control(
            'text_shift',
            [
                'label' => esc_html__('Desplazamiento al Hover', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -50,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 20,
                ],
            ]
        );

        $this->end_controls_section();

        // ===================
        // SECCIÓN: ESTILOS - SEPARADORES
        // ===================
        $this->start_controls_section(
            'separator_style_section',
            [
                'label' => esc_html__('Separadores (Opcional)', 'interactive-3d-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'show_separators',
            [
                'label' => esc_html__('Mostrar Separadores', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Sí', 'interactive-3d-elements'),
                'label_off' => esc_html__('No', 'interactive-3d-elements'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'separator_color',
            [
                'label' => esc_html__('Color', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ccc',
                'selectors' => [
                    '{{WRAPPER}} .menu-item' => 'border-bottom-color: {{VALUE}};',
                ],
                'condition' => [
                    'show_separators' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'separator_width',
            [
                'label' => esc_html__('Grosor', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .menu-item' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_separators' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_spacing',
            [
                'label' => esc_html__('Espaciado entre Items', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .menu-item' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'vertical_separator_divider',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'show_vertical_separators',
            [
                'label' => esc_html__('Separadores Verticales (Entre Elementos)', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Sí', 'interactive-3d-elements'),
                'label_off' => esc_html__('No', 'interactive-3d-elements'),
                'return_value' => 'yes',
                'default' => 'no',
                'description' => esc_html__('Agrega una línea vertical entre elementos usando ::after. Ideal para menús horizontales.', 'interactive-3d-elements'),
            ]
        );

        $this->add_control(
            'vertical_separator_color',
            [
                'label' => esc_html__('Color de Separador Vertical', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ccc',
                'condition' => [
                    'show_vertical_separators' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'vertical_separator_height',
            [
                'label' => esc_html__('Altura del Separador Vertical', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 60,
                    'unit' => '%',
                ],
                'condition' => [
                    'show_vertical_separators' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'vertical_separator_width',
            [
                'label' => esc_html__('Grosor del Separador Vertical', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'size' => 1,
                ],
                'condition' => [
                    'show_vertical_separators' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'vertical_separator_spacing',
            [
                'label' => esc_html__('Espaciado del Separador Vertical', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 20,
                ],
                'description' => esc_html__('Distancia desde el borde derecho del elemento', 'interactive-3d-elements'),
                'condition' => [
                    'show_vertical_separators' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // ===================
        // SECCIÓN: ESTILOS - EFECTOS
        // ===================
        $this->start_controls_section(
            'effects_section',
            [
                'label' => esc_html__('Efectos', 'interactive-3d-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'inactive_opacity',
            [
                'label' => esc_html__('Opacidad Items Inactivos', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 0.3,
                ],
            ]
        );

        $this->add_control(
            'transition_duration',
            [
                'label' => esc_html__('Duración de Transición (ms)', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 50,
                    ],
                ],
                'default' => [
                    'size' => 300,
                ],
            ]
        );

        $this->add_control(
            'image_scale_initial',
            [
                'label' => esc_html__('Escala Inicial de Imagen', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 0.8,
                ],
            ]
        );

        $this->end_controls_section();

        // ===================
        // SECCIÓN: ESTILOS - FONDO
        // ===================
        $this->start_controls_section(
            'background_section',
            [
                'label' => esc_html__('Fondo', 'interactive-3d-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .hover-reveal-menu-wrapper',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                    'color' => [
                        'default' => '#f3f3f3',
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => esc_html__('Padding', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .hover-reveal-menu-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Renderizar widget
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        $unique_id = 'hover-reveal-menu-' . $this->get_id();
        $menu_items = $settings['menu_items'];
        
        // Configuración
        $image_width = $settings['image_width']['size'] ?? 280;
        $image_width_unit = $settings['image_width']['unit'] ?? 'px';
        $image_height = $settings['image_height']['size'] ?? 350;
        $image_height_unit = $settings['image_height']['unit'] ?? 'px';
        $image_border_radius = $settings['image_border_radius']['size'] ?? 6;
        $image_border_radius_unit = $settings['image_border_radius']['unit'] ?? 'px';
        $text_shift = $settings['text_shift']['size'] ?? 0;
        $text_fill_color = $settings['text_fill_color'] ?? '#1a1a1a';
        $inactive_opacity = $settings['inactive_opacity']['size'] ?? 0.3;
        $transition_duration = ($settings['transition_duration']['size'] ?? 300) / 1000;
        $image_scale = $settings['image_scale_initial']['size'] ?? 0.8;
        $image_position = $settings['image_position'] ?? 'behind';
        
        $show_separators = $settings['show_separators'] ?? 'no';
        $separator_color = $settings['separator_color'] ?? '#ccc';
        $separator_width = $settings['separator_width']['size'] ?? 1;

        $text_initial_style = $settings['text_initial_style'] ?? 'outline';
        $text_initial_color = $settings['text_initial_color'] ?? '#1a1a1a';
        $text_stroke_color = $settings['text_stroke_color'] ?? '#1a1a1a';
        $text_stroke_width = $settings['text_stroke_width']['size'] ?? 1;
        
        // Calcular z-index basado en la posición
        // El texto tiene z-index: 10 en CSS
        // Si 'front', imagen > 10. Si 'behind', imagen < 10 pero > fondo.
        $image_z_index = ($image_position === 'front') ? 15 : 5;
        $text_z_index = 10;
        
        ?>
        
        <style>
             #<?php echo esc_attr($unique_id); ?> .menu-item:hover .menu-text {
                color: <?php echo esc_attr($text_fill_color); ?>;
                transform: translateY(-3px) translateX(<?php echo esc_attr($text_shift); ?>px);
            }
            
            #<?php echo esc_attr($unique_id); ?> .menu-list:hover .menu-item:not(:hover) {
                opacity: <?php echo esc_attr($inactive_opacity); ?>;
            }
            
            #<?php echo esc_attr($unique_id); ?> .menu-item {
                transition: opacity <?php echo esc_attr($transition_duration); ?>s;
                <?php if ($show_separators === 'yes') : ?>
                border-right: <?php echo $separator_width; ?>px solid <?php echo $separator_color; ?>;
                <?php endif; ?>
            }
            
            #<?php echo esc_attr($unique_id); ?> .menu-text {
                transition: all <?php echo esc_attr($transition_duration); ?>s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                <?php if ($text_initial_style === 'solid') : ?>
                /* Texto sólido con color */
                color: <?php echo esc_attr($text_initial_color); ?>;
                -webkit-text-stroke-width: 0;
                <?php else : ?>
                /* Texto outline/borde transparente */
                color: transparent;
                -webkit-text-stroke: <?php echo $text_stroke_width; ?>px <?php echo $text_stroke_color; ?>;
                <?php endif; ?>
            }
            
            #<?php echo esc_attr($unique_id); ?> .menu-wrapper {
                position: relative;
                z-index: <?php echo esc_attr($text_z_index); ?>;
                /* Asegura que el z-index funcione en el contexto de apilamiento */
                transform: translateZ(0); 
            }

            #<?php echo esc_attr($unique_id); ?> .hover-reveal-container {
                width: <?php echo esc_attr($image_width . $image_width_unit); ?>;
                height: <?php echo esc_attr($image_height . $image_height_unit); ?>;
                border-radius: <?php echo esc_attr($image_border_radius . $image_border_radius_unit); ?>;
                transform: translate(-50%, -50%) scale(<?php echo esc_attr($image_scale); ?>);
                transition: opacity <?php echo esc_attr($transition_duration); ?>s ease, transform <?php echo esc_attr($transition_duration); ?>s ease;
                z-index: <?php echo esc_attr($image_z_index); ?>;
            }
            
            #<?php echo esc_attr($unique_id); ?> .hover-reveal-container.active {
                transform: translate(-50%, -50%) scale(1);
            }
        </style>
        
        <div class="hover-reveal-menu-wrapper" id="<?php echo esc_attr($unique_id); ?>">
            <div class="menu-wrapper">
                <ul class="menu-list">
                    <?php foreach ($menu_items as $item) : 
                        $image_url = !empty($item['image']['url']) ? $item['image']['url'] : '';
                        $link_url = !empty($item['link']['url']) ? $item['link']['url'] : '#';
                        $is_external = !empty($item['link']['is_external']) ? 'target="_blank"' : '';
                        $nofollow = !empty($item['link']['nofollow']) ? 'rel="nofollow"' : '';
                    ?>
                        <li class="menu-item" data-img="<?php echo esc_url($image_url); ?>">
                            <a href="<?php echo esc_url($link_url); ?>" class="menu-link" <?php echo $is_external . ' ' . $nofollow; ?>>
                                <span class="menu-text"><?php echo esc_html($item['text']); ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="hover-reveal-container">
                <img src="" class="hover-reveal__img" alt="Hover Image">
            </div>
        </div>
        
        <script>
        (function() {
            const container = document.getElementById('<?php echo esc_js($unique_id); ?>');
            if (!container) return;
            
            const menuItems = container.querySelectorAll('.menu-item');
            const revealContainer = container.querySelector('.hover-reveal-container');
            const revealImg = container.querySelector('.hover-reveal__img');
            
            let isHovering = false;
            let mouseX = 0;
            let mouseY = 0;
            let revealX = 0;
            let revealY = 0;

            // Suavizar el movimiento de la imagen
            function animate() {
                // Interpolación para movimiento más suave
                revealX += (mouseX - revealX) * 0.1;
                revealY += (mouseY - revealY) * 0.1;
                
                if (isHovering) {
                    revealContainer.style.left = revealX + 'px';
                    revealContainer.style.top = revealY + 'px';
                }
                
                requestAnimationFrame(animate);
            }
            
            animate();

            // Track mouse globally for fixed position
            document.addEventListener('mousemove', (e) => {
                mouseX = e.clientX;
                mouseY = e.clientY;
            });

            // Lógica de Hover para cada item
            menuItems.forEach(item => {
                item.addEventListener('mouseenter', () => {
                    isHovering = true;
                    
                    // Cambiar la imagen
                    const imgUrl = item.getAttribute('data-img');
                    if (imgUrl) {
                        // Precargar la imagen
                        const img = new Image();
                        img.src = imgUrl;
                        img.onload = () => {
                            revealImg.src = imgUrl;
                            revealContainer.classList.add('active');
                        };
                        revealImg.src = imgUrl; // Carga inmediata para mejor UX
                        revealContainer.classList.add('active');
                    }
                });

                item.addEventListener('mouseleave', () => {
                    isHovering = false;
                    revealContainer.classList.remove('active');
                });
            });
            
            // Detectar si es un dispositivo táctil
            const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
            
            if (isTouchDevice) {
                // Para dispositivos táctiles, mostrar/ocultar con click
                menuItems.forEach(item => {
                    item.addEventListener('click', (e) => {
                         if (item.getAttribute('data-img')) {
                             // Lógica opcional táctil
                        }
                    });
                });
            }
        })();
        </script>
        
        <?php
    }

    /**
     * Renderizar contenido en el editor (plantilla JS)
     */
    protected function content_template() {
        ?>
        <#
        var uniqueId = 'hover-reveal-menu-' + view.getID();
        var imageWidth = settings.image_width.size || 280;
        var imageWidthUnit = settings.image_width.unit || 'px';
        var imageHeight = settings.image_height.size || 350;
        var imageHeightUnit = settings.image_height.unit || 'px';
        var imageBorderRadius = settings.image_border_radius.size || 6;
        var imageBorderRadiusUnit = settings.image_border_radius.unit || 'px';
        var textShift = settings.text_shift.size || 0;
        var textFillColor = settings.text_fill_color || '#1a1a1a';
        var inactiveOpacity = settings.inactive_opacity.size || 0.3;
        var transitionDuration = (settings.transition_duration.size || 300) / 1000;
        var imageScale = settings.image_scale_initial.size || 0.8;
        
        var showSeparators = settings.show_separators || 'no';
        var separatorColor = settings.separator_color || '#ccc';
        var separatorWidth = settings.separator_width.size || 1;
        
        var textInitialStyle = settings.text_initial_style || 'outline';
        var textInitialColor = settings.text_initial_color || '#1a1a1a';
        var textStrokeColor = settings.text_stroke_color || '#1a1a1a';
        var textStrokeWidth = settings.text_stroke_width.size || 1;
        
        var imagePosition = settings.image_position || 'behind';
        var imageZIndex = (imagePosition === 'front') ? 15 : 5;
        var textZIndex = 10;
        #>
        
        <style>
             #{{{ uniqueId }}} .menu-item:hover .menu-text {
                color: {{{ textFillColor }}};
                transform: translateY(-3px) translateX({{{ textShift }}}px);
            }
            
            #{{{ uniqueId }}} .menu-list:hover .menu-item:not(:hover) {
                opacity: {{{ inactiveOpacity }}};
            }
            
            #{{{ uniqueId }}} .menu-item {
                transition: opacity {{{ transitionDuration }}}s;
                 <# if (showSeparators === 'yes') { #>
                border-right: {{{ separatorWidth }}}px solid {{{ separatorColor }}};
                <# } #>
            }
            
            #{{{ uniqueId }}} .menu-text {
                transition: all {{{ transitionDuration }}}s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                <# if (textInitialStyle === 'solid') { #>
                color: {{{ textInitialColor }}};
                -webkit-text-stroke-width: 0;
                <# } else { #>
                color: transparent;
                -webkit-text-stroke: {{{ textStrokeWidth }}}px {{{ textStrokeColor }}};
                <# } #>
            }
            
            #{{{ uniqueId }}} .menu-wrapper {
                position: relative;
                z-index: {{{ textZIndex }}};
                transform: translateZ(0);
            }

            #{{{ uniqueId }}} .hover-reveal-container {
                width: {{{ imageWidth }}}{{{ imageWidthUnit }}};
                height: {{{ imageHeight }}}{{{ imageHeightUnit }}};
                border-radius: {{{ imageBorderRadius }}}{{{ imageBorderRadiusUnit }}};
                transform: translate(-50%, -50%) scale({{{ imageScale }}});
                transition: opacity {{{ transitionDuration }}}s ease, transform {{{ transitionDuration }}}s ease;
                z-index: {{{ imageZIndex }}};
            }
            
             #{{{ uniqueId }}} .hover-reveal-container.active {
                transform: translate(-50%, -50%) scale(1);
            }
        </style>
        
        <div class="hover-reveal-menu-wrapper" id="{{{ uniqueId }}}">
            <div class="menu-wrapper">
                <ul class="menu-list">
                    <# _.each(settings.menu_items, function(item) {
                        var imageUrl = item.image.url || '';
                        var linkUrl = item.link.url || '#';
                    #>
                        <li class="menu-item" data-img="{{{ imageUrl }}}">
                            <a href="{{{ linkUrl }}}" class="menu-link">
                                <span class="menu-text">{{{ item.text }}}</span>
                            </a>
                        </li>
                    <# }); #>
                </ul>
            </div>

            <div class="hover-reveal-container">
                <img src="" class="hover-reveal__img" alt="Hover Image">
            </div>
        </div>
        
        <?php
    }
}
