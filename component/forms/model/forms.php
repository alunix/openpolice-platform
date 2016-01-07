<?php
/**
 * Belgian Police Web Platform - Forms Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Forms;
use Nooku\Library;

class ModelForms extends Library\ModelTable
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('published' , 'int');
    }

    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryWhere($query);
        $state = $this->getState();

        if ($state->search) {
            $query->where('tbl.email LIKE :search')->bind(array('search' => '%'.$state->search.'%'));
        }

        if (is_numeric($state->published)) {
            $query->where('tbl.published = :published')->bind(array('published' => $state->published));
        }
    }
}