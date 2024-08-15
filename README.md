# Installation

1. Clone the repository. Change directory to the cloned repository.
2. Run `composer install`.
3. Run `cp .env.example .env`
4. Run `php artisan migrate:fresh --seed`
5. Run `php artisan serve`

Make sure this this project using port `8000`.