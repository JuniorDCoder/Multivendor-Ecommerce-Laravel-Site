## Multivendor E-commerce Site

This Multivendor E-commerce Site us a wev application developed with HTML CSS Bootstrap JavaScript and PHP Laravel to help shop and business owners carry their businesses online. It gives a wide range of functionalities for the administrator and his different vendors. indeed the system is massive

## Getting Started

These instructions will guide you on how to clone the repository, set up the project, and start using it.

### Prerequisites

Make sure you have the following software installed on your machine:

- Node.js and npm (Node Package Manager)
- PHP
- Composer
- MySQL or any other compatible database

### Clone the Repository

Clone this repository to your local machine using the following command:

```
git clone https://github.com/JuniorDCoder/Multivendor-Ecommerce-Laravel-Site.git
```

### Installation

1. Navigate to the project directory:

```
cd Multivendor-Ecommerce-Laravel-Site
```

2. Install PHP dependencies:

```
composer install
```

3. Install JavaScript dependencies:

```
npm install
```

4. Create a copy of the `.env.example` file and rename it to `.env`. Update the file with your database credentials and other necessary configurations:

```
cp .env.example .env
```

5. Generate an application key:

```
php artisan key:generate
```

6. Migrate the database:

```
php artisan migrate
```

### Usage

To start the development server, run the following command:

```
php artisan serve
```

Then run node packages:

```
npm run dev
```

You can now access the application by visiting `http://localhost:8000` in your browser.

## Contributing

If you'd like to contribute to this project, please follow these steps:

1. Fork the repository
2. Create a new branch for your feature or bug fix
3. Make your changes and commit them with descriptive messages
4. Push your changes to your forked repository
5. Submit a pull request to the main repository
