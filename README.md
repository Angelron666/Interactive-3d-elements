# Interactive 3D Elements - Plugin para Elementor

**Versión:** 1.3.0  
**Autor:** 666correa  
**Requiere:** WordPress 5.0+, Elementor 3.0.0+, PHP 7.4+

Plugin de WordPress/Elementor que proporciona widgets modernos con efectos interactivos avanzados.

## 🎨 Widgets Incluidos

### 1. Hotspot (v1.3.0)
Widget para indicadores animados con efecto de pulso. Ideal para llamadas de atención.

**Características:**
- Animación de pulso expandible
- Texto personalizable
- Color y tamaño configurables
- Duración y escala de animación ajustables
- Totalmente responsive

### 2. Hover Reveal Menu (v1.2.0)
Widget versátil con efecto de imagen flotante al hacer hover. Perfecto para menús, portafolios, listas de servicios.

**Características:**
- Imagen flotante que sigue el cursor
- Control completo de Flexbox (direction, wrap, gap, justify, align)
- Alineación horizontal y vertical
- Z-index configurable (imagen delante/detrás)
- Separadores opcionales
- Totalmente responsive

### 3. Gradient Title (v1.1.0)
Títulos con efectos de degradado personalizables por palabra.

### 4. Interactive 3D Card (v1.0.0)
Tarjetas con efectos 3D y estilos cyberpunk.

---

```
Interactive-3d-elements/
├── Interactive-3d-elements.php    # Archivo principal del plugin
├── README.md                      # Este archivo
├── includes/
│   └── class-i3d-widget-base.php  # Clase base para widgets
├── widgets/
│   └── interactive-3d-card-widget.php  # Widget de tarjeta 3D
└── assets/
    └── css/
        └── interactive-3d-card.css     # Estilos del widget
```

## Cómo Agregar un Nuevo Widget

### Paso 1: Crear el archivo del widget

Crea un nuevo archivo PHP en la carpeta `widgets/`. El nombre del archivo debe seguir el formato:
`nombre-del-widget.php` (kebab-case con guiones)

Ejemplo: `boton-3d-widget.php`

### Paso 2: Crear la clase del widget

El nombre de la clase debe coincidir con el nombre del archivo, pero en PascalCase con guiones bajos:
- `boton-3d-widget.php` → `Boton_3d_Widget`
- `mi-super-widget.php` → `Mi_Super_Widget`

### Paso 3: Estructura básica del widget

```php
<?php
/**
 * Widget: Mi Nuevo Widget
 * Descripción del widget
 */

if (!defined('ABSPATH')) {
    exit;
}

// Opcional: incluir la clase base para usar funcionalidades comunes
require_once INTERACTIVE_3D_ELEMENTS_PATH . 'includes/class-i3d-widget-base.php';

class Mi_Nuevo_Widget extends \Elementor\Widget_Base {
    // O extender I3D_Widget_Base para heredar funcionalidades comunes
    // class Mi_Nuevo_Widget extends I3D_Widget_Base {

    public function get_name() {
        return 'mi-nuevo-widget';
    }

    public function get_title() {
        return esc_html__('Mi Nuevo Widget', 'interactive-3d-elements');
    }

    public function get_icon() {
        return 'eicon-animation';  // Icono de Elementor
    }

    public function get_categories() {
        return ['interactive-3d'];  // Categoría del plugin
    }

    public function get_keywords() {
        return ['3d', 'widget', 'animación'];
    }

    protected function register_controls() {
        // Agregar secciones y controles aquí
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Contenido', 'interactive-3d-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Agregar controles...

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        // Renderizar el widget
        ?>
        <div class="mi-widget">
            <!-- Contenido del widget -->
        </div>
        <?php
    }
}
```

### Paso 4: Crear estilos CSS (opcional)

Si tu widget necesita estilos adicionales, crea un archivo CSS en `assets/css/`:
- Ejemplo: `assets/css/mi-nuevo-widget.css`

El plugin cargará automáticamente todos los archivos CSS de esta carpeta.

## Usando la Clase Base

Si extiendes `I3D_Widget_Base`, tienes acceso a funcionalidades comunes:

```php
require_once INTERACTIVE_3D_ELEMENTS_PATH . 'includes/class-i3d-widget-base.php';

class Mi_Widget extends I3D_Widget_Base {

    protected function register_controls() {
        // Tus controles personalizados...
        
        // Agregar controles de efectos 3D predefinidos
        $this->register_3d_effect_controls();
        
        // Agregar controles de efectos cyberpunk predefinidos
        $this->register_cyberpunk_effect_controls();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        // Obtener clases del contenedor con efectos 3D
        $container_classes = $this->get_container_classes($settings);
        ?>
        <div class="<?php echo esc_attr($container_classes); ?>">
            <div class="i3d-canvas">
                <?php 
                // Renderizar trackers para efecto 3D
                $this->render_trackers(); 
                ?>
                
                <div class="i3d-card">
                    <!-- Tu contenido aquí -->
                    
                    <?php 
                    // Renderizar efectos cyberpunk
                    $this->render_cyberpunk_effects($settings); 
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
}
```

## Métodos Disponibles en I3D_Widget_Base

| Método | Descripción |
|--------|-------------|
| `register_3d_effect_controls()` | Agrega controles para tipo de efecto 3D e intensidad |
| `register_cyberpunk_effect_controls()` | Agrega controles para partículas, líneas, etc. |
| `get_container_classes($settings)` | Devuelve las clases CSS según los ajustes |
| `render_trackers()` | Renderiza los 25 trackers para el efecto 3D |
| `render_cyberpunk_effects($settings)` | Renderiza todos los efectos cyberpunk |
| `get_unique_id()` | Devuelve un ID único para el widget |

## Efectos 3D Disponibles

- `none` - Sin efecto
- `tilt` - Inclinación 3D (sigue el mouse)
- `float` - Flotar hacia arriba
- `zoom` - Aumentar tamaño
- `flip-x` - Voltear horizontalmente
- `flip-y` - Voltear verticalmente
- `swing` - Balanceo como péndulo
- `pulse` - Pulso/latido

## Iconos de Elementor Disponibles

Algunos iconos útiles para widgets:
- `eicon-flip-box` - Caja volteadora
- `eicon-animation` - Animación
- `eicon-image-box` - Caja de imagen
- `eicon-button` - Botón
- `eicon-gallery-grid` - Galería
- `eicon-posts-grid` - Grid de posts
- `eicon-carousel` - Carrusel

## 📋 Historial de Versiones

El plugin sigue [Semantic Versioning](https://semver.org/spec/v2.0.0.html):
- **MAJOR** (X.0.0) - Cambios incompatibles con versiones anteriores
- **MINOR** (0.X.0) - Nuevas funcionalidades compatibles
- **PATCH** (0.0.X) - Correcciones de errores

**Versión actual:** 1.3.0

Para ver el historial completo de cambios, consulta [CHANGELOG.md](CHANGELOG.md)

### Últimas actualizaciones:
- **v1.3.0** - Agregado widget Hotspot con animación de pulso
- **v1.2.0** - Agregado widget Hover Reveal Menu con controles Flexbox completos
- **v1.1.0** - Agregado widget Gradient Title
- **v1.0.0** - Versión inicial

## Licencia

Este plugin es de código abierto.

## Autor

666correa
