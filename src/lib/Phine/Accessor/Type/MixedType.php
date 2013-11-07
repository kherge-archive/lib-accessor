<?php

namespace Phine\Accessor\Type;

/**
 * A type class for any value type.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class MixedType extends AbstractNullableType
{
    /**
     * @override
     */
    public function __construct($nullable = true)
    {
        parent::__construct($nullable);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'mixed';
    }

    /**
     * @override
     */
    protected function isValidType($object, $value)
    {
        return true;
    }
}
