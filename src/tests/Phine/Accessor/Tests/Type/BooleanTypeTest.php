<?php

namespace Phine\Accessor\Tests\Type;

use Phine\Accessor\Type\BooleanType;
use Phine\Test\Method;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Tests the methods in the {@link BooleanType} class.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class BooleanTypeTest extends TestCase
{
    /**
     * The type instance being tested.
     *
     * @var BooleanType
     */
    private $type;

    /**
     * Make sure the type returns the expected name.
     */
    public function testGetName()
    {
        $this->assertEquals(
            'bool',
            $this->type->getName(),
            'The name "boolean" should be returned.'
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
            Method::invoke($this->type, 'isValidType', $this, true),
            'The value should be valid.'
        );
    }

    /**
     * Creates a new instance of the type.
     */
    protected function setUp()
    {
        $this->type = new BooleanType();
    }
}
