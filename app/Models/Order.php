<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'buyer_id',
        'design_id',
        'quantity',
        'unit_price',
        'total_amount',
        'status',
        'notes',
        'ordered_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'ordered_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Order status constants
     */
    const STATUS_PENDING = 'pending';
    const STATUS_PAID = 'paid';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_REFUNDED = 'refunded';

    /**
     * Get all available order statuses.
     *
     * @return array
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_PAID => 'Paid',
            self::STATUS_CONFIRMED => 'Confirmed',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_CANCELLED => 'Cancelled',
            self::STATUS_REFUNDED => 'Refunded',
        ];
    }

    /**
     * Get the buyer that owns the order.
     */
    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    /**
     * Get the design that was ordered.
     */
    public function design()
    {
        return $this->belongsTo(Design::class);
    }

    /**
     * Scope a query to only include pending orders.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope a query to only include paid orders.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePaid($query)
    {
        return $query->where('status', self::STATUS_PAID);
    }

    /**
     * Scope a query to only include confirmed orders.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', self::STATUS_CONFIRMED);
    }

    /**
     * Scope a query to only include completed orders.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    /**
     * Scope a query to filter orders by status.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Get the formatted status for display.
     *
     * @return string
     */
    public function getFormattedStatusAttribute()
    {
        $statuses = self::getStatuses();
        return $statuses[$this->status] ?? ucfirst($this->status);
    }

    /**
     * Get the status badge class for UI display.
     *
     * @return string
     */
    public function getStatusBadgeClassAttribute()
    {
        $classes = [
            self::STATUS_PENDING => 'bg-yellow-100 text-yellow-800',
            self::STATUS_PAID => 'bg-green-100 text-green-800',
            self::STATUS_CONFIRMED => 'bg-blue-100 text-blue-800',
            self::STATUS_IN_PROGRESS => 'bg-indigo-100 text-indigo-800',
            self::STATUS_COMPLETED => 'bg-green-100 text-green-800',
            self::STATUS_CANCELLED => 'bg-red-100 text-red-800',
            self::STATUS_REFUNDED => 'bg-gray-100 text-gray-800',
        ];

        return $classes[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    /**
     * Calculate and set the total amount based on quantity and unit price.
     *
     * @return void
     */
    public function calculateTotal()
    {
        $this->total_amount = $this->quantity * $this->unit_price;
    }

    /**
     * Check if the order can be paid.
     *
     * @return bool
     */
    public function canBePaid()
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Mark the order as paid.
     *
     * @return bool
     */
    public function markAsPaid()
    {
        if (!$this->canBePaid()) {
            return false;
        }

        return $this->update(['status' => self::STATUS_PAID]);
    }

    /**
     * Boot method to set default values and handle events.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (!$order->status) {
                $order->status = self::STATUS_PENDING;
            }
            if (!$order->ordered_at) {
                $order->ordered_at = now();
            }
            $order->calculateTotal();
        });

        static::updating(function ($order) {
            $order->calculateTotal();
        });
    }
}