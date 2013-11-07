<?php

namespace Phine\Accessor\Tests;

use DateTime;
use Exception;
use Phine\Accessor\Test\Accessor;
use Phine\Accessor\Type\ArrayType;
use Phine\Test\Property;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Tests the methods in the {@link AccessorTrait} trait.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class AccessorTraitTest extends TestCase
{
    /**
     * The instance of a class using the accessor trait.
     *
     * @var Accessor
     */
    public $accessor;

    /**
     * Make sure that we can retrieve an accessible property.
     *
     * The `__get()` method should allow us to retrieve accessible properties,
     * and thrown an exception if we try to access an inaccessible one. A new
     * exception should also be thrown if the property does not actually exist.
     */
    public function testGet()
    {
        $this->expectException(
            'LogicException',
            'The property "doesNotExist" does not exist.',
            function (AccessorTraitTest $test) {
                $test->accessor->doesNotExist;
            }
        );

        $this->expectException(
            'LogicException',
            'The property "notPublic" is not accessible.',
            function (AccessorTraitTest $test) {
                $test->accessor->notPublic;
            }
        );

        $this->assertEquals(
            'This is read-only.',
            $this->accessor->readOnly,
            'The "readOnly" property should be accessible.'
        );
    }

    /**
     * Make sure that we can check if an accessible property is set.
     *
     * The `__isset()` method should allow us to check if an accessible
     * property is set. However, if a property does not exist or is not
     * accessible, `false` should always be returned. This is the expected
     * behavior from PHP when `isset()` is used on an object from a class
     * that does not have any magic methods.
     */
    public function testIsset()
    {
        $this->assertTrue(
            isset($this->accessor->requiredDate),
            'The "requiredDate" property should be set.'
        );

        $this->assertFalse(
            isset($this->accessor->date),
            'The "date" property should not be set.'
        );

        $this->assertFalse(
            isset($this->accessor->doeNotExist),
            'The "doesNotExist" property should not be set.'
        );
    }

    /**
     * Make sure that we can set the value of a property.
     *
     * The `__set()` method should be able to set the value of a mutable
     * property. However, the value must be validated according to the expected
     * type. If the type of the value is not expected, the property does not
     * exist, or if the property is not mutable an exception should be thrown.
     */
    public function testSet()
    {
        $this->expectException(
            'LogicException',
            'The property "doesNotExist" does not exist.',
            function (AccessorTraitTest $test) {
                $test->accessor->doesNotExist = 'This is a test.';
            }
        );

        $this->expectException(
            'LogicException',
            'The property "readOnly" is not mutable.',
            function (AccessorTraitTest $test) {
                $test->accessor->readOnly = 'This is a test.';
            }
        );

        $this->expectException(
            'UnexpectedValueException',
            'Expected "DateTime" for "date", received "integer".',
            function (AccessorTraitTest $test) {
                $test->accessor->date = 123;
            }
        );

        // this should not throw any exceptions
        $this->accessor->any = 123;
        $this->accessor->any = null;
        $this->accessor->any = $date = new DateTime();

        $this->assertSame(
            $date,
            Property::get($this->accessor, 'any'),
            'The DateTime instance should be set for "any".'
        );
    }

    /**
     * Make sure that we can remove a mutable property.
     *
     * The `__unset()` method should be able to remove (`unset()`) an
     * accessible property. An exception should only be thrown if the
     * property is not mutable.
     */
    public function testUnset()
    {
        $this->expectException(
            'LogicException',
            'The property "readOnly" is not mutable.',
            function (AccessorTraitTest $test) {
                unset($test->accessor->readOnly);
            }
        );

        unset($this->accessor->date);

        $this->setExpectedException(
            'PHPUnit_Framework_Error_Notice',
            'Undefined property: Phine\\Accessor\\Test\\Accessor::$date'
        );

        $this->accessor->date;
    }

    /**
     * Make sure that we can define an accessible property.
     */
    public function testMakePropertyAccessible()
    {
        $this->expectException(
            'LogicException',
            'The property "doesNotExist" does not exist.',
            function (AccessorTraitTest $test) {
                $test->accessor->makeAccessible('doesNotExist');
            }
        );

        $this->accessor->makeAccessible('notPublic');

        $settings = Property::get($this->accessor, 'accessorSettings');

        $this->assertTrue(
            $settings['notPublic']['get'],
            'The "get" setting for "notPublic" should be set.'
        );
    }

    /**
     * Make sure that we can define a mutable property.
     */
    public function testMakePropertyMutable()
    {
        $this->expectException(
            'LogicException',
            'The property "doesNotExist" does not exist.',
            function (AccessorTraitTest $test) {
                $test->accessor->makeMutable('doesNotExist');
            }
        );

        $type = new ArrayType();

        $this->accessor->makeMutable('readOnly', $type);

        $settings = Property::get($this->accessor, 'accessorSettings');

        $this->assertSame(
            $type,
            $settings['readOnly']['set'],
            'The value type for "readOnly" should be set.'
        );

        $this->accessor->makeMutable('date');

        $settings = Property::get($this->accessor, 'accessorSettings');

        $this->assertInstanceOf(
            'Phine\\Accessor\\Type\\MixedType',
            $settings['date']['set'],
            'The default value type should be "MixedType".'
        );
    }

    /**
     * Creates a new instance of a class using the accessor trait.
     */
    protected function setUp()
    {
        $this->accessor = new Accessor();
    }

    /**
     * Performs an exception assertion without requiring the test case to end.
     *
     * Normally, PHPUnit requires that the test case end before a check is done
     * to see if an exception was thrown. This method is a workaround that will
     * allow the test case to continue after the expected exception is thrown.
     *
     * @param string   $class   The expected class.
     * @param string   $message The expected message.
     * @param callable $test    The test to perform.
     */
    private function expectException($class, $message, $test)
    {
        $exception = null;

        try {
            $test($this);
        } catch (Exception $exception) {
            $this->assertInstanceOf($class, $exception);
            $this->assertEquals($message, $exception->getMessage());
        }

        $this->assertTrue(
            isset($exception),
            'An exception should have been thrown.'
        );
    }
}
