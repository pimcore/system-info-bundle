# Installation
## Bundle Installation

1. Install the required dependencies:
```bash
composer require pimcore/system-info-bundle
```

2. Make sure the bundle is enabled in the `config/bundles.php` file. The following lines should be added:

```php
use Pimcore\Bundle\SystemInfoBundle\PimcoreSystemInfoBundle;
// ...

return [
    // ...
    PimcoreSystemInfoBundle::class => ['all' => true],
    // ...
];
```

3. Install the bundle:

```bash
bin/console pimcore:bundle:install PimcoreSystemInfoBundle
```
  
