<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

/**
 * Bootstrapper
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Component\Application
 */
class ApplicationBootstrapper extends Library\BootstrapperAbstract
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'priority' => self::PRIORITY_LOW,
        ));

        parent::_initialize($config);
    }

    public function bootstrap()
    {
        $manager = $this->getObjectManager();

        $manager->registerAlias('application'           , 'com:application.dispatcher.http');
        $manager->registerAlias('application.extensions', 'com:application.database.rowset.extensions');
        $manager->registerAlias('application.languages' , 'com:application.database.rowset.languages');
        $manager->registerAlias('application.pages'     , 'com:application.database.rowset.pages');
        $manager->registerAlias('application.modules'   , 'com:application.database.rowset.modules');

        $manager->registerAlias('lib:database.adapter.mysql', 'com:application.database.adapter.mysql');
        $manager->registerAlias('event.dispatcher'          , 'com:debug.event.dispatcher.debug');
    }
}