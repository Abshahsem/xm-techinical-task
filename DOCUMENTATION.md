# Twitter Crawler Project

This Laravel application crawls tweets from various accounts, saves them in a database, and generates a report on the
most popular financial instruments mentioned.

## Installation

1. Run `composer install` to install dependencies.
1. Run `php artisan migrate` to run migration.
1. Run `php artisan db:seed` to insert data.
1. Run `composer install` to install dependencies.
2. Run `php artisan serve` to start the server.

## Usage

### Commands

The crawling command is scheduled to run every minute. To manually trigger the crawling process, use the following
command:

```bash
php artisan schedule:twitter-crawling
```

### Queuing

After the crawling command has run successfully, it will fill the built-in queue. To process the queue, use the
following command:

```bash
php artisan queue:work
```

### Fo Set Up:

please add these to php.ini file:

extension=php_sockets.dll

2. Add the following lines to your php.ini file:
   ```ini
   extension=fileinfo
   curl.cainfo = "C:\Program Files\cacert-2024-03-11.pem"
   ```

### Fo Docker Set Up:

run the following command:

  ```bash
./vendor/bin/sail up
```

## Design Documentation

1. **Fetching Predefined Handles:**
    - Run `php artisan fetch:handles` to fetch all predefined handles from the database.

2. **Crawling Tweets:**
    - Tweets are fetched using jobs and queues. Run `php artisan queue:work` to start processing queued jobs.

3. **Extracting Instruments:**
    - Instruments mentioned in tweets are extracted and saved in the database.

4. **REST APIs for Reports:**
    - Three REST APIs are available:
        - Daily report: `/api/reports/daily`
        - Weekly report: `/api/reports/weekly`
        - Monthly report: `/api/reports/monthly`

5. **Caching with Redis:**
    - Redis is used for caching data to improve performance.

## Example Usage

1. Fetch handles: `php artisan fetch:handles`
2. Start queue worker: `php artisan queue:work`
3. Access daily report: `GET /api/reports/daily`

## Technologies Used

- Laravel 11
- Redis
- PHP 8.2

