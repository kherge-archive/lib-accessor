<?php

namespace Phine\Accessor\Type;

/**
 * A type class for the object value type.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class ObjectType extends AbstractNullableType
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'object';
    }

    /**
     * @override
     */
    protected function isValidType($object, $value)
    {
        return is_object($value);
    }
}
