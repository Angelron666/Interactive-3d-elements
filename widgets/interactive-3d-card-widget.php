<?php
/**
 * Widget: Interactive 3D Card
 * Tarjeta 3D interactiva estilo cyberpunk para Elementor
 */

if (!defined('ABSPATH')) {
    exit;
}

class Interactive_3D_Card_Widget extends \Elementor\Widget_Base {

    /**
     * Nombre del widget
     */
    public function get_name() {
        return 'interactive-3d-card';
    }

    /**
     * Título del widget
     */
    public function get_title() {
        return esc_html__('Tarjeta 3D Interactiva', 'interactive-3d-elements');
    }

    /**
     * Icono del widget
     */
    public function get_icon() {
        return 'eicon-flip-box';
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
        return ['3d', 'card', 'tarjeta', 'interactive', 'cyberpunk', 'hover', 'animación'];
    }

    /**
     * Dependencias de estilo
     */
    public function get_style_depends() {
        return ['interactive-3d-card'];
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
            'card_title',
            [
                'label' => esc_html__('Título', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('DISEÑO WEB', 'interactive-3d-elements'),
                'placeholder' => esc_html__('Ingresa el título', 'interactive-3d-elements'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'card_description',
            [
                'label' => esc_html__('Descripción', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Interfaces modernas y funcionales para potenciar tu presencia digital', 'interactive-3d-elements'),
                'placeholder' => esc_html__('Ingresa la descripción', 'interactive-3d-elements'),
            ]
        );

        $this->add_control(
            'card_image',
            [
                'label' => esc_html__('Imagen de Fondo', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                ],
                'render_type' => 'template',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'card_link',
            [
                'label' => esc_html__('Enlace', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://tu-enlace.com', 'interactive-3d-elements'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // ===================
        // SECCIÓN: DIMENSIONES
        // ===================
        $this->start_controls_section(
            'dimensions_section',
            [
                'label' => esc_html__('Dimensiones', 'interactive-3d-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'card_width',
            [
                'label' => esc_html__('Ancho', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 600,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 190,
                ],
                'selectors' => [
                    '{{WRAPPER}} .i3d-container' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_height',
            [
                'label' => esc_html__('Alto', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 800,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 254,
                ],
                'selectors' => [
                    '{{WRAPPER}} .i3d-container' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'card_border_radius',
            [
                'label' => esc_html__('Radio del Borde', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .i3d-card' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ===================
        // SECCIÓN: ESTILOS - TÍTULO
        // ===================
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => esc_html__('Título', 'interactive-3d-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .i3d-service-title',
            ]
        );

        $this->add_control(
            'title_gradient_start',
            [
                'label' => esc_html__('Color Gradiente Inicio', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#00ffaa',
            ]
        );

        $this->add_control(
            'title_gradient_middle',
            [
                'label' => esc_html__('Color Gradiente Medio', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#00a2ff',
            ]
        );

        $this->add_control(
            'title_gradient_end',
            [
                'label' => esc_html__('Color Gradiente Fin', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ff00f7',
            ]
        );

        $this->end_controls_section();

        // ===================
        // SECCIÓN: ESTILOS - DESCRIPCIÓN
        // ===================
        $this->start_controls_section(
            'description_style_section',
            [
                'label' => esc_html__('Descripción', 'interactive-3d-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .i3d-service-description',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Color', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .i3d-service-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ===================
        // SECCIÓN: ESTILOS - EFECTOS
        // ===================
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
            'corner_color',
            [
                'label' => esc_html__('Color de Esquinas', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(92, 103, 255, 0.3)',
            ]
        );

        $this->add_control(
            'corner_hover_color',
            [
                'label' => esc_html__('Color de Esquinas (Hover)', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(92, 103, 255, 0.8)',
            ]
        );

        $this->add_control(
            'cyber_lines_color',
            [
                'label' => esc_html__('Color de Líneas Cyber', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(92, 103, 255, 0.2)',
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label' => esc_html__('Color de Overlay (Hover)', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(0, 5, 15, 0.75)',
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

        // ===================
        // SECCIÓN: EFECTO 3D
        // ===================
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

        $this->add_control(
            'effect_3d_perspective',
            [
                'label' => esc_html__('Perspectiva', 'interactive-3d-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 200,
                        'max' => 2000,
                        'step' => 50,
                    ],
                ],
                'default' => [
                    'size' => 800,
                ],
                'selectors' => [
                    '{{WRAPPER}} .i3d-canvas' => 'perspective: {{SIZE}}px;',
                ],
                'condition' => [
                    'effect_3d_type' => 'tilt',
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
        
        $title = $settings['card_title'];
        $description = $settings['card_description'];
        $image_url = $settings['card_image']['url'] ?? '';
        $link = $settings['card_link'];
        
        // Colores personalizados
        $gradient_start = $settings['title_gradient_start'];
        $gradient_middle = $settings['title_gradient_middle'];
        $gradient_end = $settings['title_gradient_end'];
        $glow_color = $settings['glow_color'];
        $corner_color = $settings['corner_color'];
        $corner_hover_color = $settings['corner_hover_color'];
        $cyber_lines_color = $settings['cyber_lines_color'];
        $overlay_color = $settings['overlay_color'];
        
        // Opciones de efectos
        $enable_particles = $settings['enable_particles'] === 'yes';
        $enable_scan_line = $settings['enable_scan_line'] === 'yes';
        $enable_corner_elements = $settings['enable_corner_elements'] === 'yes';

        // Opciones de efecto 3D
        $effect_3d_type = $settings['effect_3d_type'] ?? 'tilt';
        $effect_3d_intensity = $settings['effect_3d_intensity']['size'] ?? 10;

        // ID único para estilos inline
        $unique_id = 'i3d-' . $this->get_id();
        
        // Generar estilos dinámicos
        $dynamic_styles = "
            #{$unique_id} .i3d-service-title {
                background: linear-gradient(45deg, {$gradient_start}, {$gradient_middle}, {$gradient_end});
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                filter: drop-shadow(0 0 8px {$glow_color}70);
            }
            #{$unique_id} .i3d-glow-1,
            #{$unique_id} .i3d-glow-2,
            #{$unique_id} .i3d-glow-3 {
                background: radial-gradient(circle at center, {$glow_color}4D 0%, transparent 70%);
            }
            #{$unique_id} .i3d-card-particles span {
                background: {$glow_color};
            }
            #{$unique_id} .i3d-corner-elements span {
                border-color: {$corner_color};
            }
            #{$unique_id} .i3d-card:hover .i3d-corner-elements span {
                border-color: {$corner_hover_color};
                box-shadow: 0 0 10px {$corner_hover_color};
            }
            #{$unique_id} .i3d-cyber-lines span {
                background: linear-gradient(90deg, transparent, {$cyber_lines_color}, transparent);
            }
            #{$unique_id} .i3d-tracker:hover ~ .i3d-card .i3d-service-text::after {
                background: {$overlay_color};
            }
        ";
        
        // Wrapper con enlace opcional
        $wrapper_start = '';
        $wrapper_end = '';
        
        if (!empty($link['url'])) {
            $this->add_link_attributes('card_link', $link);
            $wrapper_start = '<a ' . $this->get_render_attribute_string('card_link') . ' class="i3d-link-wrapper">';
            $wrapper_end = '</a>';
        }

        // Clases del contenedor
        $container_classes = 'i3d-container noselect';
        $container_classes .= ' i3d-effect-' . esc_attr($effect_3d_type);
        $container_classes .= ' i3d-intensity-' . esc_attr($effect_3d_intensity);
        ?>
        
        <style><?php echo $dynamic_styles; ?></style>
        
        <?php echo $wrapper_start; ?>
        <div id="<?php echo esc_attr($unique_id); ?>" class="<?php echo esc_attr($container_classes); ?>" data-effect="<?php echo esc_attr($effect_3d_type); ?>" data-intensity="<?php echo esc_attr($effect_3d_intensity); ?>">
            <div class="i3d-canvas">
                <!-- Trackers para efecto 3D -->
                <div class="i3d-tracker i3d-tr-1"></div>
                <div class="i3d-tracker i3d-tr-2"></div>
                <div class="i3d-tracker i3d-tr-3"></div>
                <div class="i3d-tracker i3d-tr-4"></div>
                <div class="i3d-tracker i3d-tr-5"></div>
                <div class="i3d-tracker i3d-tr-6"></div>
                <div class="i3d-tracker i3d-tr-7"></div>
                <div class="i3d-tracker i3d-tr-8"></div>
                <div class="i3d-tracker i3d-tr-9"></div>
                <div class="i3d-tracker i3d-tr-10"></div>
                <div class="i3d-tracker i3d-tr-11"></div>
                <div class="i3d-tracker i3d-tr-12"></div>
                <div class="i3d-tracker i3d-tr-13"></div>
                <div class="i3d-tracker i3d-tr-14"></div>
                <div class="i3d-tracker i3d-tr-15"></div>
                <div class="i3d-tracker i3d-tr-16"></div>
                <div class="i3d-tracker i3d-tr-17"></div>
                <div class="i3d-tracker i3d-tr-18"></div>
                <div class="i3d-tracker i3d-tr-19"></div>
                <div class="i3d-tracker i3d-tr-20"></div>
                <div class="i3d-tracker i3d-tr-21"></div>
                <div class="i3d-tracker i3d-tr-22"></div>
                <div class="i3d-tracker i3d-tr-23"></div>
                <div class="i3d-tracker i3d-tr-24"></div>
                <div class="i3d-tracker i3d-tr-25"></div>
                
                <div class="i3d-card">
                    <div class="i3d-card-content">
                        <!-- Imagen de fondo -->
                        <div class="i3d-service-image" style="background-image: url('<?php echo esc_url($image_url); ?>');"></div>
                        
                        <!-- Texto del servicio -->
                        <div class="i3d-service-text">
                            <div class="i3d-service-title"><?php echo esc_html($title); ?></div>
                            <div class="i3d-service-description"><?php echo esc_html($description); ?></div>
                        </div>
                        
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
                    </div>
                </div>
            </div>
        </div>
        <?php echo $wrapper_end; ?>
        <?php
    }

    /**
     * Renderizar contenido en el editor (plantilla JS)
     */
    protected function content_template() {
        ?>
        <#
        var uniqueId = 'i3d-' + view.getID();
        var imageUrl = '';
        
        // Verificar correctamente si existe la imagen
        if ( settings.card_image && settings.card_image.url ) {
            imageUrl = settings.card_image.url;
        } else {
            imageUrl = 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80';
        }
        
        var dynamicStyles = `
            #${uniqueId} .i3d-service-title {
                background: linear-gradient(45deg, ${settings.title_gradient_start}, ${settings.title_gradient_middle}, ${settings.title_gradient_end});
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                filter: drop-shadow(0 0 8px ${settings.glow_color}70);
            }
            #${uniqueId} .i3d-glow-1,
            #${uniqueId} .i3d-glow-2,
            #${uniqueId} .i3d-glow-3 {
                background: radial-gradient(circle at center, ${settings.glow_color}4D 0%, transparent 70%);
            }
            #${uniqueId} .i3d-card-particles span {
                background: ${settings.glow_color};
            }
            #${uniqueId} .i3d-corner-elements span {
                border-color: ${settings.corner_color};
            }
            #${uniqueId} .i3d-card:hover .i3d-corner-elements span {
                border-color: ${settings.corner_hover_color};
                box-shadow: 0 0 10px ${settings.corner_hover_color};
            }
            #${uniqueId} .i3d-cyber-lines span {
                background: linear-gradient(90deg, transparent, ${settings.cyber_lines_color}, transparent);
            }
            #${uniqueId} .i3d-tracker:hover ~ .i3d-card .i3d-service-text::after {
                background: ${settings.overlay_color};
            }
        `;
        
        var effect3dType = settings.effect_3d_type || 'tilt';
        var effect3dIntensity = settings.effect_3d_intensity ? settings.effect_3d_intensity.size : 10;
        var containerClasses = 'i3d-container noselect i3d-effect-' + effect3dType + ' i3d-intensity-' + effect3dIntensity;
        #>
        
        <style>{{{ dynamicStyles }}}</style>
        
        <div id="{{{ uniqueId }}}" class="{{{ containerClasses }}}" data-effect="{{{ effect3dType }}}" data-intensity="{{{ effect3dIntensity }}}">
            <div class="i3d-canvas">
                <# for (var i = 1; i <= 25; i++) { #>
                <div class="i3d-tracker i3d-tr-{{{ i }}}"></div>
                <# } #>
                
                <div class="i3d-card">
                    <div class="i3d-card-content">
                        <div class="i3d-service-image" style="background-image: url('{{{ imageUrl }}}');"></div>
                        
                        <div class="i3d-service-text">
                            <div class="i3d-service-title">{{{ settings.card_title }}}</div>
                            <div class="i3d-service-description">{{{ settings.card_description }}}</div>
                        </div>
                        
                        <div class="i3d-card-glare"></div>
                        
                        <div class="i3d-cyber-lines">
                            <span></span><span></span><span></span><span></span>
                        </div>
                        
                        <div class="i3d-glowing-elements">
                            <div class="i3d-glow-1"></div>
                            <div class="i3d-glow-2"></div>
                            <div class="i3d-glow-3"></div>
                        </div>
                        
                        <# if (settings.enable_particles === 'yes') { #>
                        <div class="i3d-card-particles">
                            <span></span><span></span><span></span>
                            <span></span><span></span><span></span>
                        </div>
                        <# } #>
                        
                        <# if (settings.enable_corner_elements === 'yes') { #>
                        <div class="i3d-corner-elements">
                            <span></span><span></span><span></span><span></span>
                        </div>
                        <# } #>
                        
                        <# if (settings.enable_scan_line === 'yes') { #>
                        <div class="i3d-scan-line"></div>
                        <# } #>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
