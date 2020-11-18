# php-hook-and-filter

## PHP Hook and Filter System

### User Guide

```php
require_once "core/Sfxhook.php";
require_once "core/Sfxfilter.php";
```
### Hook

```php
$hook = new Sfxhook();

// FUNCTION 1
$hook->add("test_hook", function ($args) {
    // print_r($args);
    echo "FUNCTION 1";
    echo $args["after"];
});


// FUNCTION 2
function function_2($args)
{
    // print_r($args);
    echo "FUNCTION 2";
    echo $args["after"];
}

$hook->add("test_hook", "function_2");

// FUNCTION 3
$hook->add("test_hook", function () {
    echo "FUNCTION 3";
}, 9999);

$hook->run("test_hook", [
    'after' => ' --- '
]);
```

###### Output

```
FUNCTION 3FUNCTION 1 --- FUNCTION 2 ---
```

--------------------------------

### Filter

```php
$filter = new Sfxfilter();

// TEXT FILTER
$filter->add("filtered", "(text) - SFX FILTER SYSTEM");

// FUNCTION FILTER
$filter->add("filtered", function ($data) {
    return $data . ' - (function)';
});

echo $filter->run("filtered", "SFX FILTER SYSTEM");
```

###### Output

```
(text) - SFX FILTER SYSTEM - (function)
```


