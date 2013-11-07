<?php

namespace Phine\Accessor\Tests\Type;

use Phine\Accessor\Type\MixedType;
use Phine\Test\Method;
use Phine\Test\Property;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Tests the methods in the {@link MixedType} class.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class MixedTypeTest extends TestCase
{
    /**
     * The type instance being tested.
     *
     * @var MixedType
     */
    private $type;

    /**
     * Make sure the default "nullable" value is `true`.
     */
    public function testConstruct()
    {
        $this->assertTrue(
            Property::get($this->type, 'nullable'),
            'The "nullable" value should be true.'
        );
    }

    /**
     * Make sure the type returns the expected name.
     */
    public function testGetName()
    {
        $this->assertEquals(
            'mixed',
            $this->type->getName(),
            'The name "mixed" should be returned.'
        );
    }

    /**
     * Make sure the type check is correct.
     */
    public function testIsValidType()
    {
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
        $this->type = new MixedType();
    }
}
