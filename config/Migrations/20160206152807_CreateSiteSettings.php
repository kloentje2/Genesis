<?php
use Migrations\AbstractMigration;

class CreateSiteSettings extends AbstractMigration
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
        $table = $this->table('site_settings');
        $table->addColumn('setting_name', 'string');
        $table->addColumn('setting_value', 'string');
        $table->create();
    }
}
