<?php

declare(strict_types=1);

namespace Doctrine\Migrations\Metadata;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\Migrations\Exception\PlanAlreadyExecuted;
use Doctrine\Migrations\Version\ExecutionResult;
use Doctrine\Migrations\Version\Version;

final class MigrationPlan
{
    /** @var string */
    private $direction;
    /** @var Version */
    private $version;
    /** @var AbstractMigration */
    private $migration;

    /** @var ExecutionResult */
    public $result;

    public function __construct(Version $version, AbstractMigration $migration, string $direction)
    {
        $this->version   = $version;
        $this->migration = $migration;
        $this->direction = $direction;
    }

    public function getVersion() : Version
    {
        return $this->version;
    }

    public function getResult() : ?ExecutionResult
    {
        return $this->result;
    }

    public function markAsExecuted(ExecutionResult $result) : void
    {
        if ($this->result !== null) {
            throw PlanAlreadyExecuted::new();
        }

        $this->result = $result;
    }

    public function getMigration() : AbstractMigration
    {
        return $this->migration;
    }

    public function getDirection() : string
    {
        return $this->direction;
    }
}
