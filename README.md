# ER Diagram

![ER Diagram](https://github.com/fevinta/laravel-asessment/blob/main/storage/er_diagram.svg?raw=true)

# How to run the project

1. Clone the repository.
2. Run `composer install` to install all the dependencies.
3. Run `npm install` to install all the dependencies.
4. Run `npm run dev` to start the server in development mode.
5. Run `cp .env.example .env` to create a copy of the environment file.
6. Run `php artisan key:generate` to generate the application key.
7. Run `php artisan migrate` to migrate the database.
8. Run `php artisan serve` to start the server in development mode.

# How to test the project

1. Install and configure PEST.
2. Run `./vendor/bin/pest` to run all the tests. Alternative you can run `./vendor/bin/pest --coverage` to run all the
   tests and generate a coverage report.

# API Documentation

This document outlines the API endpoints for managing funds, including listing, updating, and identifying duplicates.

## Endpoints

### 1. List Funds

#### Description

Retrieves a paginated list of funds based on specified query parameters.

#### Request

- **Method:** `GET`
- **Path:** `/api/funds`
- **Query String Parameters:**
    - `name` (optional): Filter by the name of the fund.
    - `start_year` (optional): Filter by the start year of the fund.
    - `company` (optional): Filter by the manager company name.
    - `page` (optional): Specify the page number for pagination.

#### Example Request

GET `/api/funds?name=Alpha&start_year=2020&page=2`

#### Example Response

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "name": "Awesome Fund",
            "start_year": 2024,
            "company_id": 325,
            "created_at": "2024-01-13T14:56:41.000000Z",
            "updated_at": "2024-01-13T14:56:57.000000Z",
            "manager_company": {
                "id": 325,
                "name": "Best Fund Manager LLC",
                "created_at": "2024-01-13T14:56:41.000000Z",
                "updated_at": "2024-01-13T14:56:41.000000Z"
            }
        }
    ],
    "first_page_url": "https://.../api/funds?page=1",
    "from": 1,
    "next_page_url": null,
    "path": "https://.../api/funds",
    "per_page": 15,
    "prev_page_url": null,
    "to": 1
}
```

### 2. List Duplicate Funds

#### Description

Retrieves a list of duplicate funds based on the specified fund ID.
If the response is empty, it means that the fund is not a duplicate.

#### Request

- **Method:** `GET`
- **Path:** `/api/funds/{id}/duplicates`

#### Example Request

GET `/api/funds/1/duplicates`

#### Example Response

```json
{
    "data": [
        {
            "id": 50,
            "name": "Best Fund Available",
            "start_year": 2021,
            "company_id": 325,
            "created_at": "2021-01-13T14:56:43.000000Z",
            "updated_at": "2021-01-13T14:56:43.000000Z"
        }
    ]
}
```

### 3. Update Fund

#### Description

Updates the fund based on the specified fund ID.
After updating the fund, it will check if there are any duplicates.

#### Request

- **Method:** `PUT`
- **Path:** `/api/funds/{id}`

#### Example Request

GET `/api/funds/1`

#### Example Request

```json
{
    "name": "Best Fund Available of 2024",
    "start_year": 2024
}
```

#### Example Response

```json
{
    "message": "Fund updated successfully."
}
```

# Mail Notification

After create or update a fund, the application checks for duplicates and sends an email notification to all users with
the list of duplicates.

![Email Sent with the Warning](https://github.com/fevinta/laravel-asessment/blob/main/storage/mail_example.png?raw=true)

# Final Considerations

#### How will your application work as the data set grows increasingly larger?

As the dataset expands, our application ensures sustained performance through optimized indexing, scalable cloud
infrastructure, efficient caching, and asynchronous processing, adeptly managing increased loads while preserving user
experience.

#### How will your application work as the # of concurrent users grows increasingly larger?

Our application maintains high performance with increasing concurrent users by offloading duplicate checks to background
jobs. This approach keeps the user interface responsive and ensures scalability, as these background processes don't
interfere with the main application flow, regardless of user load.
