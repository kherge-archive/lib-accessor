<?php

namespace Phine\Accessor\Test;

use DateTime;
use Phine\Accessor\AccessorTrait;
use Phine\Accessor\Type\InstanceType;
use Phine\Accessor\Type\TypeInterface;

/**
 * A class that uses the accessor trait.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 *
 * @property mixed    $any          A property that accepts any value.
 * @property DateTime $date         A date and time.
 * @property null     $doesNotExist This property does not exist.
 * @property integer  $notPublic    A property that is not public.
 * @property string   $readOnly     A read-only property.
 * @property DateTime $requiredDate A required date and time.
 */
class Accessor
{
    use AccessorTrait;

    /**
     * A property that accepts any value.
     *
     * @var mixed
     */
    private $any;

    /**
     * A date and time.
     *
     * @var DateTime
     */
    private $date;

    /**
     * A property that is not public.
     *
     * @var integer
     */
    private $notPublic = 123;

    /**
     * A read-only property.
     *
     * @var string
     */
    private $readOnly = 'This is read-only.';

    /**
     * A required date and time.
     *
     * @var DateTime
     */
    private $requiredDate;

    /**
     * Registers the properties that need accessors.
     */
    public function __construct()
    {
        $this->requiredDate = new DateTime();

        $this->makePropertyAccessible('date');
        $this->makePropertyAccessible('readOnly');
        $this->makePropertyAccessible('requiredDate');

        $this->makePropertyMutable('any');
        $this->makePropertyMutable('date', new InstanceType('DateTime', true));
        $this->makePropertyMutable(
            'requiredDate',
            new InstanceType('DateTime')
        );
    }

    /**
     * @see Accessor::makePropertyAccessible
     */
    public function makeAccessible($name)
    {
        $this->makePropertyAccessible($name);
    }

    /**
     * @see Accessor::makePropertyMutable
     */
    public function makeMutable($name, TypeInterface $type = null)
    {
        $this->makePropertyMutable($name, $type);
    }
}
