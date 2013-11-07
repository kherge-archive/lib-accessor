<small>Phine\Accessor\Type</small>

AbstractNullableType
====================

The basis for a nullable type class.

Signature
---------

- It is a(n) **abstract class**.
- It implements the [`TypeInterface`](../../../Phine/Accessor/Type/TypeInterface.md) interface.

Methods
-------

The abstract class defines the following methods:

- [`__construct()`](#__construct) &mdash; Sets the flag used to determine if `null` is an acceptable value.
- [`isValid()`](#isValid) &mdash; Checks if a value type is valid.

### `__construct()` <a name="__construct"></a>

Sets the flag used to determine if `null` is an acceptable value.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$nullable` (`boolean`) &mdash; Is `null` an acceptable value?
- It does not return anything.

### `isValid()` <a name="isValid"></a>

Checks if a value type is valid.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$object` (`object`) &mdash; The object being modified.
    - `$value` (`mixed`) &mdash; A value to check.
- _Returns:_ If the type of the given value is valid, `true` is returned. If the type of the given value is not valid, `false` is returned.
    - `boolean`

