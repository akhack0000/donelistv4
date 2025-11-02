<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateDones extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     *
     * @return void
     */
    public function change(): void
    {
        $table = $this->table("dones");
        $table->addColumn("label_id", "integer", [
            "default" => null,
            "limit" => 11,
            "null" => false,
        ]);
        $table->addColumn("message", "text", [
            "default" => null,
            "null" => true,
        ]);
        $table->addColumn("created", "datetime", [
            "default" => null,
            "null" => false,
        ]);
        $table->addColumn("modified", "datetime", [
            "default" => null,
            "null" => false,
        ]);
        $table->addIndex([
            "label_id",
        ], [
            "name" => "BY_LABEL_ID",
            "unique" => false,
        ]);
        $table->addForeignKey("label_id", "labels", "id", [
            "delete" => "CASCADE",
            "update" => "NO_ACTION"
        ]);
        $table->create();
    }
}
