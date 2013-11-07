<small>Phine\Accessor\Type</small>

InstanceType
============

A type class for instances of a specific class or interface.

Signature
---------

- It is a(n) **class**.
- It is a subclass of [`AbstractNullableType`](../../../Phine/Accessor/Type/AbstractNullableType.md).

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Sets the fully qualified class name.
- [`getName()`](#getName) &mdash; Returns the name of the type.

### `__construct()` <a name="__construct"></a>

Sets the fully qualified class name.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$class` (`string`) &mdash; The name of a class.
    - `$nullable` (`boolean`) &mdash; Is `null` an acceptable value?
- It does not return anything.

### `getName()` <a name="getName"></a>

Returns the name of the type.

#### Signature

- It is a **public** method.
- _Returns:_ The name of the type.
    - `string`

