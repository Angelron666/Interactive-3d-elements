<?php
/**
 * Clase Base para Widgets de Interactive 3D Elements
 * 
 * Esta clase proporciona funcionalidad común para todos los widgets del plugin.
 * Los nuevos widgets pueden extender esta clase para heredar funcionalidades comunes.
 */

if (!defined('ABSPATH')) {
    exit;
}

abstract class I3D_Widget_Base extends \Elementor\Widget_Base {

    /**
     * Prefijo común para todos los widgets
     */
    protected $widget_prefix = 'i3d';

    /**
     * Categoría por defecto para los widgets
     */
    public function get_categories() {
        return ['interactive-3d'];
    }

    /**
     * Palabras clave comunes
     */
    public function get_keywords() {
        return ['3d', 'interactive', 'animación', 'hover'];
    }

    /**
     * Obtener ID único del widget
     */
    protected function get_unique_id() {
        return $this->widget_prefix . '-' . $this->get_id();
    }

    /**
     * Agregar controles de efecto 3D comunes
     * Puede ser llamado desde cualquier widget para agregar opciones de efectos 3D
     */
    protected function register_3d_effect_controls() {
        $this->start_controls_section(
            'effect_3d_section',
            [
                'label' => esc_html__('Efecto 3D', 'interactive-3d-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'effect_3d_type',
            [
                'label' => esc_html__('Tipo de Efecto', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'tilt',
                'options' => [
                    'none' => esc_html__('Sin Efecto', 'interactive-3d-elements'),
                    'tilt' => esc_html__('Inclinación 3D', 'interactive-3d-elements'),
                    'float' => esc_html__('Flotar', 'interactive-3d-elements'),
                    'zoom' => esc_html__('Zoom', 'interactive-3d-elements'),
                    'flip-x' => esc_html__('Voltear Horizontal', 'interactive-3d-elements'),
                    'flip-y' => esc_html__('Voltear Vertical', 'interactive-3d-elements'),
                    'swing' => esc_html__('Balanceo', 'interactive-3d-elements'),
                    'pulse' => esc_html__('Pulso', 'interactive-3d-elements'),
                ],
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'effect_3d_intensity',
            [
                'label' => esc_html__('Intensidad del Efecto', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 30,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],
                'condition' => [
                    'effect_3d_type!' => 'none',
                ],
            ]
        );

        $this->add_control(
            'effect_3d_speed',
            [
                'label' => esc_html__('Velocidad de Transición (ms)', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 2000,
                        'step' => 50,
                    ],
                ],
                'default' => [
                    'size' => 700,
                ],
                'selectors' => [
                    '{{WRAPPER}} .i3d-card' => 'transition-duration: {{SIZE}}ms;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Agregar controles de efectos cyberpunk comunes
     */
    protected function register_cyberpunk_effect_controls() {
        $this->start_controls_section(
            'effects_style_section',
            [
                'label' => esc_html__('Efectos Cyberpunk', 'interactive-3d-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'glow_color',
            [
                'label' => esc_html__('Color de Resplandor', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#00ffaa',
            ]
        );

        $this->add_control(
            'enable_particles',
            [
                'label' => esc_html__('Mostrar Partículas', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Sí', 'interactive-3d-elements'),
                'label_off' => esc_html__('No', 'interactive-3d-elements'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'enable_scan_line',
            [
                'label' => esc_html__('Mostrar Línea de Escaneo', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Sí', 'interactive-3d-elements'),
                'label_off' => esc_html__('No', 'interactive-3d-elements'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'enable_corner_elements',
            [
                'label' => esc_html__('Mostrar Esquinas', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Sí', 'interactive-3d-elements'),
                'label_off' => esc_html__('No', 'interactive-3d-elements'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Generar clases CSS para el contenedor basado en los ajustes
     */
    protected function get_container_classes($settings) {
        $effect_type = $settings['effect_3d_type'] ?? 'tilt';
        $intensity = $settings['effect_3d_intensity']['size'] ?? 10;
        
        $classes = 'i3d-container noselect';
        $classes .= ' i3d-effect-' . esc_attr($effect_type);
        $classes .= ' i3d-intensity-' . esc_attr($intensity);
        
        return $classes;
    }

    /**
     * Renderizar trackers para efecto 3D (grid 5x5 = 25 trackers)
     */
    protected function render_trackers() {
        for ($i = 1; $i <= 25; $i++) {
            echo '<div class="i3d-tracker i3d-tr-' . $i . '"></div>';
        }
    }

    /**
     * Renderizar efectos cyberpunk comunes
     */
    protected function render_cyberpunk_effects($settings) {
        $enable_particles = ($settings['enable_particles'] ?? 'yes') === 'yes';
        $enable_scan_line = ($settings['enable_scan_line'] ?? 'yes') === 'yes';
        $enable_corner_elements = ($settings['enable_corner_elements'] ?? 'yes') === 'yes';
        ?>
        
        <!-- Efectos cyberpunk -->
        <div class="i3d-card-glare"></div>
        
        <div class="i3d-cyber-lines">
            <span></span><span></span><span></span><span></span>
        </div>
        
        <div class="i3d-glowing-elements">
            <div class="i3d-glow-1"></div>
            <div class="i3d-glow-2"></div>
            <div class="i3d-glow-3"></div>
        </div>
        
        <?php if ($enable_particles) : ?>
        <div class="i3d-card-particles">
            <span></span><span></span><span></span>
            <span></span><span></span><span></span>
        </div>
        <?php endif; ?>
        
        <?php if ($enable_corner_elements) : ?>
        <div class="i3d-corner-elements">
            <span></span><span></span><span></span><span></span>
        </div>
        <?php endif; ?>
        
        <?php if ($enable_scan_line) : ?>
        <div class="i3d-scan-line"></div>
        <?php endif; ?>
        
        <?php
    }
}
