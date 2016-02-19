<?php
use Migrations\AbstractMigration;

class AddPrettyUrlToBlogs extends AbstractMigration
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
        $table->addColumn('pretty_url', 'string');
        $table->update();
    }
}
