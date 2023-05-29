# Proyecto Ejemplo 15/05/23
Proyecto realizado en en clase de DWES del ciclo superior de DAW en el [IES Al-Andalus (Almería)](https://www.iesalandalus.org)

Este proyecto realizado con Laravel 10 cuenta con los siguientes paquetes:
- [Larave10/JetStream](https://packagist.org/?query=laravel%20jetstream)
- [Protonemedia/laravel-form-components ](https://packagist.org/packages/protonemedia/laravel-form-components)
- [Laravel/Socialite](https://packagist.org/packages/laravel/socialite)

## El proyecto implementa entre otras cosas:
- LiveWire para Crud de la tabla Posts.
- Controlador **normal** para la tabla Categories.
- Middleware **is_admin** para trabajar con perfil de usaurio normaly administrador.
- Policies para controlar que solo el usuario propietario de un post pueda editar/borrar/ver detalle del post.
- Formulario para enviar un correo de soporte para usuario autenticados y no. 
- Login con redes socialites (GitHub) en este ejemplo.

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

El proyecto es libre para su uso didáctico respetando las licencias de Laravel y sus respectivos paquetes.