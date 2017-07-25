# ExposeBundle

Integrates the [expose](https://github.com/enygma/expose) project into symfony. It allows you to register handlers to respond to reports for the current request. (to block users/ips, send notifications, etc.)

The bundle throws an exception if the impact for the current request is greater than the configured threshold.

# Installation

`composer require floriansemm/expose-bundle`

Register the bundle:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new FS\ExposeBundle\FSExposeBundle(),
    );
}
```

Add the bundle to your `config.yml`

```yaml
fs_expose: ~

```

# Configuration

If you want to allow all requests no matter what impact occurs, set the `impact` option to 0:

```yaml
fs_expose:
    request_suspension:
        impact: 0
```

# Add a intrusion-handler

1. create a service which implements `IntrusionHandlerInterface`
2. tag the service with `expose.intrusion_handler`
