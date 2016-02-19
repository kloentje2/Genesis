<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SeoUrlsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SeoUrlsTable Test Case
 */
class SeoUrlsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SeoUrlsTable
     */
    public $SeoUrls;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.seo_urls',
        'app.blogs',
        'app.authors',
        'app.comments',
        'app.users',
        'app.categories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SeoUrls') ? [] : ['className' => 'App\Model\Table\SeoUrlsTable'];
        $this->SeoUrls = TableRegistry::get('SeoUrls', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SeoUrls);

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
