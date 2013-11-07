<?php

namespace Phine\Accessor\Tests\Type;

use Phine\Accessor\Type\FloatType;
use Phine\Test\Method;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Tests the methods in the {@link FloatType} class.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class FloatTypeTest extends TestCase
{
    /**
     * The type instance being tested.
     *
     * @var FloatType
     */
    private $type;

    /**
     * Make sure the type returns the expected name.
     */
    public function testGetName()
    {
        $this->assertEquals(
            'float',
            $this->type->getName(),
            'The name "float" should be returned.'
        );
    }

    /**
     * Make sure the type check is correct.
     */
    public function testIsValidType()
    {
        $this->assertFalse(
            Method::invoke($this->type, 'isValidType', $this, 'test'),
            'The value should not be valid.'
        );

        $this->assertTrue(
            Method::invoke($this->type, 'isValidType', $this, 1.23),
            'The value should be valid.'
        );
    }

    /**
     * Creates a new instance of the type.
     */
    protected function setUp()
    {
        $this->type = new FloatType();
    }
}
