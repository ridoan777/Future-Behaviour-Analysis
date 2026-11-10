<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withProviders([
        \App\Providers\StripeServiceProvider::class,
    ])
    ->withRouting(
        web: [
            __DIR__ . '/../routes/web.php',
            __DIR__ . '/../routes/Admin/backend.php',
            __DIR__ . '/../routes/Admin/Sidebar/webpages.php',
            __DIR__ . '/../routes/Subscriptions/web.subscriptions.php',
            // __DIR__ . '/../routes/Admin/Sidebar/course_routes.php',
            __DIR__ . '/../routes/Courses/web.courses.php',
            __DIR__ . '/../routes/Students/web.students.php',
            __DIR__ . '/../routes/Progress/web.progress.php',
        ],
        api: [ // custom-code
            __DIR__ . '/../routes/api.php',
            // ---------- custom made routes ----------
            __DIR__ . '/../routes/Frontend/api.auth.php',
            __DIR__ . '/../routes/Profiles/api.profiles.php',
            __DIR__ . '/../routes/Frontend/api.frontend.php',
            __DIR__ . '/../routes/Subscriptions/api.subscriptions.php',
            __DIR__ . '/../routes/Frontend/Webpages/api.webpage.php',
            __DIR__ . '/../routes/Courses/api.courses.php',
            __DIR__ . '/../routes/Students/api.students.php',
            __DIR__ . '/../routes/Progress/api.progress.php',
            __DIR__ . '/../routes/Reviews/api.reviews.php',
            // ---------- custom made routes ----------
        ],
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // custom-code
        $middleware->append(\Illuminate\Http\Middleware\HandleCors::class);
        $middleware->validateCsrfTokens(except: [
            '/api/*',
            '/stripe/*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {

		$exceptions->render(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, \Illuminate\Http\Request $request) {
			$previous = $e->getPrevious();

			if ($previous instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
				return \App\Helpers\ExceptionHandling::handle('performing this action', $previous);
			}
			return \App\Helpers\ExceptionHandling::handle('performing this action', $e);
		});
	})->create();

