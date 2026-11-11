# LOOP — Communication Skills LMS

LOOP is a gamified learning management system for practicing professional communication. It combines a Laravel API and backend with a React single-page interface.

## Learning experience

Learners can explore communication courses, complete quizzes and written exercises, track progress, and view badges and leaderboard rankings. The platform also includes video-pitch submissions and a peer-review experience.

## Architecture

LOOP uses Laravel for the backend and React for the single-page interface. Laravel serves the application shell, while Vite builds the frontend assets. React pages use Axios to communicate with JSON APIs under `/api/v1`. API controllers handle requests and coordinate application services; Eloquent models and database migrations define the learning, activity, and gamification data. Database seeders provide sample courses, exercises, and learner activity for local development.

## Requirements

- PHP 8.2 or newer, with SQLite support
- Composer
- Node.js 18 or newer and npm

SQLite is the default local database. No separate database server is needed for local development.

## Local setup

From the project directory:

1. Install PHP and JavaScript dependencies:

   ```sh
   composer install
   npm ci
   ```

2. Create your local environment file. On Windows PowerShell:

   ```powershell
   Copy-Item .env.example .env
   ```

   On macOS or Linux:

   ```sh
   cp .env.example .env
   ```

   `.env.example` contains local-development defaults. The real `.env` file is local-only and must not be committed.

3. Generate an application key, create the SQLite database file, and initialize it with the demo data:

   ```sh
   php artisan key:generate
   php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
   php artisan migrate --seed
   ```

4. Build the frontend assets and start the Laravel development server:

   ```sh
   npm run build
   php artisan serve
   ```

   Open the URL printed by `php artisan serve`. For frontend hot reload during development, run `npm run dev` in a second terminal instead of building assets.

The database seeder creates sample learner accounts and learning activity for local development.

## Environment configuration

Keep local and production settings separate:

- **Local development:** Copy `.env.example` to `.env`. It enables debugging and uses SQLite, local logging, and local-friendly services.
- **Production:** Use [`.env.production.example`](./.env.production.example) as a checklist/template for the values your hosting environment needs. Replace every placeholder with real deployment-specific values, and provide them through your hosting platform’s environment/secrets settings or an untracked server-side `.env` file. Laravel does not automatically load `.env.production.example`.

Keep `.env` files, generated application keys, and deployment credentials out of version control. For production, provide deployment-specific values through your hosting environment, set `APP_ENV=production` and `APP_DEBUG=false`, and use an HTTPS `APP_URL`. Apply database migrations with `php artisan migrate --force` and build frontend assets with `npm ci && npm run build`.

## Tests and build

Run the backend test suite and frontend production build with:

```sh
php artisan test
npm run build
```

GitHub Actions runs these checks on pushes and pull requests.

## Project layout

- `app/` — Laravel models, API controllers, and services
- `routes/api.php` — versioned API endpoints
- `routes/web.php` — SPA entry point and frontend route fallback
- `database/migrations/` — database schema
- `database/seeders/` — local/demo learning content and sample activity
- `resources/js/` — React application and learning pages
- `resources/css/` — application styles
- `tests/` — PHPUnit tests
