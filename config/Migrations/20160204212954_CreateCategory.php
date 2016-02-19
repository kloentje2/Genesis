<?php
use Migrations\AbstractMigration;

class CreateCategory extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('categories');
        $table->addColumn('name', 'string');
        $table->addColumn('description', 'text');
        $table->create();
    }
}
