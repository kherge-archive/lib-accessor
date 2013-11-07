<?php

namespace Phine\Accessor\Type;

/**
 * A type class for the boolean value type.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class BooleanType extends AbstractNullableType
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'bool';
    }

    /**
     * @override
     */
    protected function isValidType($object, $value)
    {
        return is_bool($value);
    }
}
