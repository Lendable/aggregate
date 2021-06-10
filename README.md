Lendable Aggregate
====================
Library with supporting functionality to bridge domain and infrastructure interactions for aggregates within event sourcing systems.

This does not help with building out your domain, but rather provides interfaces and base functionality for an infrastructure layer to interact with your aggregate classes without requiring them to implement library specific interfaces. 

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
 
