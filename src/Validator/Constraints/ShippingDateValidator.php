<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ShippingDateValidator extends ConstraintValidator
{
    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $shippingDate The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($shippingDate, Constraint $constraint)
    {
        if ($shippingDate->diff((new \DateTime()))->invert){
            $this->context->buildViolation($constraint->message)
                ->setParameters([
                    '{{ shippingDate }}' => $shippingDate->format('Y-m-d H:i:s'),
                    '{{ now }}' => (new \DateTime())->format('Y-m-d H:i:s')
                ])
                ->addViolation();
        }
    }
}