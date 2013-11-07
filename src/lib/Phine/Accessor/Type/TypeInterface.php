<?php

namespace Phine\Accessor\Type;

/**
 * Defines how a value type class must be implemented.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
interface TypeInterface
{
    /**
     * Returns the name of the type.
     *
     * @return string The name of the type.
     */
    public function getName();

    /**
     * Checks if a value type is valid.
     *
     * @param object $object The object being modified.
     * @param mixed  $value  A value to check.
     *
     * @return boolean If the type of the given value is valid, `true` is
     *                 returned. If the type of the given value is not valid,
     *                 `false` is returned.
     */
    public function isValid($object, $value);
}
