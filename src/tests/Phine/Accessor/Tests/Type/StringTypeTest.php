<?php

namespace Phine\Accessor\Tests\Type;

use Phine\Accessor\Type\StringType;
use Phine\Test\Method;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Tests the methods in the {@link StringType} class.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class StringTypeTest extends TestCase
{
    /**
     * The type instance being tested.
     *
     * @var StringType
     */
    private $type;

    /**
     * Make sure the type returns the expected name.
     */
    public function testGetName()
    {
        $this->assertEquals(
            'string',
            $this->type->getName(),
            'The name "string" should be returned.'
        );
    }

    /**
     * Make sure the type check is correct.
     */
    public function testIsValidType()
    {
        $this->assertFalse(
            Method::invoke($this->type, 'isValidType', $this, false),
            'The value should not be valid.'
        );

        $this->assertTrue(
            Method::invoke($this->type, 'isValidType', $this, 'test'),
            'The value should be valid.'
        );
    }

    /**
     * Creates a new instance of the type.
     */
    protected function setUp()
    {
        $this->type = new StringType();
    }
}
