Here's a fully optimized `design.md` prompt that defines **code structure**, **sub-agent tasks**, and the **design logic** for your simplified Laravel fashion platform system. It aligns with Laravel conventions and is structured to help AI agents or developers reason about responsibilities and generation boundaries.

---

# design.md – Fashion Platform (Laravel Subagent-Oriented Design)

## System Objective

Build a simple fashion marketplace with two roles:

* **Designers** can upload their fashion pieces.
* **Buyers** can view and purchase designs via a dummy payment process.

No complex payment gateway, admin roles, or CMS features are required.

---

## Code Structure

```plaintext
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/
│   │   │   ├── DesignerAuthController.php
│   │   │   └── BuyerAuthController.php
│   │   ├── DesignerDashboardController.php
│   │   ├── BuyerDashboardController.php
│   │   ├── DesignController.php
│   │   ├── OrderController.php
│   │   └── PaymentController.php
│
├── Models/
│   ├── Designer.php
│   ├── Buyer.php
│   ├── Design.php
│   └── Order.php
```

```plaintext
routes/
└── web.php

database/
└── migrations/ (one for each table)

resources/
└── views/
    ├── designer/
    │   ├── login.blade.php
    │   ├── register.blade.php
    │   └── dashboard.blade.php
    ├── buyer/
    │   ├── login.blade.php
    │   ├── register.blade.php
    │   └── dashboard.blade.php
    ├── payment.blade.php
    └── thank_you.blade.php
```

---

## Subagent Task Breakdown

This section defines what each subagent is responsible for if used in multi-agent generation or parallel development.

### 1. **AuthAgent**

**Goal:** Generate basic authentication flows for Designers and Buyers.

**Tasks:**

* Create `DesignerAuthController` and `BuyerAuthController` for login/register
* Use custom guards and providers (one for each role)
* Generate corresponding views

**Sample Guard (config/auth.php):**

```php
'guards' => [
    'designer' => ['driver' => 'session', 'provider' => 'designers'],
    'buyer' => ['driver' => 'session', 'provider' => 'buyers'],
],
'providers' => [
    'designers' => ['driver' => 'eloquent', 'model' => App\Models\Designer::class],
    'buyers' => ['driver' => 'eloquent', 'model' => App\Models\Buyer::class],
],
```

---

### 2. **DesignAgent**

**Goal:** Enable designers to upload, list, and manage designs.

**Tasks:**

* Create `DesignController` with:

  * `store()`: Upload design with title, description, price, image
  * `index()`: List designer's uploads
* Store uploaded images in `/public/designs/`
* Create the `Design` model and migration with `designer_id` FK
* Build Blade view form for design upload

---

### 3. **MarketplaceAgent**

**Goal:** Allow buyers to view and buy designs.

**Tasks:**

* `BuyerDashboardController@index`: Show all `Design` entries
* Link to `/buyer/buy/{design_id}` → creates `Order` with `status=pending`
* Redirect to dummy payment view

---

### 4. **PaymentAgent**

**Goal:** Handle the dummy payment confirmation process.

**Tasks:**

* `PaymentController@show(order_id)`: Show fake payment page
* `PaymentController@process(order_id)`: Set order status to `paid`, redirect to thank-you

---

### 5. **DatabaseAgent**

**Goal:** Define clean migrations for all tables.

**Tables:**

* `designers`: name, email, password
* `buyers`: name, email, password
* `designs`: title, description, price, image\_path, designer\_id (FK)
* `orders`: buyer\_id, design\_id, status

---

### 6. **ViewAgent**

**Goal:** Create minimal, styled Blade templates.

**Tasks:**

* Auth pages for each role
* Designer dashboard with upload form
* Buyer dashboard with grid of designs
* Payment and thank-you views

Use Tailwind CSS (optional) or Bootstrap 5 for basic layout.

---

## Component Interfaces Summary

```php
// DesignController
public function store(Request $request);
public function index(); // Designer-only

// BuyerDashboardController
public function index(); // Buyer sees all designs

// OrderController
public function create($designId); // Generates pending order

// PaymentController
public function show($orderId);
public function process(Request $request, $orderId);
```

---

## Constraints

* No admin panel
* No real payment API
* No Laravel Jetstream, just controllers + Blade + auth guards

---

## Notes

* Make `designer_id` and `buyer_id` relationships in models
* All redirects must include basic flash messages (e.g., "Payment successful")
* Session-based login required; no SPA or Vue needed

