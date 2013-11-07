<?php

namespace Phine\Accessor\Tests\Type;

use DateTime;
use Phine\Accessor\Type\InstanceType;
use Phine\Test\Method;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Tests the methods in the {@link InstanceType} class.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class InstanceTypeTest extends TestCase
{
    /**
     * The type instance being tested.
     *
     * @var InstanceType
     */
    private $type;

    /**
     * Make sure the type returns the expected name.
     */
    public function testGetName()
    {
        $this->assertEquals(
            'DateTime',
            $this->type->getName(),
            'The name "DateTime" should be returned.'
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
            Method::invoke($this->type, 'isValidType', $this, new DateTime()),
            'The value should be valid.'
        );
    }

    /**
     * Creates a new instance of the type.
     */
    protected function setUp()
    {
        $this->type = new InstanceType('DateTime');
    }
}
