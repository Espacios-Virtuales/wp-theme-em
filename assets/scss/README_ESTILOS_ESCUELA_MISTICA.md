# 🕊️ Escuela Mística — Guía Técnica de Estilos
**Versión:** 1.0.0  
**Proyecto:** Tema WordPress – Espacios Virtuales  
**Stack:** Sass · Bootstrap 5.0.x (compilado) · Tokens EVAAS/EV

---

## 🌸 Propósito
Establecer la identidad visual y técnica de **Escuela Mística** dentro del ecosistema **Espacios Virtuales**, garantizando:
- coherencia estética entre secciones (blog, tienda, cursos, servicios),
- mantenimiento escalable mediante Sass modular,
- compatibilidad progresiva con Bootstrap 5.3+ y nuevas capas de theming.

---

## 📁 Estructura SCSS del Tema
```
assets/scss/
├─ components/
│  ├─ _globals.scss        # Tokens de marca (colores, tipografías, sombras)
│  ├─ layout/_header.scss  # Header y barra de anuncios
│  ├─ layout/_footer.scss  # (futuro) Pie de página
│  ├─ blocks/              # Secciones o widgets (servicios, hero, etc.)
│  └─ _index.scss
├─ utilities/
│  ├─ _responsive.scss     # Mixins propios up/down/between/only
│  ├─ _css-vars.scss       # :root --ev-* / --bs-* post-Bootstrap
│  ├─ _bootstrap-overrides.scss  # Parche para forzar paleta
│  └─ _index.scss
├─ _bs-tools.scss          # Mixins y funciones BS sin CSS global
└─ main.scss               # Orden maestro del build
```

**Orden de compilación (`main.scss`):**
```scss
@import "bootstrap/scss/functions";
@import "components/globals";
@import "bootstrap/scss/bootstrap";
@import "utilities/css-vars";
@import "utilities";
@import "components/index";
@import "utilities/bootstrap-overrides";
```

---

## 🎨 Paleta Identitaria
| Token | Color | Descripción |
|:--|:--|:--|
| `$primary` | `#483D8B` | Violeta místico — tono espiritual y académico |
| `$secondary` | `rgb(75,0,130)` | Índigo profundo — contraste armónico |
| `$gold` | `#FFD700` | Dorado sagrado — símbolo de conciencia y energía |
| `$emerald` | `#50C878` | Verde esmeralda — sanación, equilibrio |
| `$blue-dark` | `#0F0C3E` | Azul noche — fondo y contención |
| `$gray-light` | `#F5F5F5` | Neutro claro — soporte tipográfico |
| `$text-light` | `#F8F9FA` | Texto en fondos oscuros |
| `$text-muted` | `#B3B3B3` | Texto de apoyo o subtítulos |

> **Tipografía:**  
> Base: *Cormorant Garamond*  
> Títulos: *Libre Baskerville*  
> Escala: fluida (clamp) y serif ornamental.

---

## 🧩 Convenciones de Componentes
- Usar `@use "../globals" as g;`
- Referenciar tokens como `g.$primary`, `g.$gold`, `g.$text-light`
- Para responsive: `@use "../../utilities/responsive" as r;`
  ```scss
  @include r.media-breakpoint-down(lg) { ... }
  ```
- Evitar mixins nativos de Bootstrap (`@include media-breakpoint-...`), usar los propios.

---

## 🕯️ Header / Barra de Anuncios
**Ubicación:** `components/layout/_header.scss`  
**Concepto:** manifestar la dualidad luz–sombra a través del contraste `g.$blue-dark` / `g.$gray-light`.

Ejemplo:
```scss
.announcement-bar {
  background-color: g.$blue-dark;
  color: g.$gray-light;
  @include r.media-breakpoint-down(lg) { display: none; }
}

.site-header {
  background-color: g.$primary;
  color: g.$white;
}
```

---

## 🧠 Filosofía de Diseño
> *“Luz, forma y silencio: el diseño como puente entre la materia y la conciencia.”*  
Cada componente debe reflejar:
- **Equilibrio:** proporciones áureas, espaciado Fibonacci.
- **Serenidad:** animaciones suaves, sin brusquedad.
- **Claridad:** contrastes accesibles, jerarquía visual.

---

## 🔮 Mantenimiento y Evolución
- **Tokens:** versionados por SemVer (`minor` si agrega, `major` si rompe).
- **Migración 5.3+:** lista; basta cambiar `@import "bootstrap"` por  
  `@use "bootstrap/scss/bootstrap" with (...)`.
- **Futuras integraciones:** Oria / Liora podrán consumir estos tokens vía API CSS Vars (`--ev-*`).

---

## 📜 Créditos
- **Diseño:** Espacios Virtuales  
- **Dirección Creativa:** David Utreras  
- **Framework técnico:** EVAAS UI / Bootstrap  
- **Repositorio:** `wp-theme-escuela-mistica`
