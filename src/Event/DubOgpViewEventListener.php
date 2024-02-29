<?php

namespace DubOgp\Event;

use BaserCore\Utility\BcUtil;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Utility\Inflector;
use Cake\View\View;

/**
 * DubOgpViewEventListener
 */
class DubOgpViewEventListener extends \BaserCore\Event\BcViewEventListener
{
    /**
     * Events
     * @var string[]
     */
    public $events = [
        'beforeRender'
    ];

    /**
     * Before render
     * @checked
     * @noTodo
     * @unitTest
     */
    public function beforeRender(Event $event)
    {
        /** @var View $view */
        $view = $event->getSubject();
        if (!$view->helpers()->has('DubOgp')) {
            $view->loadHelper('DubOgp.Ogp');
        }
    }

}