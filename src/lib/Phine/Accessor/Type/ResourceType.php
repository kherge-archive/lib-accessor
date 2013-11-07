<?php

namespace Phine\Accessor\Type;

/**
 * A type class for the resource value type.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class ResourceType extends AbstractNullableType
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'resource';
    }

    /**
     * @override
     */
    protected function isValidType($object, $value)
    {
        return is_resource($value);
    }
}
