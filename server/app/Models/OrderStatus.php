<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $table = 'order_status';

    const STT_DRAFT = 0;
    const STT_PENDING = 1;
    const STT_PROCESSING = 2;
    const STT_SHIPPED = 3;
    const STT_COMPLETED = 4;
    const STT_CANCELED = 5;
    const STT_DENIED = 6;
    const STT_CANCELED_REVERSAL = 7;
    const STT_FAILED = 8;
    const STT_REFUNDED = 9;
    const STT_REVERSED = 10;
    const STT_CHARGEBACK = 11;
    const STT_EXPIRED = 12;
    const STT_PROCESSED = 13;
    const STT_VOIDED = 14;
    const STT_ALLOCATED = 15;
    const STT_PARTIAL_CANCELED = 16;

    public function order()
    {
        return $this->hasOne(OrderStatus::class, 'order_status_id', 'id');
    }

    public static $orderStatusList = [
        [
            'id' => self::STT_DRAFT,
            'name' => 'Draft',
            'badge' => 'badge-warning'
        ],
        [
            'id' => self::STT_PENDING,
            'name' => 'Pending',
            'badge' => 'badge-warning'
        ],
        [
            'id' => self::STT_PROCESSING,
            'name' => 'Processing',
            'badge' => 'badge-secondary'
        ],
        [
            'id' => self::STT_SHIPPED,
            'name' => 'Shipped',
            'badge' => 'badge-primary'
        ],
        [
            'id' => self::STT_COMPLETED,
            'name' => 'Completed',
            'badge' => 'badge-success'
        ],
        [
            'id' => self::STT_CANCELED,
            'name' => 'Canceled',
            'badge' => 'badge-danger'
        ],
        [
            'id' => self::STT_DENIED,
            'name' => 'Denied',
            'badge' => 'badge-danger'
        ],
        [
            'id' => self::STT_CANCELED_REVERSAL,
            'name' => 'Canceled Reversal',
            'badge' => 'badge-danger'
        ],
        [
            'id' => self::STT_FAILED,
            'name' => 'Failed',
            'badge' => 'badge-danger'
        ],
        [
            'id' => self::STT_REFUNDED,
            'name' => 'Refunded',
            'badge' => 'badge-dark'
        ],
        [
            'id' => self::STT_REVERSED,
            'name' => 'Reversed',
            'badge' => 'badge-dark'
        ],
        [
            'id' => self::STT_CHARGEBACK,
            'name' => 'Chargeback',
            'badge' => 'badge-dark'
        ],
        [
            'id' => self::STT_EXPIRED,
            'name' => 'Expired',
            'badge' => 'badge-danger'
        ],
        [
            'id' => self::STT_PROCESSED,
            'name' => 'Processed',
            'badge' => 'badge-primary'
        ],
        [
            'id' => self::STT_VOIDED,
            'name' => 'Voided',
            'badge' => 'badge-dark'
        ],
        [
            'id' => self::STT_ALLOCATED,
            'name' => 'Allocated',
            'badge' => 'badge-secondary'
        ],
    ];

    public static $orderStatusListSort = [
        [
            'id' => self::STT_ALLOCATED,
            'name' => 'general.order_status.allocated',
            'badge' => 'badge-secondary'
        ],
        [
            'id' => self::STT_PENDING,
            'name' => 'general.order_status.pending',
            'badge' => 'badge-warning'
        ],
        [
            'id' => self::STT_PROCESSING,
            'name' => 'general.order_status.processing',
            'badge' => 'badge-secondary'
        ],
        [
            'id' => self::STT_SHIPPED,
            'name' => 'general.order_status.shipped',
            'badge' => 'badge-primary'
        ],
        [
            'id' => self::STT_COMPLETED,
            'name' => 'general.order_status.completed',
            'badge' => 'badge-success'
        ],
        [
            'id' => self::STT_CANCELED,
            'name' => 'general.order_status.canceled',
            'badge' => 'badge-danger'
        ],
    ];

    public static function getStatusWithCurrentStatus($id = null, $is_admin = true)
    {
        if (isset($id)) {
            $return = [];
            switch ($id) {
                case self::STT_DRAFT:
                case self::STT_PENDING:
                    $return = [
                        self::STT_PROCESSING => 'Processing',
                        self::STT_SHIPPED => 'Shipped',
                        self::STT_COMPLETED => 'Completed',
                        self::STT_CANCELED => 'Canceled',
                    ];
                    break;
                case self::STT_PROCESSING:
                    $return = [
                        self::STT_SHIPPED => 'Shipped',
                        self::STT_COMPLETED => 'Completed',
                        self::STT_CANCELED => 'Canceled',
                    ];
                    break;
                case self::STT_ALLOCATED:
                case self::STT_SHIPPED:
                    $return = [
                        self::STT_COMPLETED => 'Completed',
                        self::STT_CANCELED => 'Canceled',
                    ];
                    break;
                case self::STT_COMPLETED:
                    $return = [
                        self::STT_CANCELED => 'Canceled',
                    ];
                    break;
            }
            return $return;
        }
    }

    public static array $orderStatusShippingList = [
        [
            'id' => self::STT_SHIPPED,
            'name' => 'Shipped'
        ]
    ];

    public static array $orderStatusSendMailList = [
        [
            'id' => self::STT_PENDING,
            'name' => 'Pending'
        ],
        [
            'id' => self::STT_PROCESSING,
            'name' => 'Processing'
        ],
        [
            'id' => self::STT_SHIPPED,
            'name' => 'Shipped'
        ],
        [
            'id' => self::STT_COMPLETED,
            'name' => 'Completed'
        ],
        [
            'id' => self::STT_CANCELED,
            'name' => 'Canceled'
        ],
    ];

    /**
     * Show Item to cancel
     * @var array[]
     */
    public static array $orderStatusShowItem = [
        [
            'id' => self::STT_SHIPPED,
            'name' => 'Shipped',
        ],
        [
            'id' => self::STT_ALLOCATED,
            'name' => 'Allocated'
        ],
        [
            'id' => self::STT_PARTIAL_CANCELED,
            'name' => 'Partial Canceled'
        ],
        [
            'id' => self::STT_COMPLETED,
            'name' => 'Completed'
        ],
    ];

}
