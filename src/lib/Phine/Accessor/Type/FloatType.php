<?php

namespace Phine\Accessor\Type;

/**
 * A type class for the float value type.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class FloatType extends AbstractNullableType
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'float';
    }

    /**
     * @override
     */
    protected function isValidType($object, $value)
    {
        return is_float($value);
    }
}
