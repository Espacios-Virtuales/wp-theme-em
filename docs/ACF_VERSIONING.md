# Versionado de ACF

El tema usa ACF Local JSON para versionar la estructura real de campos del proyecto.

## Ubicación

Los grupos ACF deben guardarse y cargarse desde:

```text
acf-json/
```

La configuración vive en:

```text
inc/acf-json.php
```

## Flujo de trabajo

1. Editar o crear grupos de campos desde WP Admin.
2. ACF guardará archivos JSON automáticamente en `acf-json/`.
3. Confirmar esos archivos en Git junto con el cambio funcional relacionado.
4. En otros ambientes, entrar a WP Admin > ACF > Field Groups y sincronizar los grupos pendientes.

## Nota

Por ahora no se recrean campos manualmente en PHP. La fuente de verdad operativa sigue siendo WP Admin, pero la estructura queda respaldada y versionada en JSON.
