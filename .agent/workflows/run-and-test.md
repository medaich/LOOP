---
description: How to run and test the application locally
---

To run the application and test your changes, follow these steps:

### 1. Start the Laravel Server
Open a terminal and run the following command to start the PHP development server:

```bash
php artisan serve
```
By default, this will run at `http://127.0.0.1:8000`.

### 2. Start the Vite Dev Server (React)
Open a **second** terminal window and run:

```bash
npm run dev
```
This is required to compile and serve the React frontend assets.

### 3. Verify the Fixes
Now that both servers are running, you can test the "white page" fixes:
- **Direct Link Test**: Go to [http://localhost:8000/exercise/1](http://localhost:8000/exercise/1) directly. It should load correctly.
- **Alias Test**: Go to [http://localhost:8000/mail](http://localhost:8000/mail). It should take you directly to the Email Pro exercise.
- **Refresh Test**: On any exercise page, press `Cmd + R` (or `F5`) to refresh. The page should reload without showing a blank screen.

### 4. Running Automated Tests (Optional)
If you have PHPUnit tests set up, you can run them with:

```bash
php artisan test
```
