<?php
/**
 * Widget: Gradient Title
 * Widget para crear títulos con texto en degradado de color
 */

if (!defined('ABSPATH')) {
    exit;
}

class Gradient_Title_Widget extends \Elementor\Widget_Base {

    /**
     * Nombre del widget
     */
    public function get_name() {
        return 'gradient-title';
    }

    /**
     * Título del widget
     */
    public function get_title() {
        return esc_html__('Título con Degradado', 'interactive-3d-elements');
    }

    /**
     * Icono del widget
     */
    public function get_icon() {
        return 'eicon-animated-headline';
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
        return ['título', 'title', 'gradient', 'degradado', 'color', 'texto'];
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
            'title_html_tag',
            [
                'label' => esc_html__('Etiqueta HTML', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'p' => 'p',
                ],
            ]
        );

        // Repeater para las partes del título
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'text',
            [
                'label' => esc_html__('Texto', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Texto', 'interactive-3d-elements'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'use_gradient',
            [
                'label' => esc_html__('¿Usar Degradado?', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Sí', 'interactive-3d-elements'),
                'label_off' => esc_html__('No', 'interactive-3d-elements'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $repeater->add_control(
            'gradient_start',
            [
                'label' => esc_html__('Color Inicio', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#00d4ff',
                'condition' => [
                    'use_gradient' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'gradient_end',
            [
                'label' => esc_html__('Color Fin', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#bd00ff',
                'condition' => [
                    'use_gradient' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'solid_color',
            [
                'label' => esc_html__('Color Sólido', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'condition' => [
                    'use_gradient!' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'line_break',
            [
                'label' => esc_html__('Salto de Línea Después', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Sí', 'interactive-3d-elements'),
                'label_off' => esc_html__('No', 'interactive-3d-elements'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'title_parts',
            [
                'label' => esc_html__('Partes del Título', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'text' => esc_html__('Especialista en', 'interactive-3d-elements'),
                        'use_gradient' => 'no',
                        'solid_color' => '#000000',
                        'line_break' => 'yes',
                    ],
                    [
                        'text' => esc_html__('Endometriosis', 'interactive-3d-elements'),
                        'use_gradient' => 'yes',
                        'gradient_start' => '#2eb8b8',
                        'gradient_end' => '#bd00ff',
                        'line_break' => 'no',
                    ],
                    [
                        'text' => esc_html__(' y ', 'interactive-3d-elements'),
                        'use_gradient' => 'no',
                        'solid_color' => '#000000',
                        'line_break' => 'no',
                    ],
                    [
                        'text' => esc_html__('Fertilidad', 'interactive-3d-elements'),
                        'use_gradient' => 'yes',
                        'gradient_start' => '#2eb8b8',
                        'gradient_end' => '#bd00ff',
                        'line_break' => 'no',
                    ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->add_control(
            'alignment',
            [
                'label' => esc_html__('Alineación', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Izquierda', 'interactive-3d-elements'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Centro', 'interactive-3d-elements'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Derecha', 'interactive-3d-elements'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .gradient-title-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ===================
        // SECCIÓN: ESTILOS - TIPOGRAFÍA
        // ===================
        $this->start_controls_section(
            'typography_section',
            [
                'label' => esc_html__('Tipografía', 'interactive-3d-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .gradient-title',
            ]
        );

        $this->add_responsive_control(
            'word_spacing',
            [
                'label' => esc_html__('Espaciado entre Palabras', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -20,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .gradient-title' => 'word-spacing: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'letter_spacing',
            [
                'label' => esc_html__('Espaciado entre Letras', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => -5,
                        'max' => 20,
                    ],
                    'em' => [
                        'min' => -0.5,
                        'max' => 2,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .gradient-title' => 'letter-spacing: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'line_height',
            [
                'label' => esc_html__('Altura de Línea', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                    'em' => [
                        'min' => 0.5,
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .gradient-title' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ===================
        // SECCIÓN: EFECTOS
        // ===================
        $this->start_controls_section(
            'effects_section',
            [
                'label' => esc_html__('Efectos', 'interactive-3d-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'gradient_angle',
            [
                'label' => esc_html__('Ángulo del Degradado', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 360,
                    ],
                ],
                'default' => [
                    'size' => 90,
                ],
            ]
        );

        $this->add_control(
            'text_shadow',
            [
                'label' => esc_html__('Sombra de Texto', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Sí', 'interactive-3d-elements'),
                'label_off' => esc_html__('No', 'interactive-3d-elements'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'shadow_color',
            [
                'label' => esc_html__('Color de Sombra', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, 0.3)',
                'condition' => [
                    'text_shadow' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'shadow_blur',
            [
                'label' => esc_html__('Desenfoque de Sombra', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],
                'condition' => [
                    'text_shadow' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'enable_glow',
            [
                'label' => esc_html__('Efecto de Resplandor', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Sí', 'interactive-3d-elements'),
                'label_off' => esc_html__('No', 'interactive-3d-elements'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'glow_color',
            [
                'label' => esc_html__('Color de Resplandor', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#00ffaa',
                'condition' => [
                    'enable_glow' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'glow_intensity',
            [
                'label' => esc_html__('Intensidad del Resplandor', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'size' => 15,
                ],
                'condition' => [
                    'enable_glow' => 'yes',
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
        
        $html_tag = $settings['title_html_tag'];
        $title_parts = $settings['title_parts'];
        $gradient_angle = $settings['gradient_angle']['size'] ?? 90;
        
        // ID único para estilos inline
        $unique_id = 'gradient-title-' . $this->get_id();
        
        // Generar estilos dinámicos
        $dynamic_styles = '';
        
        // Estilos base
        $text_shadow = '';
        if ($settings['text_shadow'] === 'yes') {
            $shadow_color = $settings['shadow_color'];
            $shadow_blur = $settings['shadow_blur']['size'];
            $text_shadow = "text-shadow: 0 0 {$shadow_blur}px {$shadow_color};";
        }
        
        // Efecto de resplandor
        $glow_effect = '';
        if ($settings['enable_glow'] === 'yes') {
            $glow_color = $settings['glow_color'];
            $glow_intensity = $settings['glow_intensity']['size'];
            $glow_effect = "filter: drop-shadow(0 0 {$glow_intensity}px {$glow_color});";
        }
        
        ?>
        
        <div class="gradient-title-wrapper" id="<?php echo esc_attr($unique_id); ?>">
            <<?php echo $html_tag; ?> class="gradient-title" style="<?php echo esc_attr($text_shadow . ' ' . $glow_effect); ?>">
                <?php 
                foreach ($title_parts as $index => $part) {
                    $part_id = $unique_id . '-part-' . $index;
                    $text = $part['text'];
                    
                    if ($part['use_gradient'] === 'yes') {
                        $gradient_start = $part['gradient_start'];
                        $gradient_end = $part['gradient_end'];
                        
                        // Crear estilo inline para esta parte
                        $part_style = "
                            background: linear-gradient({$gradient_angle}deg, {$gradient_start}, {$gradient_end});
                            -webkit-background-clip: text;
                            -webkit-text-fill-color: transparent;
                            background-clip: text;
                            display: inline-block;
                        ";
                        
                        echo '<span class="gradient-text-part" style="' . esc_attr($part_style) . '">';
                        echo esc_html($text);
                        echo '</span>';
                    } else {
                        $solid_color = $part['solid_color'];
                        echo '<span style="color: ' . esc_attr($solid_color) . ';">';
                        echo esc_html($text);
                        echo '</span>';
                    }
                    
                    // Agregar salto de línea si está habilitado
                    if ($part['line_break'] === 'yes' && $index < count($title_parts) - 1) {
                        echo '<br>';
                    }
                }
                ?>
            </<?php echo $html_tag; ?>>
        </div>
        
        <?php
    }

    /**
     * Renderizar contenido en el editor (plantilla JS)
     */
    protected function content_template() {
        ?>
        <#
        var uniqueId = 'gradient-title-' + view.getID();
        var htmlTag = settings.title_html_tag || 'h2';
        var gradientAngle = settings.gradient_angle ? settings.gradient_angle.size : 90;
        
        var textShadow = '';
        if (settings.text_shadow === 'yes') {
            var shadowBlur = settings.shadow_blur ? settings.shadow_blur.size : 10;
            textShadow = 'text-shadow: 0 0 ' + shadowBlur + 'px ' + settings.shadow_color + ';';
        }
        
        var glowEffect = '';
        if (settings.enable_glow === 'yes') {
            var glowIntensity = settings.glow_intensity ? settings.glow_intensity.size : 15;
            glowEffect = 'filter: drop-shadow(0 0 ' + glowIntensity + 'px ' + settings.glow_color + ');';
        }
        
        var titleStyle = textShadow + ' ' + glowEffect;
        #>
        
        <div class="gradient-title-wrapper" id="{{{ uniqueId }}}">
            <{{{ htmlTag }}} class="gradient-title" style="{{{ titleStyle }}}">
                <# _.each(settings.title_parts, function(part, index) {
                    var partId = uniqueId + '-part-' + index;
                    var text = part.text;
                    
                    if (part.use_gradient === 'yes') {
                        var partStyle = 'background: linear-gradient(' + gradientAngle + 'deg, ' + part.gradient_start + ', ' + part.gradient_end + ');';
                        partStyle += '-webkit-background-clip: text;';
                        partStyle += '-webkit-text-fill-color: transparent;';
                        partStyle += 'background-clip: text;';
                        partStyle += 'display: inline-block;';
                        #>
                        <span class="gradient-text-part" style="{{{ partStyle }}}">{{{ text }}}</span>
                        <#
                    } else {
                        #>
                        <span style="color: {{{ part.solid_color }}};">{{{ text }}}</span>
                        <#
                    }
                    
                    if (part.line_break === 'yes' && index < settings.title_parts.length - 1) {
                        #><br><#
                    }
                }); #>
            </{{{ htmlTag }}}>
        </div>
        
        <?php
    }
}
