<?php

namespace Phine\Accessor\Tests\Type;

use Phine\Accessor\Type\AbstractNullableType;
use Phine\Test\Property;
use PHPUnit_Framework_TestCase as TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * Tests the methods in the {@link AbstractNullableType} class.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class AbstractNullableTypeTest extends TestCase
{
    /**
     * The mock for the abstract class being tested.
     *
     * @var AbstractNullableType|MockObject
     */
    private $abstract;

    /**
     * Make sure that the nullable option can be set.
     */
    public function testConstruct()
    {
        $this->assertFalse(
            Property::get($this->abstract, 'nullable'),
            'The default "nullable" value should be false.'
        );

        $abstract = $this->getMockForAbstractClass(
            'Phine\\Accessor\\Type\\AbstractNullableType',
            array(true)
        );

        $this->assertTrue(
            Property::get($abstract, 'nullable'),
            'The "nullable" value should be true.'
        );
    }

    /**
     * Make sure that null values are properly handled.
     *
     * The `isValid()` method should first check if the given value is `null`.
     * If it is, then one of two things needs to happen: if `null` values are
     * acceptable, `true` should be returned. If `null` values are not acceptable,
     * then `false` is returned. If the value is not `null`, then a type check
     * should be performed using the `isValidType()` method.
     */
    public function testIsValid()
    {
        $this
            ->abstract
            ->expects($this->any())
            ->method('isValidType')
            ->with($this)
            ->will(
                $this->returnCallback(
                    function ($object, $value) {
                        return is_array($value);
                    }
                )
            );

        $this->assertFalse(
            $this->abstract->isValid($this, null),
            'A null value should not be valid.'
        );

        // force null as acceptable
        Property::set($this->abstract, 'nullable', true);

        $this->assertTrue(
            $this->abstract->isValid($this, null),
            'A null value should be valid.'
        );

        $this->assertFalse(
            $this->abstract->isValid($this, 'This is a test.'),
            'A string value should not be valid.'
        );

        $this->assertTrue(
            $this->abstract->isValid($this, array('This is a test.')),
            'An array value should be valid.'
        );
    }

    /**
     * Creates a new mock for the `AbstractNullableType` class.
     */
    protected function setUp()
    {
        $this->abstract = $this->getMockForAbstractClass(
            'Phine\\Accessor\\Type\\AbstractNullableType'
        );
    }
}
