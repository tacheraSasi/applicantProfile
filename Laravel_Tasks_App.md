
# Laravel Tasks App with Authentication, Middlewares, and CRUD

## Step 1: Setting Up Laravel Project

To get started with the tasks app, install a fresh Laravel project:

```bash
composer create-project laravel/laravel tasks-app
cd tasks-app
```

### SQLite Configuration

Open the `.env` file and set the database connection to SQLite:
```plaintext
DB_CONNECTION=sqlite
```

Create the SQLite database file:
```bash
touch database/database.sqlite
```

### Install Laravel Breeze for Authentication

Laravel Breeze is a minimal and simple way to set up authentication:

```bash
composer require laravel/breeze --dev
php artisan breeze:install
npm install && npm run dev
php artisan migrate
```

## Step 2: Creating Task Model, Migration, and Controller

Create the `Task` model, migration, and controller with one command:

```bash
php artisan make:model Task -mcr
```

This creates:
- `Task` model in `app/Models`
- Migration file in `database/migrations/`
- `TaskController` in `app/Http/Controllers/`

### Define Migration

Update the migration file to set up the `tasks` table:

```php
public function up()
{
    Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description')->nullable();
        $table->boolean('completed')->default(false);
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}
```

Migrate the database:

```bash
php artisan migrate
```

## Step 3: Routes, Middleware, and Protected Routes

Protect all task routes with authentication middleware:

```php
use App\Http\Controllers\TaskController;

Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);
});
```

This ensures only authenticated users can access task-related routes.

## Step 4: Implementing CRUD in TaskController

In `TaskController.php`, use Eloquent to implement task CRUD operations:

```php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->tasks;
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Auth::user()->tasks()->create($validated);

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();

        return redirect()->route('tasks.index');
    }
}
```

## Step 5: Authorization Policy for Task

Create a policy for task authorization:

```bash
php artisan make:policy TaskPolicy --model=Task
```

In `TaskPolicy.php`, define the rules:

```php
public function update(User $user, Task $task)
{
    return $user->id === $task->user_id;
}

public function delete(User $user, Task $task)
{
    return $user->id === $task->user_id;
}
```

Register the policy in `AuthServiceProvider.php`:

```php
protected $policies = [
    Task::class => TaskPolicy::class,
];
```

## Step 6: Views and Forms

### Tasks Index View (`resources/views/tasks/index.blade.php`)

Displays all tasks:

```blade
@extends('layouts.app')

@section('content')
    <h1>Your Tasks</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create Task</a>
    <ul>
        @foreach($tasks as $task)
            <li>
                <h3>{{ $task->title }}</h3>
                <p>{{ $task->description }}</p>
                <p>{{ $task->completed ? 'Completed' : 'Pending' }}</p>
                <a href="{{ route('tasks.edit', $task->id) }}">Edit</a>
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
```

### Task Create and Edit View (`resources/views/tasks/create.blade.php`)

Form for creating or editing tasks:

```blade
@extends('layouts.app')

@section('content')
    <form action="{{ isset($task) ? route('tasks.update', $task->id) : route('tasks.store') }}" method="POST">
        @csrf
        @isset($task)
            @method('PUT')
        @endisset
        <div>
            <label>Title</label>
            <input type="text" name="title" value="{{ $task->title ?? '' }}" required>
        </div>
        <div>
            <label>Description</label>
            <textarea name="description">{{ $task->description ?? '' }}</textarea>
        </div>
        <button type="submit">{{ isset($task) ? 'Update Task' : 'Create Task' }}</button>
    </form>
@endsection
```

### Layout (`resources/views/layouts/app.blade.php`)

The base layout for the application:

```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('tasks.index') }}">Tasks</a>
            <a href="{{ route('logout') }}">Logout</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>
```

## Step 7: Running the App

Start the Laravel development server:

```bash
php artisan serve
```

You can now visit the app at `http://127.0.0.1:8000`.

## Conclusion

This guide covered creating a Laravel tasks app with authentication, task CRUD operations using Eloquent, route protection with middlewares, and SQLite as the database. You can further expand this project by adding more features like task completion, user notifications, etc.
