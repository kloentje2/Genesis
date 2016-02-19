<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProfileMessagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProfileMessagesTable Test Case
 */
class ProfileMessagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProfileMessagesTable
     */
    public $ProfileMessages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.profile_messages',
        'app.profiles',
        'app.posters'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ProfileMessages') ? [] : ['className' => 'App\Model\Table\ProfileMessagesTable'];
        $this->ProfileMessages = TableRegistry::get('ProfileMessages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProfileMessages);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
