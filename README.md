Path
====

[![Build Status][]](https://travis-ci.org/phine/lib-accessor)
[![Coverage Status][]](https://coveralls.io/r/phine/lib-accessor)
[![Latest Stable Version][]](https://packagist.org/packages/phine/accessor)
[![Total Downloads][]](https://packagist.org/packages/phine/accessor)

A PHP library for simplifying the use of accessors.

Usage
-----

```php
use Doctrine\ORM\Mapping as ORM;
use Phine\Accessor\AccessorTrait;
use Phine\Accessor\Type\InstanceType;

/**
 * This is an example Doctrine entity class.
 *
 * @ORM\Entity()
 * @ORM\Table()
 */
class Address
{
    use AccessorTrait;

    /**
     * The country the address resides in.
     *
     * @var Country
     *
     * @ORM\JoinColumn(name="country")
     * @ORM\ManyToOne(targetEntity="Country")
     */
    private $country;

    /**
     * The unique identifier for this address.
     *
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Id()
     */
    private $id;

    /**
     * The state the address resides in.
     *
     * @var State
     *
     * @ORM\JoinColumn(name="state")
     * @ORM\ManyToOne(targetEntity="State")
     */
    private $state;

    /**
     * Configures the accessors.
     */
    public function __construct()
    {
        $this->makePropertyAccessible('country');
        $this->makePropertyAccessible('id');
        $this->makePropertyAccessible('state');

        $this->makePropertyMutable('country', new InstanceType('Country'));
        $this->makePropertyMutable('state', new InstanceType('State'));
    }
}
```

Now we make use of that example class:

```php
// this all works just fine
$address = new Address();
$address->country = new Country();
$address->state = new State();

// these throw exceptions
$address->country = new State();
$address->id = 123;
$address->state = null;
```

Requirement
-----------

- PHP >= 5.4

Installation
------------

Via [Composer][]:

    $ composer require "phine/accessor=~1.0"

Documentation
-------------

You can find the documentation in the [`docs/`](docs/) directory.

License
-------

This library is available under the [MIT license](LICENSE).

[Build Status]: https://travis-ci.org/phine/lib-accessor.png?branch=master
[Coverage Status]: https://coveralls.io/repos/phine/lib-accessor/badge.png
[Latest Stable Version]: https://poser.pugx.org/phine/accessor/v/stable.png
[Total Downloads]: https://poser.pugx.org/phine/accessor/downloads.png
[Phine Exception]: https://github.com/phine/lib-exception
[Composer]: http://getcomposer.org/
