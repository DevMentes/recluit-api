<?php


namespace Recluit\Applications\Domain\Application;


interface ApplicationRepository
{
    public function create(Application $application): void;

    public function byId(string $id): ?Application;

    public function save(Application $application): void;
}