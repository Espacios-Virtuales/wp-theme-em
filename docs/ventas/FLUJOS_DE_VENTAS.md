
# 📜 INFORME DE FLUJOS DE VENTA – ESCUELA MÍSTICA
_Espacios Virtuales · Documentación Técnica & Energética_

---

## 🌕 FLUJO 1 — Terapias (WooCommerce + Calendly)

```mermaid
flowchart TD
  A["Landing - shortcode ev-objetos tipo=terapia"] --> B["Modal Terapia"]
  B --> C["CTA - Adquirir ahora - WooCommerce"]
  C --> D["Checkout WooCommerce"]
  D --> E{"Pago aprobado"}
  E -->|Si| F["Correo automatico e instrucciones"]
  F --> G["Calendly - agendar sesion"]
  G --> H["Realizacion de terapia"]
  E -->|No| I["Carrito pendiente"]

```

---

## 🌑 FLUJO 2 — Cursos Presenciales / En Vivo

```mermaid
flowchart TD
  A["Shortcode ev-objetos tipo=course"] --> B["Modal Curso"]
  B --> C["CTA - Inscribirme"]
  C --> D["Checkout WooCommerce"]
  D --> E{"Pago exitoso"}
  E -->|Si| F["Correo bienvenida y Zoom"]
  F --> G["Clases en vivo"]
  E -->|No| H["Carrito pendiente"]
```

---

## 🔥 FLUJO 3 — Cursos Grabados (Hotmart)

```mermaid
flowchart TD
    A[Modal Curso Grabado] --> B[CTA: Ver curso grabado]
    B --> C[Redirección a Hotmart]
    C --> D[Checkout Hotmart]
    D --> E[Acceso automático al curso]
    E --> F[Área de miembros Hotmart]
```

---

## 🌟 FLUJO 4 — Programas (Interno + Externo)

```mermaid
flowchart TD
  A["Shortcode ev-objetos tipo=program"] --> B["Modal Programa"]

  B --> C{"Producto WooCommerce"}
  C -->|Si| D["CTA Inscripcion interna"]
  D --> E["Checkout WooCommerce"]

  B --> F{"Link de pago externo"}
  F -->|Si| G["CTA Pago externo"]
  G --> H["Checkout externo"]
```

---

## 🧿 FLUJO 5 — Experiencias (Eventos Calendario)

```mermaid
flowchart TD
  A["Pagina ev-calendar"] --> B["Calendario dinamico"]
  B --> C["Click en evento - ev-open-modal"]
  C --> D["Modal Experiencia"]
  D --> E{"Producto vinculado"}
  E -->|Si| F["CTA Comprar entradas"]
  F --> G["Checkout WooCommerce"]
  G --> H["Confirmacion"]
  E -->|No| I["Mensaje - Disponible pronto"]
```

---

## 🧬 FLUJO GENERAL DEL ECOSISTEMA

```mermaid
flowchart LR
    subgraph LM[Línea de Marketing]
        A[Landing / Shortcodes] --> B[Modales personalizados]
        B --> C[Selección de flujo]
    end

    subgraph VC[Validación Comercial]
        C --> D[WooCommerce Checkout]
        C --> E[Hotmart Checkout]
    end

    subgraph AS[Automatización]
        D --> F[Correos automáticos]
        D --> G[Calendly]
        E --> H[Entrega automática]
    end

    G --> I[Sesiones / Clases]
    H --> J[Acceso grabado]
```

---

## 🛠️ COMPONENTES TÉCNICOS

- Shortcodes: `ev-objetos`, `ev-calendar`, `ev-about`, etc.
- ACF: `descripcion`, `propuesta_valor`, `objetivo`, `cliente_potencial`, `on`, `date`
- Metaboxes: `_linked_product_id`, `course_payment_url`, `course_modalidad`
- Módulos: `/modules/woocommerce/`, `/modules/emails/`, `/modules/calendario/`
- Estilos: sistema `.ev-modal` con variables de tema

---

## 🔮 RESUMEN

El flujo comercial se integra como un tejido entre:
- presentación → modal → decisión → transacción → experiencia  
con flujos mixtos WooCommerce / Hotmart / Calendly.

Nada está aislado. Cada paso sostiene al siguiente.

---

**Documento generado automáticamente.**
