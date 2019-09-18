<?php


namespace Recluit\Postulation\Domain\Postulation;


interface PostulationRepository
{
    public function create(Postulation $postulation): void;
}