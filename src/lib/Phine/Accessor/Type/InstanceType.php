<?php

namespace Phine\Accessor\Type;

/**
 * A type class for instances of a specific class or interface.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class InstanceType extends AbstractNullableType
{
    /**
     * The fully qualified class name.
     *
     * @var string
     */
    private $class;

    /**
     * Sets the fully qualified class name.
     *
     * @param string $class     The name of a class.
     * @param boolean $nullable Is `null` an acceptable value?
     */
    public function __construct($class, $nullable = false)
    {
        parent::__construct($nullable);

        $this->class = $class;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->class;
    }

    /**
     * @override
     */
    protected function isValidType($object, $value)
    {
        return is_object($value) && is_a($value, $this->class);
    }
}
