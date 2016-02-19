<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Parsedown;

/**
 * Markdown helper
 */
class MarkdownHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function parse($text)
    {
        $markdown = new Parsedown();
        return $markdown->text($text);
    }

}