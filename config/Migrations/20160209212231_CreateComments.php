<?php
use Migrations\AbstractMigration;

class CreateComments extends AbstractMigration
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
        $table = $this->table('comments');
        $table->addColumn('user_id', 'integer');
        $table->addColumn('blog_id', 'integer');
        $table->addColumn('body', 'string');
        $table->create();
    }
}
