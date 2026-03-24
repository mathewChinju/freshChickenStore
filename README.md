# Kitchen & Meat Store E-commerce Application

A complete e-commerce application built with Laravel for kitchen items, fresh meat, and vegetables. Allows administrators to manage products and orders, while customers can browse fresh produce and inquire through WhatsApp.

## Features

### Admin Features
- **Product Management**: Full CRUD operations for kitchen items, meat cuts, and fresh vegetables with stock management and categorization
- **Order Management**: View, create, update, and manage customer orders with status tracking
- **Dashboard**: Overview of products, orders, and key metrics
- **Authentication**: Secure admin login system

### Customer Features
- **Product Catalog**: Browse fresh meat, chicken pieces, beef cuts, and vegetables with filtering and pagination
- **Product Details**: View detailed product information including weight, price per unit, and descriptions
- **WhatsApp Integration**: Direct inquiry through WhatsApp for fresh produce orders
- **Contact Form**: Submit product inquiries with contact details and quantity requirements

### Technical Features
- **Responsive Design**: Mobile-friendly interface using Bootstrap 5
- **Image Upload**: Product image management for fresh items
- **Order Status Tracking**: Pending, confirmed, processing, shipped, delivered, cancelled
- **WhatsApp Integration**: Click-to-chat functionality for fresh produce orders
- **Admin Middleware**: Protected admin routes
- **Database Relationships**: Proper Eloquent relationships

## Product Categories

### Chicken Products
- Chicken Leg Pieces
- Chicken Breast (Boneless)
- Chicken Wings
- Chicken Thighs (Boneless)

### Beef Products
- Beef Chuck Roast
- Ground Beef
 

## Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- SQLite (default) or other supported database

### Setup Instructions

1. **Clone and Install Dependencies**
   ```bash
   git clone <repository-url>
   cd online_store
   composer install
   ```

2. **Environment Configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Database Setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

4. **Create Storage Link**
   ```bash
   php artisan storage:link
   ```

5. **Start Development Server**
   ```bash
   php artisan serve
   ```

## Default Admin Account

After running the seeder, you can login with:
- **Email**: admin@store.com
- **Password**: password

## Configuration

### WhatsApp Integration

To configure WhatsApp integration, add your WhatsApp number to the `.env` file:

```env
WHATSAPP_NUMBER=+918867141477
```
918867141477(admin number) has given in controllers & whatsap link for the products
### Database Configuration

The application uses SQLite by default. To use MySQL or PostgreSQL, update your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=online_store
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## Directory Structure

```
app/
├── Http/Controllers/
│   ├── Admin/
│   │   ├── ProductController.php
│   │   └── OrderController.php
│   └── ProductController.php
├── Models/
│   ├── Product.php
│   ├── Order.php
│   └── User.php
└── Http/Middleware/
    └── AdminMiddleware.php

resources/views/
├── admin/
│   ├── dashboard.blade.php
│   ├── products/
│   └── orders/
├── products/
└── partials/
    └── messages.blade.php
```

## Usage

### For Administrators

1. Login to the admin panel at `/admin`
2. Navigate to dashboard for overview
3. Manage products from `/admin/products`
4. Manage orders from `/admin/orders`

### For Customers

1. Visit homepage to browse products
2. Click on products for details
3. Use "Inquire on WhatsApp" button for direct contact
4. Fill out the inquiry form for email communication

## API Endpoints

### Public Routes
- `GET /` - Homepage with products
- `GET /products` - Product listing
- `GET /products/{product}` - Product details
- `POST /products/{product}/inquiry` - Submit inquiry
- `GET /products/{product}/whatsapp` - WhatsApp redirect

### Admin Routes (Protected)
- `GET /admin` - Dashboard
- `GET /admin/products` - Product management
- `GET /admin/orders` - Order management
- All CRUD operations for products and orders

## Technologies Used

- **Backend**: Laravel 12
- **Frontend**: Bootstrap 5, Blade Templates
- **Database**: SQLite (configurable)
- **Authentication**: Laravel UI Auth
- **Image Processing**: Laravel File System

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This project is open-sourced software licensed under the MIT license.


      "
      
      Analyze the entire project and without breaking the design style and the approach of the current state. of the project combaine all the styles written in the each pages together in a  page which can commonly called in the each pages for style. Maintain the current design styles, font styles & the flow of the project

      "