<?php

namespace Phine\Accessor;

use InvalidArgumentException;
use LogicException;
use Phine\Accessor\Type\MixedType;
use Phine\Accessor\Type\TypeInterface;
use UnexpectedValueException;

/**
 * Uses magic methods to manage accessors of protected and private properties.
 *
 * This trait leverages the `__get()`, `__isset()`, and `__set()` magic methods
 * to control access to protected and private class properties. You can specify
 * which properties are accessible and mutable, as well as what type the value
 * must be when setting.
 *
 * To define which properties are accessible and mutable, you must configure
 * the trait during instantiation through your class constructor. There are
 * two methods you may use:
 *
 * - `makePropertyAccessible()` &mdash; Makes a property accessible.
 * - `makePropertyMutable()` &mdash; Makes a property mutable.
 *
 * It may be important to know that if you need a property to be both accessible
 * and mutable, you must call both methods for the same property. If you only
 * call one of the methods, only that ability will be activated for the given
 * property.
 *
 * While defining the settings directly through the `$accessorSettings` property
 * may be better for performance, I would strongly discourage using this route
 * for configuring the trait. By using the available methods, you are given
 * backwards compatibility safety, while the property will not.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
trait AccessorTrait
{
    /**
     * The accessor configuration settings.
     *
     * @var array
     */
    private $accessorSettings = array();

    /**
     * Returns the value of a property.
     *
     * @param string $name The name of a property.
     *
     * @return mixed The value of a property.
     *
     * @throws LogicException If the property does not exist or is not accessible.
     */
    public function __get($name)
    {
        if (!property_exists($this, $name)) {
            throw new LogicException(
                "The property \"$name\" does not exist."
            );
        }

        if (empty($this->accessorSettings[$name]['get'])) {
            throw new LogicException(
                "The property \"$name\" is not accessible."
            );
        }

        return $this->$name;
    }

    /**
     * Checks if a property is set.
     *
     * This method makes an attempt to mimic the default behavior shown by PHP.
     * If a property was not made accessible, it will behave as if the magic
     * method does not exist by always returning `false`. PHP returns `false`
     * when either a property does not exist, or if it is not public. Otherwise,
     * `isset()` can be expected to behave normally:
     *
     * ```php
     * class Test
     * {
     *     use Phine\Accessor\AccessorTrait;
     *
     *     public $public = true;
     *     protected $protected = null;
     *     private $private = true;
     *
     *     public function __construct()
     *     {
     *         $this->makePropertyAccessible('private');
     *     }
     * }
     *
     * $test = new Test();
     *
     * var_export(isset($test->public)); // "true"
     * var_export(isset($test->protected)); // "false"
     * var_export(isset($test->private)); // "true"
     * ```
     *
     * @param string $name The name of a property.
     *
     * @return boolean If the property is set, `true` is returned. If the
     *                 property is not set, `false` is returned.
     */
    public function __isset($name)
    {
        if (property_exists($this, $name)
            && isset($this->accessorSettings[$name]['get'])) {
            return isset($this->$name);
        }

        return false;
    }

    /**
     * Sets the value of a property.
     *
     * @param string $name  The name of a property.
     * @param mixed  $value A value for the property.
     *
     * @throws LogicException           If the property is not accessible.
     * @throws UnexpectedValueException If the value type is not expected.
     */
    public function __set($name, $value)
    {
        if (!property_exists($this, $name)) {
            throw new LogicException(
                "The property \"$name\" does not exist."
            );
        }

        if (empty($this->accessorSettings[$name]['set'])) {
            throw new LogicException(
                "The property \"$name\" is not mutable."
            );
        }

        /** @var TypeInterface $type */
        $type = $this->accessorSettings[$name]['set'];

        if ($type && !$type->isValid($this, $value)) {
            throw new UnexpectedValueException(
                sprintf(
                    'Expected "%s" for "%s", received "%s".',
                    $type->getName(),
                    $name,
                    is_object($value) ? get_class($value) : gettype($value)
                )
            );
        }

        $this->$name = $value;
    }

    /**
     * Removes a property from this object.
     *
     * @param string $name The name of a property.
     *
     * @throws LogicException If the property is not mutable.
     */
    public function __unset($name)
    {
        if (empty($this->accessorSettings[$name]['set'])) {
            throw new LogicException(
                "The property \"$name\" is not mutable."
            );
        }

        unset($this->$name);
    }

    /**
     * Makes a property accessible.
     *
     * @param string $name The name of a property.
     *
     * @throws InvalidArgumentException If the property does not exist.
     */
    private function makePropertyAccessible($name)
    {
        if (!property_exists($this, $name)) {
            throw new InvalidArgumentException(
                "The property \"$name\" does not exist."
            );
        }

        if (!isset($this->accessorSettings[$name])) {
            $this->accessorSettings[$name] = array();
        }

        $this->accessorSettings[$name]['get'] = true;
    }

    /**
     * Makes a property mutable.
     *
     * When the property is set with a new value, the type of the new value
     * will be validated against the given type class. If no type class is
     * given, any value type will be allowed.
     *
     * @param string        $name The name of a property.
     * @param TypeInterface $type The value type expected.
     *
     * @throws InvalidArgumentException If the property does not exist.
     */
    private function makePropertyMutable($name, TypeInterface $type = null)
    {
        if (!property_exists($this, $name)) {
            throw new InvalidArgumentException(
                "The property \"$name\" does not exist."
            );
        }

        if (!isset($this->accessorSettings[$name])) {
            $this->accessorSettings[$name] = array();
        }

        if (null === $type) {
            $type = new MixedType();
        }

        $this->accessorSettings[$name]['set'] = $type;
    }
}
