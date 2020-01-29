#Pasos para agregar laravel tenancy a sus proyectos

##1. requisitos
    laravel version 5.8 o superior
    usuario con todos los permisos 
    todos los requisitos minimos de laravel par esta version
    
##2. instalacion 
    asegúrese de configurar este usuario como su system conexión en su database.php. Bajo connections:
```
'system' => [
    'driver' => 'mysql',
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '3306'),
    'database' => env('DB_DATABASE', 'tenancy'),
    'username' => env('DB_USERNAME', 'tenancy'),
    'password' => env('DB_PASSWORD', ''),
    'unix_socket' => env('DB_SOCKET', ''),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'strict' => true,
    'engine' => null,
]
```
    instala el paquete
````
composer require hyn/multi-tenant
````
        Crea un midelware para que cada inquilino acceda a su base de datos

````php
php artisan make:middleware EnforceTenancy

Middleware created successfully.
````

````php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;

class EnforceTenancy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Config::set('database.default', 'tenant');
        
        return $next($request);
    }
}
````

    agrega el middleware en el kernel.php
        ejemplo:
````php
 /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'tenancy.enforce' => \App\Http\Middleware\EnforceTenancy::class,
    ];
````

##3. Cofiguración
### Migraciones
    crea una carpeta llamada tenant en la migrations y
    mueve todas las migraciones a esa carpeta exepto las de el paquete tenant
    todas  las migracios del systema pueden estar en la raiz
    tambien puede duplicar las migraciones de usuario a de tenant a la raiz

###Modelos

    Todos los modelos debe tener un trait para saber si pertenecen al sistema
    o al inquilino
    
``Hyn\Tenancy\Traits\UsesSystemConnection`` Sistema
``Hyn\Tenancy\Traits\UsesTenantConnection`` Inquilino

###Servidor
    el servidor debe ser un vps con LAMP 
    y los requisitos minimos para montar un proyecto laravel
    cuando el servidor este listo para un proyeto de laravel normal con dominio
    y todo funcionando
    
    ve a este directorio /etc/sudoers.d
    y pega esta linea en el archivo q se encuentra alli
    
    www-data ALL = (root) NOPASSWD: /etc/init.d/apache2 reload
    
    esa linea permite que el usuario www-data pueda recargar el apache
    


##4. Ejemplos

###Rutas

    El archivo de rutas  web.php tiene un grupo con la funcion domain
    y tiene como parametro el dominio el cual se debe redirijir para ir al 
    sitio de administracion ejemplo
    Route::domain("example.com")
    
### Ejemplo de creacion de inquilino
    en el archivo controllers/System/Register se encuentra las funciones
    necesarias para crear un inquilino a partir de un formulario