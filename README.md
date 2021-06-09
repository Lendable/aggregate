Lendable Library Template
====================
A template repository for creating new PHP libraries

## Installation
This repository is private, so you will need to add a definition to your 
`composer.json`'s `repositories` section.

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url":  "git@github.com:Lendable/aggregate.git"
        }
    ]
}
```

You can then install the library.

```bash
composer require lendable/aggregate
```

## Requirements
* PHP 7.4
 
## Functionality

### `AggregateIdExtractor`
Defines a contract for extracting an `AggregateId` from domain aggregate objects. Your aggregate class should not itself hold an `AggregateId` instance, but instead a domain specific identifier type (e.g. `UserId`).

### `AggregateTypeResolver`
Defines a contract for resolving an `AggregateType` from domain aggregate objects. An `AggregateType` is a classification of aggregate. This is an infrastrucute concern, and is aimed towards audit logging alongside an `AggregateId` and single schema / multiple aggregate storage patterns.

### `AggregateVersionExtractor`
Defines a contract for extracting an `AggregateVersion` from domain aggregate objects. This is an event sourcing infrastructure concept where by (usually) the version is increased for each event that has taken place to influence the state of the aggregate.
