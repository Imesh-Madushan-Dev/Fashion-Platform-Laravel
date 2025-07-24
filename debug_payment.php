<?php

require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Get the first pending order
$order = \App\Models\Order::where('status', 'pending')->first();

if (!$order) {
    echo "No pending orders found. Creating test data...\n";
    
    // Check if we have any orders at all
    $anyOrder = \App\Models\Order::first();
    if ($anyOrder) {
        echo "Found order ID: " . $anyOrder->id . " with status: " . $anyOrder->status . "\n";
        echo "Can be paid: " . ($anyOrder->canBePaid() ? 'Yes' : 'No') . "\n";
        
        if ($anyOrder->status !== 'pending') {
            echo "Setting order status to pending for testing...\n";
            $anyOrder->update(['status' => 'pending']);
            echo "Order status updated to: " . $anyOrder->fresh()->status . "\n";
        }
    } else {
        echo "No orders found in database\n";
    }
} else {
    echo "Found pending order ID: " . $order->id . "\n";
    echo "Can be paid: " . ($order->canBePaid() ? 'Yes' : 'No') . "\n";
    
    echo "Attempting to mark as paid...\n";
    $result = $order->markAsPaid();
    echo "Payment result: " . ($result ? 'Success' : 'Failed') . "\n";
    echo "New status: " . $order->fresh()->status . "\n";
}
