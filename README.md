# Email Queue Package

This PHP package provides a simple email queue management system. It uses a database to store queued email jobs and processes them in batches to prevent overwhelming the mail server.

## Requirements

- PHP 7.4 or higher
- Composer
- MySQL or compatible database

## Installation

1. **Clone the Repository**
    ```sh
    git clone <repository-url>
    cd email-queue
    ```

2. **Install Dependencies**
    ```sh
    composer install
    ```

3. **Configure Database Connection**
    Update the `config.php` file with your database connection details.

    ```php
    use Illuminate\Database\Capsule\Manager as Capsule;

    $capsule = new Capsule;

    $capsule->addConnection([
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'database' => 'email_queue',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    ]);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    ```

4. **Run Migrations**
    ```sh
    php migrations/2023_06_15_000000_create_jobs_table.php
    ```

## Usage

### Adding Emails to the Queue

Use the `send_emails.php` script to add emails to the queue.

```php
require 'vendor/autoload.php';
require 'config.php';

use EmailQueue\SendEmailJob;
use EmailQueue\QueueManager;

$queueManager = new QueueManager();

for ($i = 0; $i < 2000; $i++) {
    $email = [
        'recipients' => ['recipient' . $i . '@example.com'],
        'subject' => 'Subject ' . $i,
        'body' => 'Email body content ' . $i,
        'headers' => ['From: sender@example.com']
    ];
    $job = new SendEmailJob($email);
    $queueManager->addJob($job);
}
```

### Processing the Email Queue

Use the `process_jobs.php` script to process the queued emails.

```php
require 'vendor/autoload.php';
require 'config.php';

use EmailQueue\QueueManager;

$queueManager = new QueueManager();
$queueManager->processJobs();
```

## Files and Directories

- `config.php`: Database configuration file.
- `migrations/2023_06_15_000000_create_jobs_table.php`: Migration script to create the jobs table.
- `process_jobs.php`: Script to process the email queue.
- `send_emails.php`: Script to add emails to the queue.
- `composer.json`: Composer configuration file.
- `src/`: Directory containing the PHP classes for the package.
  - `Job.php`: Abstract job class.
  - `SendEmailJob.php`: Class for email sending jobs.
  - `QueueManager.php`: Class to manage the email queue.

## License

This package is open-source and available under the [MIT License](LICENSE).
