<?php


namespace Recluit\Postulation\Domain\Postulation;


interface PostulationRepository
{
    public function create(Postulation $postulation): void;

    public function byId(string $id): ?Postulation;

    public function save(Postulation $postulation): void;
}