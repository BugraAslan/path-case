<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ShippingDate extends Constraint
{
    const BARCODE_ERROR = '518572c1-db7e-463d-9227-b6902fdb53d1';

    protected static $errorNames = [
        self::BARCODE_ERROR => 'SHIPPING_DATE_ERROR'
    ];

    public $message = 'Shipping date ({{ shippingDate }}) should be greater than ({{ now }})';

    public function validatedBy()
    {
        return 'shipping_date_validator';
    }
}