Signer
----
Package know how to sign request to DIRECT Gate API. Private API Key may be found at BACKOFFICE.

```php
$signed =  \BB\Signer::sign($request, $privateKey); // signed request ready to pass

$isValid = \BB\Signer::validate(['some dummy request'], $privateKey); // bool
if ($isValid) {
    echo 'request has valid signature.';
}
```

**Powered by [baltbit.com](https://baltbit.com/)**
