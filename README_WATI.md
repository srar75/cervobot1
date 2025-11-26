# Integración de Chatbot Wati para Agencia de Vuelos

Esta aplicación Laravel se integra con Wati para proporcionar un chatbot para una agencia de vuelos.

## Configuración

1.  **Variables de Entorno**:
    Asegúrate de haber configurado lo siguiente en tu archivo `.env`:
    ```
    WATI_API_ENDPOINT=https://live-server-xxxx.wati.io
    WATI_ACCESS_TOKEN=tu_token_de_acceso_aqui
    ```

2.  **Configuración del Webhook**:
    En tu Panel de Control de Wati, ve a **Webhooks** y establece la URL del webhook a:
    `https://tu-dominio.com/api/wati/webhook`
    
    *Nota: Si estás probando localmente, necesitarás usar una herramienta como Ngrok para exponer tu servidor local.*

## Funcionalidades

-   **Mensaje de Bienvenida**: Responde a "Hola" o "Inicio".
-   **Búsqueda de Vuelos**: Responde a "Vuelo [Origen] a [Destino]".
    -   Ejemplo: "Vuelo Madrid a Paris"
-   **Estado del Vuelo**: Responde a "Estado [Número de Vuelo]".
    -   Ejemplo: "Estado IB1234"
-   **Solicitud de Agente**: Responde a "Agente".

## Estructura del Código

-   `App\Services\WatiService`: Maneja las llamadas a la API de Wati (envío de mensajes).
-   `App\Http\Controllers\WatiController`: Maneja los webhooks entrantes y la lógica del chatbot.
-   `App\Services\FlightService`: Servicio simulado (mock) para buscar vuelos y verificar el estado.
-   `routes/api.php`: Define la ruta del webhook.

## Pruebas

Ejecuta las pruebas de características incluidas para verificar la lógica:
```bash
php artisan test tests/Feature/WatiWebhookTest.php
```
