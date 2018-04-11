# silverstripe-standard-permissions
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/salted-herring/silverstripe-standard-permissions/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/salted-herring/silverstripe-standard-permissions/?branch=master) [![Build Status](https://scrutinizer-ci.com/g/salted-herring/silverstripe-standard-permissions/badges/build.png?b=master)](https://scrutinizer-ci.com/g/salted-herring/silverstripe-standard-permissions/build-status/master)

Implements Silverstripe's standard permissions (canCreate, canEdit, canDelete, and canView)

## Install

The module can be installed via composer:
```bash
composer require salted-herring/silverstripe-standard-permissions
```
## Usage

Any object that needs to use permissions, should do two things:

1. Setup the yaml configuration to provide the permissions:

```yml
PublishProvider:
  classes:
    - Page
```

2. The class you're using should also extend `PublishProvider`:

```php
class Page {
  ...
  private static $extensions = [
    'PublishProvider'
  ];
  ...
}
```
