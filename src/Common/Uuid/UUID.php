<?php

namespace Recluit\Common\Uuid;

class UUID
{
    public static function generate(): string
    {
        try {
            return \Ramsey\Uuid\Uuid::uuid4()->toString();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}