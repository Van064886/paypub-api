<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

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

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


INSERT INTO `services` (`id`, `name`, `description`, `is_transportable`, `start_date`, `end_date`, `total_places`, `address`, `child_price`, `adult_price`, `price_per_hour`, `transportation_price`, `contact`, `opening_hours`, `surface`, `status`, `max_persons`, `total_available_places`, `category_id`, `created_at`, `updated_at`) VALUES ('1', 'Studio de 40m', 'Très beau studio', '0', NULL, NULL, NULL, 'Paris, France, El BF 1245', NULL, NULL, '20', NULL, '+33 65 47 85 12 1', '{\"monday\":{\"open\":\"10:48\" ,\"close\":\"15:15\"}, \"tuesday\":{\"open\":\"08:48\" ,\"close\":\"17:00\"}, \"wednesday\":{\"open\":\"08:00\" ,\"close\":\"17:00\"}, \"thursday\":{\"open\":\"08:48\" ,\"close\":\"17:00\"}, \"friday\":{\"open\":\"09:00\" ,\"close\":\"18:00\"}}', '50', '0', '10', NULL, '1', '2023-10-05 09:28:24', '2023-10-05 09:28:24');


INSERT INTO `services` (`id`, `name`, `description`, `is_transportable`, `start_date`, `end_date`, `total_places`, `address`, `child_price`, `adult_price`, `price_per_hour`, `transportation_price`, `contact`, `opening_hours`, `surface`, `status`, `max_persons`, `total_available_places`, `category_id`, `created_at`, `updated_at`) VALUES ('2', 'Service instruments', 'Service instruments', '1', '2023-10-16 10:20:48', '2023-10-17 10:20:48', NULL, NULL, NULL, NULL, '50', '20', NULL, '{\r\n  \"Monday\": {\r\n    \"open\": \"09:00\",\r\n    \"close\": \"17:00\"\r\n  },\r\n  \"Tuesday\": {\r\n    \"open\": \"10:00\",\r\n    \"close\": \"18:00\"\r\n  },\r\n  \"Wednesday\": {\r\n    \"open\": \"08:30\",\r\n    \"close\": \"16:30\"\r\n  },\r\n  \"Thursday\": {\r\n    \"open\": \"09:30\",\r\n    \"close\": \"17:30\"\r\n  },\r\n  \"Friday\": {\r\n    \"open\": \"09:00\",\r\n    \"close\": \"17:00\"\r\n  }\r\n}\r\n', NULL, '0', NULL, NULL, '2', '2023-10-06 10:20:48', '2023-10-06 10:20:48');

INSERT INTO `services` (`id`, `name`, `description`, `is_transportable`, `start_date`, `end_date`, `total_places`, `address`, `child_price`, `adult_price`, `price_per_hour`, `transportation_price`, `contact`, `opening_hours`, `surface`, `status`, `max_persons`, `total_available_places`, `category_id`, `created_at`, `updated_at`) VALUES ('3', 'Service Event', 'Service Event', '0', '2023-10-08 11:09:13', '2023-10-10 11:09:13', '50', 'Location', '200', '500', NULL, NULL, '529581819', NULL, NULL, '0', NULL, NULL, '3', NULL, NULL);
