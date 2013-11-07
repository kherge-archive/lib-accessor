<?php

namespace Phine\Accessor\Type;

/**
 * A type class for a callable value.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class CallableType extends AbstractNullableType
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'callable';
    }

    /**
     * @override
     */
    protected function isValidType($object, $value)
    {
        return is_callable($value);
    }
}
