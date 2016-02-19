<?php
use Migrations\AbstractMigration;

class CreateSeoUrlsTable extends AbstractMigration
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
        $table = $this->table('seo_urls');
        $table->addColumn('blog_id', 'integer');
        $table->addColumn('url', 'string');
        $table->addtimestamps();
        $table->create();
    }
}
