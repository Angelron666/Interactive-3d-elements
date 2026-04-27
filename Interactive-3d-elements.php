<?php
/**
 * Plugin Name: Interactive 3D Elements
 * Description: Módulo de Elementor con tarjetas 3D interactivas estilo cyberpunk
 * Version: 1.3.0
 * Author: 666correa
 * Text Domain: interactive-3d-elements
 * Requires Plugins: elementor
 * 
 * Changelog:
 * 1.3.0 - Agregado widget Hotspot con animación de pulso
 * 1.2.0 - Agregado widget Hover Reveal Menu con controles flexbox completos
 * 1.1.0 - Agregado widget Gradient Title
 * 1.0.0 - Versión inicial
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

define('INTERACTIVE_3D_ELEMENTS_VERSION', '1.3.0');
define('INTERACTIVE_3D_ELEMENTS_PATH', plugin_dir_path(__FILE__));
define('INTERACTIVE_3D_ELEMENTS_URL', plugin_dir_url(__FILE__));

/**
 * Clase principal del plugin
 */
final class Interactive_3D_Elements {

    /**
     * Versión mínima de Elementor requerida
     */
    const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

    /**
     * Versión mínima de PHP requerida
     */
    const MINIMUM_PHP_VERSION = '7.4';

    /**
     * Instancia única
     */
    private static $_instance = null;

    /**
     * Obtener instancia singleton
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     */
    public function __construct() {
        add_action('plugins_loaded', [$this, 'on_plugins_loaded']);
    }

    /**
     * Cargar plugin después de que todos los plugins estén cargados
     */
    public function on_plugins_loaded() {
        if ($this->is_compatible()) {
            add_action('elementor/init', [$this, 'init']);
        }
    }

    /**
     * Verificar compatibilidad
     */
    public function is_compatible() {
        // Verificar si Elementor está instalado y activado
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_elementor']);
            return false;
        }

        // Verificar versión mínima de Elementor
        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return false;
        }

        // Verificar versión mínima de PHP
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return false;
        }

        return true;
    }

    /**
     * Inicializar plugin
     */
    public function init() {
        // Cargar archivos de includes
        $this->load_includes();
        
        // Registrar widgets
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
        
        // Registrar estilos en el frontend
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'enqueue_frontend_styles']);
        
        // Registrar estilos en el editor
        add_action('elementor/editor/after_enqueue_styles', [$this, 'enqueue_editor_styles']);

        // Registrar categoría personalizada
        add_action('elementor/elements/categories_registered', [$this, 'add_elementor_widget_categories']);
    }

    /**
     * Cargar archivos de includes
     * 
     * Carga automáticamente todos los archivos PHP de la carpeta includes/
     */
    private function load_includes() {
        $includes_path = INTERACTIVE_3D_ELEMENTS_PATH . 'includes/';
        
        if (!is_dir($includes_path)) {
            return;
        }

        $include_files = glob($includes_path . '*.php');
        
        foreach ($include_files as $file) {
            require_once $file;
        }
    }

    /**
     * Añadir categoría de widgets personalizada
     */
    public function add_elementor_widget_categories($elements_manager) {
        $elements_manager->add_category(
            'interactive-3d',
            [
                'title' => esc_html__('Interactive 3D Elements', 'interactive-3d-elements'),
                'icon' => 'fa fa-cube',
            ]
        );
    }

    /**
     * Registrar widgets
     * 
     * Carga automáticamente todos los widgets de la carpeta widgets/
     * Para agregar un nuevo widget:
     * 1. Crear un archivo PHP en la carpeta widgets/ (ej: mi-widget.php)
     * 2. El archivo debe contener una clase que extienda \Elementor\Widget_Base
     * 3. El nombre de la clase debe seguir el patrón: Mi_Widget (PascalCase del nombre del archivo)
     */
    public function register_widgets($widgets_manager) {
        $widgets_path = INTERACTIVE_3D_ELEMENTS_PATH . 'widgets/';
        
        // Verificar si existe la carpeta de widgets
        if (!is_dir($widgets_path)) {
            return;
        }

        // Obtener todos los archivos PHP de la carpeta widgets
        $widget_files = glob($widgets_path . '*.php');

        foreach ($widget_files as $widget_file) {
            // Incluir el archivo del widget
            require_once $widget_file;

            // Obtener el nombre del archivo sin extensión
            $file_name = basename($widget_file, '.php');

            // Convertir el nombre del archivo a nombre de clase
            // Ejemplo: interactive-3d-card-widget -> Interactive_3D_Card_Widget
            $class_name = str_replace('-', '_', $file_name);
            $class_name = ucwords($class_name, '_');
            $class_name = str_replace('_', '_', $class_name);
            
            // Verificar si la clase existe y registrarla
            if (class_exists($class_name)) {
                $widgets_manager->register(new $class_name());
            }
        }
    }

    /**
     * Obtener lista de archivos CSS del plugin
     */
    private function get_css_files() {
        $css_path = INTERACTIVE_3D_ELEMENTS_PATH . 'assets/css/';
        $css_files = [];
        
        if (is_dir($css_path)) {
            $files = glob($css_path . '*.css');
            foreach ($files as $file) {
                $file_name = basename($file, '.css');
                $css_files[$file_name] = INTERACTIVE_3D_ELEMENTS_URL . 'assets/css/' . basename($file);
            }
        }
        
        return $css_files;
    }

    /**
     * Encolar estilos en el frontend
     * 
     * Carga automáticamente todos los CSS de assets/css/
     */
    public function enqueue_frontend_styles() {
        $css_files = $this->get_css_files();
        
        foreach ($css_files as $handle => $url) {
            wp_enqueue_style(
                'i3d-' . $handle,
                $url,
                [],
                INTERACTIVE_3D_ELEMENTS_VERSION
            );
        }
    }

    /**
     * Encolar estilos en el editor
     * 
     * Carga automáticamente todos los CSS de assets/css/
     */
    public function enqueue_editor_styles() {
        $css_files = $this->get_css_files();
        
        foreach ($css_files as $handle => $url) {
            wp_enqueue_style(
                'i3d-editor-' . $handle,
                $url,
                [],
                INTERACTIVE_3D_ELEMENTS_VERSION
            );
        }
    }

    /**
     * Aviso: Elementor no está instalado
     */
    public function admin_notice_missing_elementor() {
        $message = sprintf(
            esc_html__('"%1$s" requiere "%2$s" para funcionar.', 'interactive-3d-elements'),
            '<strong>' . esc_html__('Interactive 3D Elements', 'interactive-3d-elements') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'interactive-3d-elements') . '</strong>'
        );
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Aviso: Versión mínima de Elementor
     */
    public function admin_notice_minimum_elementor_version() {
        $message = sprintf(
            esc_html__('"%1$s" requiere "%2$s" versión %3$s o superior.', 'interactive-3d-elements'),
            '<strong>' . esc_html__('Interactive 3D Elements', 'interactive-3d-elements') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'interactive-3d-elements') . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Aviso: Versión mínima de PHP
     */
    public function admin_notice_minimum_php_version() {
        $message = sprintf(
            esc_html__('"%1$s" requiere PHP versión %2$s o superior.', 'interactive-3d-elements'),
            '<strong>' . esc_html__('Interactive 3D Elements', 'interactive-3d-elements') . '</strong>',
            self::MINIMUM_PHP_VERSION
        );
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }
}

// Inicializar el plugin
Interactive_3D_Elements::instance();
