<small>Phine\Accessor\Type</small>

TypeInterface
=============

Defines how a value type class must be implemented.

Signature
---------

- It is a(n) **interface**.

Methods
-------

The interface defines the following methods:

- [`getName()`](#getName) &mdash; Returns the name of the type.
- [`isValid()`](#isValid) &mdash; Checks if a value type is valid.

### `getName()` <a name="getName"></a>

Returns the name of the type.

#### Signature

- It is a **public** method.
- _Returns:_ The name of the type.
    - `string`

### `isValid()` <a name="isValid"></a>

Checks if a value type is valid.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$object` (`object`) &mdash; The object being modified.
    - `$value` (`mixed`) &mdash; A value to check.
- _Returns:_ If the type of the given value is valid, `true` is returned. If the type of the given value is not valid, `false` is returned.
    - `boolean`

