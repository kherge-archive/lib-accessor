<?php

namespace Phine\Accessor\Type;

/**
 * A type class for the string value type.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class StringType extends AbstractNullableType
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'string';
    }

    /**
     * @override
     */
    protected function isValidType($object, $value)
    {
        return is_string($value);
    }
}
