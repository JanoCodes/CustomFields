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

namespace Jano\Modules\CustomFields\Listeners;

use Jano\Events\AttendeeCreating;
use Illuminate\Config\Repository as Config;

class AttendeeCreatingListener
{
    /**
     * @var array
     */
    private $fields;

    public function __construct(Config $config)
    {
        $this->fields = $config->get('custom-fields::fields');
    }

    public function handle(AttendeeCreating $event)
    {
        $attendee = $event->attendee;

        $data = $event->data['data']['custom_fields'];
        $data = array_only($data, array_keys($this->fields));

        $attendee->custom_fields = $data;
        $attendee->save();
    }
}