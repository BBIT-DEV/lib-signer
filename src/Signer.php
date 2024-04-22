<?php

declare(strict_types=1);

namespace BB;

final readonly class Signer
{
    private const string ALGORITHM = 'sha512';

    public static function sign(array $data, #[\SensitiveParameter] string $key): array
    {
        $data['meta']['signature'] = self::hash($data, $key);

        return $data;
    }

    private static function hash(array $data, #[\SensitiveParameter] string $key): string
    {
        unset($data['meta']['signature']);
        self::rksort($data);

        return hash_hmac(self::ALGORITHM, serialize($data), $key);
    }

    public static function validate(array $data, #[\SensitiveParameter] string $key): bool
    {
        return isset($data['meta']['signature']) && hash_equals(self::hash($data, $key), $data['meta']['signature']);
    }

    /**
     * Recursively sort array by keys in lexicographical order.
     */
    private static function rksort(array &$array): void
    {
        foreach ($array as &$value) {
            if (is_array($value)) {
                self::rksort($value);
            }
        }
        ksort($array, SORT_STRING);
    }
}
