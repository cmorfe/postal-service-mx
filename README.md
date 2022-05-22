# Post Service API

This API retrieves postal information provided a mexican Zip Code:

The first step was to set up development environment:

- Create a new Laravel Project (via composer).
- Share the project on a public repository (on GitHub).
- Set up the deployment (on Heroku).

In order to decrease the response time I´ll try to read the source data from the txt file and treat it as read-only static data.

Is the Zip Code is found, all there is to do is to present it in the corresponding format.

[//]: # (- [Simple, fast routing engine]&#40;https://laravel.com/docs/routing&#41;.)

[//]: # (- [Powerful dependency injection container]&#40;https://laravel.com/docs/container&#41;.)

[//]: # (- Multiple back-ends for [session]&#40;https://laravel.com/docs/session&#41; and [cache]&#40;https://laravel.com/docs/cache&#41; storage.)

[//]: # (- Expressive, intuitive [database ORM]&#40;https://laravel.com/docs/eloquent&#41;.)

[//]: # (- Database agnostic [schema migrations]&#40;https://laravel.com/docs/migrations&#41;.)

[//]: # (- [Robust background job processing]&#40;https://laravel.com/docs/queues&#41;.)

[//]: # (- [Real-time event broadcasting]&#40;https://laravel.com/docs/broadcasting&#41;.)

[//]: # ()
[//]: # (Laravel is accessible, powerful, and provides tools required for large, robust applications.)