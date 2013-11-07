<?php

namespace Phine\Accessor\Type;

/**
 * A type class for the array value type.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class ArrayType extends AbstractNullableType
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'array';
    }

    /**
     * @override
     */
    protected function isValidType($object, $value)
    {
        return is_array($value);
    }
}
