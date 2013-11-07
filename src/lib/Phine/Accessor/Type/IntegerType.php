<?php

namespace Phine\Accessor\Type;

/**
 * A type class for the integer value type.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class IntegerType extends AbstractNullableType
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'integer';
    }

    /**
     * @override
     */
    protected function isValidType($object, $value)
    {
        return is_int($value);
    }
}
