<?php
use Migrations\AbstractMigration;

class AddCommentsToBlog extends AbstractMigration
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
        $table = $this->table('blog');
        $table->addColumn('comments_enabled', 'boolean');
        $table->update();
    }
}
