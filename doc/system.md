Got it. Here's your **clean and minimal** `system.md` prompt for a Laravel project with **simple authentication**, **separate Designer and Buyer tables**, **design upload**, and a **dummy payment gateway**.

---

# system.md – Fashion Platform (Simplified Laravel Setup)

## System Name

**Fashion Platform**

## Roles

* **Designer**

  * Registers/logs in
  * Uploads fashion designs with name, image, price, and description

* **Buyer**

  * Registers/logs in
  * Views available designs
  * Proceeds to a dummy payment page to "buy"

---

## Tables

### designers

```plaintext
id
name
email
password
created_at
updated_at
```

### buyers

```plaintext
id
name
email
password
created_at
updated_at
```

### designs

```plaintext
id
designer_id (foreign key to designers.id)
title
description
price
image_path
created_at
updated_at
```

### orders

```plaintext
id
buyer_id (foreign key to buyers.id)
design_id (foreign key to designs.id)
status (pending, paid)
created_at
updated_at
```

---

## Features

### Authentication

* Separate login and registration for **Designers** and **Buyers**
* Simple session-based auth (no roles, use guards or middleware)

### Designer Flow

1. Registers via `/designer/register`
2. Logs in at `/designer/login`
3. Dashboard at `/designer/dashboard`
4. Adds designs with form: title, description, image, price
5. Views list of own designs

### Buyer Flow

1. Registers via `/buyer/register`
2. Logs in at `/buyer/login`
3. Dashboard at `/buyer/dashboard`
4. Sees all available designs
5. Clicks "Buy" → goes to dummy payment page
6. Confirms fake payment → redirects to thank you

### Dummy Payment Page

* Static page at `/payment/{order_id}`
* Button: "Pay Now"
* On click: sets order status to `paid` and redirects to `/buyer/thank-you`

---

## Routes (web.php)

```php
// Designer Auth
Route::get('/designer/register', [DesignerAuthController::class, 'showRegister']);
Route::post('/designer/register', [DesignerAuthController::class, 'register']);
Route::get('/designer/login', [DesignerAuthController::class, 'showLogin']);
Route::post('/designer/login', [DesignerAuthController::class, 'login']);
Route::get('/designer/dashboard', [DesignerDashboardController::class, 'index']);
Route::post('/designer/designs', [DesignController::class, 'store']);

// Buyer Auth
Route::get('/buyer/register', [BuyerAuthController::class, 'showRegister']);
Route::post('/buyer/register', [BuyerAuthController::class, 'register']);
Route::get('/buyer/login', [BuyerAuthController::class, 'showLogin']);
Route::post('/buyer/login', [BuyerAuthController::class, 'login']);
Route::get('/buyer/dashboard', [BuyerDashboardController::class, 'index']);
Route::get('/buyer/buy/{design_id}', [OrderController::class, 'create']);
Route::get('/payment/{order_id}', [PaymentController::class, 'show']);
Route::post('/payment/{order_id}', [PaymentController::class, 'process']);
Route::get('/buyer/thank-you', function () {
    return view('thank_you');
});
```

---

## Controllers Needed

* `DesignerAuthController`
* `BuyerAuthController`
* `DesignerDashboardController`
* `BuyerDashboardController`
* `DesignController`
* `OrderController`
* `PaymentController`

---

## Views Summary

* `designer/register.blade.php`
* `designer/login.blade.php`
* `designer/dashboard.blade.php`
* `buyer/register.blade.php`
* `buyer/login.blade.php`
* `buyer/dashboard.blade.php`
* `payment.blade.php`
* `thank_you.blade.php`

---

## Notes

* Use Laravel file upload for design images
* Store images in `/public/designs/`
* Dummy payment is just a form POST that updates order status

