# 📚 Registro de Shortcodes

Este archivo documenta todos los shortcodes utilizados en el sistema modular de Escuela Mística. Cada shortcode está registrado en su archivo correspondiente y agrupado por página o funcionalidad.

---

## 🏠 Página de Inicio

| Shortcode         | Archivo          | Descripción                                                  |
|-------------------|------------------|--------------------------------------------------------------|
| `[ev-hero]`       | `ev-home.php`    | Hero principal animado con slides e inscripción.            |

---

## 👤 Página Sobre Nosotros / Mí

| Shortcode                    | Archivo           | Descripción                                        |
|------------------------------|-------------------|----------------------------------------------------|
| `[ev-about-me]`              | `ev-about.php`    | Sección personal sobre el autor (tipo "acerca de"). |
| `[ev-sobre_nosotros]`        | `ev-about.php`    | Introducción institucional.                        |
| `[ev-about-hero]`            | `ev-about.php`    | Hero específico para la página de "Sobre Nosotros".|
| `[ev-about-purpose]`         | `ev-about.php`    | Propósito con carousel animado.                    |
| `[ev-about-mission-vision]`  | `ev-about.php`    | Sección de misión y visión con slides.             |
| `[ev-about-values]`          | `ev-about.php`    | Valores con animación por columna.                 |
| `[ev-about-identity]`        | `ev-about.php`    | Identidad con carrusel de arquetipos.              |

---

## 🌱 Comunidad & Membresía

| Shortcode              | Archivo             | Descripción                                         |
|------------------------|---------------------|-----------------------------------------------------|
| `[ev-community_member]`| `ev-community.php`  | Comunidad con enlaces a WhatsApp y Telegram.        |

---

## ✨ Servicios

| Shortcode               | Archivo             | Descripción                                               |
|-------------------------|---------------------|-----------------------------------------------------------|
| `[ev-servicios]`        | `ev-services.php`   | Carousel de servicios principales.                        |
| `[ev-services-hero]`    | `ev-services.php`   | Hero para la landing de servicios.                        |
| `[ev-services-value]`   | `ev-services.php`   | Propuesta de valor destacada.                             |
| `[ev-services-list]`    | `ev-services.php`   | Lista de servicios con íconos y modales de detalle.       |

---

## 💬 Testimonios

| Shortcode            | Archivo               | Descripción                            |
|----------------------|------------------------|----------------------------------------|
| `[ev-testimonios]`   | `ev-testimonios.php`   | Testimonios en formato de carrusel de video. |

---

## 💌 Contacto

| Shortcode          | Archivo            | Descripción                           |
|--------------------|--------------------|---------------------------------------|
| `[ev-contacto]`    | `ev-contact.php`   | Formulario de contacto completo.      |

---

## 🧩 Componentes Compartidos

| Shortcode                  | Archivo             | Descripción                                      |
|----------------------------|---------------------|--------------------------------------------------|
| `[ev-intro_video_modal]`   | `ev-shared.php`     | Modal de video de introducción.                  |
| `[ev-free_resources]`      | `ev-shared.php`     | Recursos gratuitos como podcast, ebook, YouTube. |

---


## 🧩 Landing Modular

| Shortcode                  | Archivo             | Descripción                                      |
|----------------------------|---------------------|--------------------------------------------------|
| `[ev-objetos]`             | `ev-objetos.php`    | cards de productos.                              |


---

## 🧠 Organización técnica

Los shortcodes se registran en:

- /inc/init-shortcodes.php
- Y este archivo se importa desde `functions.php` o `lms-core.php` (según si se usa como tema o plugin).

## Ejemplo:
    
    ```
    require_once get_template_directory() . '/inc/init-shortcodes.php';
    ```


---

## ✅ Convenciones

- Todos los shortcodes tienen el prefijo `ev-`.
- Cada uno está modularizado en `/inc/shortcodes/`.
- Los campos ACF están bien nombrados por grupos: `_group`, `_fields`, etc.
- Están documentados aquí para facilitar mantenimiento y trabajo en equipo.

---

**Actualizado:** 2025-05-25  
**Autor:** Equipo Escuela Mística





