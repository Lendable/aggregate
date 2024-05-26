Lendable Aggregate
====================

[![Latest Stable Version](https://poser.pugx.org/lendable/aggregate/v/stable)](https://packagist.org/packages/lendable/aggregate)
[![License](https://poser.pugx.org/lendable/aggregate/license)](https://packagist.org/packages/lendable/aggregate)

Library with supporting functionality to bridge domain and infrastructure interactions for aggregates within event sourcing systems.

This does not help with building out your domain. Rather, it provides interfaces and base functionality for an infrastructure layer to interact with your
aggregate classes without requiring them to implement library specific interfaces.

## Installation

You can install the library via [Composer](https://getcomposer.org/).

```bash
composer require lendable/aggregate
```

## Requirements

* PHP >= 8.2

## Functionality

### `AggregateIdExtractor`

Defines a contract for extracting an `AggregateId` from domain aggregate objects. Your aggregate class should not hold an `AggregateId` instance, but instead a
domain specific identifier type (e.g. `UserId`).

### `AggregateTypeResolver`

Defines a contract for resolving an `AggregateType` from domain aggregate objects. An `AggregateType` is a classification of aggregate. This is an
infrastructure concern, and is aimed towards audit logging alongside an `AggregateId` and single schema / multiple aggregate storage patterns.

### `AggregateVersionExtractor`

Defines a contract for extracting an `AggregateVersion` from domain aggregate objects. This is an event sourcing infrastructure concept whereby (usually) the
version increases for each event that has taken place to influence the state of the aggregate.

## Testing support

The `AggregateIdExtractorSpec`, `AggregateTypeResolverSpec` and `AggregateVersionExtractorSpec` are provided to ease testing of your implementations. Simply
extend these classes for your own test suite and implement the hook points.

```php
use Lendable\Aggregate\Testing\AggregateIdExtractorSpec;
use Lendable\Aggregate\AggregateIdExtractor;
use Lendable\Aggregate\AggregateId;

final class FooIdExtractor extends AggregateIdExtractorSpec 
{
    protected function createExtractor(): AggregateIdExtractor
    {
        return new FooIdExtractor();
    }
    
    protected function createExpectedAggregateId(): AggregateId
    {
        return AggregateId::fromString('1406fd13-29d3-44e3-812c-c1cd14e12b38');
    }
    
    protected function createAggregateWithExpectedAggregateId(): object
    {
        return Foo::register(FooId::fromString('1406fd13-29d3-44e3-812c-c1cd14e12b38'));
    }
}
```
