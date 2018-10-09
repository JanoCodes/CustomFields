<?php
/**
 * Jano Ticketing System
 * Copyright (C) 2016-2018 Andrew Ying and other contributors.
 *
 * This file is part of Jano Ticketing System.
 *
 * Jano Ticketing System is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License v3.0 as
 * published by the Free Software Foundation. You must preserve all legal
 * notices and author attributions present.
 *
 * Jano Ticketing System is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Jano\Modules\CustomFields\Facades;

use Illuminate\Config\Repository as Config;
use Illuminate\Support\Facades\Facade;

class CustomFields extends Facade
{
    /**
     * @var array
     */
    private $fields;

    public function __construct(Config $config)
    {
        $this->fields = $config->get('custom-fields::fields');
    }

    /**
     * @return string
     */
    public function generateFields()
    {
        $return = '';

        foreach ($this->fields as $name => $type) {
            $return .= self::generateField($type, $name);
        }

        return $return;
    }

    /**
     * Generate field HTML.
     *
     * @param string $type
     * @param string $name
     * @return \Illuminate\View\View
     */
    public static function generateField($type, $name)
    {
        switch ($type) {
            case 'textarea':
                return view('custom-fields::textarea', $name);
                break;
            default:
                return view('custom-fields::input', [ $name, $type ]);
        }
    }

    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'CustomFields';
    }
}