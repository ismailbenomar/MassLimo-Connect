<?php

namespace App\Support;

final readonly class PhoneNumber
{
    public function __construct(private ?string $value) {}

    public function e164(): ?string
    {
        $digits = preg_replace('/[^0-9+]/', '', (string) $this->value);

        if (! is_string($digits) || ! preg_match('/^\+1[2-9][0-9]{9}$/', $digits)) {
            return null;
        }

        return $digits;
    }

    public function tel(): ?string
    {
        return $this->e164();
    }

    public function formatted(): string
    {
        $phone = $this->e164();

        if ($phone === null) {
            return 'Call for local connections';
        }

        return sprintf('(%s) %s-%s', substr($phone, 2, 3), substr($phone, 5, 3), substr($phone, 8, 4));
    }
}
