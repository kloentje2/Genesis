<?php
use Migrations\AbstractMigration;

class CreateBlog extends AbstractMigration
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
        $table = $this->table('blogs');
        $table->addColumn('user_id', 'integer');
        $table->addColumn('title', 'string');
        $table->addColumn('body', 'text');
        $table->addColumn('tags', 'string');
        $table->addColumn('category_id', 'integer');
        $table->addColumn('status', 'string');
        $table->addTimestamps();
        $table->create();
    }
}
