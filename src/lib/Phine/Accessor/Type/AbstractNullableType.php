<?php

namespace Phine\Accessor\Type;

/**
 * The basis for a nullable type class.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
abstract class AbstractNullableType implements TypeInterface
{
    /**
     * Is a null value acceptable?
     *
     * @var boolean
     */
    private $nullable = false;

    /**
     * Sets the flag used to determine if `null` is an acceptable value.
     *
     * @param boolean $nullable Is `null` an acceptable value?
     */
    public function __construct($nullable = false)
    {
        $this->nullable = $nullable;
    }

    /**
     * {@inheritDoc}
     */
    public function isValid($object, $value)
    {
        if (null === $value) {
            return $this->nullable;
        }

        return $this->isValidType($object, $value);
    }

    /**
     * Checks if the type of the value is valid.
     *
     * @param object $object The object being modified.
     * @param mixed  $value  A value to check.
     *
     * @return boolean If the type is valid, `true` is returned. If the type
     *                 is not valid, `false` is returned.
     */
    abstract protected function isValidType($object, $value);
}
