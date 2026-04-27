# Changelog - Interactive 3D Elements

Todos los cambios notables en este proyecto serán documentados en este archivo.

El formato está basado en [Keep a Changelog](https://keepachangelog.com/es-ES/1.0.0/),
y este proyecto adhiere a [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.3.0] - 2026-02-06

### Agregado
- **Widget Hotspot**: Nuevo widget para indicadores animados con efecto de pulso
  - Texto personalizable
  - Color del pulso configurable
  - Tamaño del punto ajustable (px, rem)
  - Duración de animación personalizable
  - Escala del efecto de pulso configurable
  - Espaciado entre punto y texto ajustable
  - Controles de tipografía completos
  - Alineación horizontal (izquierda, centro, derecha)
  - Animación de anillo expandiéndose con efecto cubic-bezier
  - Completamente responsive

### Características del Widget Hotspot
- Efecto de pulso animado que se expande
- Ideal para llamadas de atención (ej: "Atención 24 Horas")
- CSS con keyframes dinámicos por instancia
- Personalización total de colores y tiempos

## [1.2.0] - 2026-02-05

### Agregado
- **Widget Hover Reveal Menu**: Nuevo widget interactivo con efecto de imagen flotante al hacer hover
  - Control completo de Flexbox (direction, wrap, gap, justify-content, align-items)
  - Alineación horizontal y vertical del contenedor
  - Tamaños de imagen configurables con múltiples unidades (px, %, vw, vh)
  - Radio del borde de imagen personalizable
  - Control de z-index: imagen delante o detrás del texto
  - Separadores opcionales (activables/desactivables)
  - Efectos de texto: color de borde, color de relleno al hover, desplazamiento
  - Control de opacidad de elementos inactivos
  - Transiciones configurables
  - Escala inicial de imagen ajustable
  - Repetidor para agregar múltiples elementos con texto, enlace e imagen
  - Completamente responsive con controles independientes por dispositivo

### Características del Widget Hover Reveal Menu
- Efecto de texto outline que se rellena en hover
- Imagen flotante que sigue el cursor
- Soporte para múltiples layouts: vertical, horizontal, grid
- Controles de tipografía completos
- Background personalizable
- CSS optimizado y modular

## [1.1.0] - 2026-02-06

### Agregado
- **Widget Gradient Title**: Widget para títulos con texto en degradado
  - Repeater para múltiples partes del título
  - Soporte para degradados o colores sólidos por palabra
  - Control de ángulo del degradado
  - Saltos de línea configurables
  - Efectos de sombra y resplandor opcionales
  - Controles completos de tipografía

## [1.0.0] - Fecha inicial

### Agregado
- Estructura base del plugin
- Integración con Elementor
- Sistema de auto-registro de widgets
- Categoría personalizada "Interactive 3D Elements"
- Sistema de carga automática de estilos CSS
- Compatibilidad con Elementor 3.0.0+
- Compatibilidad con PHP 7.4+

---

## Tipos de cambios
- **Agregado**: Para funcionalidades nuevas
- **Cambiado**: Para cambios en funcionalidades existentes
- **Obsoleto**: Para funcionalidades que pronto se eliminarán
- **Eliminado**: Para funcionalidades eliminadas
- **Corregido**: Para corrección de errores
- **Seguridad**: En caso de vulnerabilidades
