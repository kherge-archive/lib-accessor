<?php

namespace Phine\Accessor\Tests\Type;

use Phine\Accessor\Type\CallableType;
use Phine\Test\Method;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Tests the methods in the {@link CallableType} class.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class CallableTypeTest extends TestCase
{
    /**
     * The type instance being tested.
     *
     * @var CallableType
     */
    private $type;

    /**
     * Make sure the type returns the expected name.
     */
    public function testGetName()
    {
        $this->assertEquals(
            'callable',
            $this->type->getName(),
            'The name "callable" should be returned.'
        );
    }

    /**
     * Make sure the type check is correct.
     */
    public function testIsValidType()
    {
        $this->assertFalse(
            Method::invoke($this->type, 'isValidType', $this, 123),
            'The value should not be valid.'
        );

        $this->assertTrue(
            Method::invoke($this->type, 'isValidType', $this, 'is_array'),
            'The value should be valid.'
        );
    }

    /**
     * Creates a new instance of the type.
     */
    protected function setUp()
    {
        $this->type = new CallableType();
    }
}
