<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Provides meta-data about the plugin.
 *
 * @package     local_opsbasics
 * @author      2021 Matheus Delgado <https://github.com/matheusdelg>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../../config.php');

class Client {

    public static function convertTimestamp($data) {
        $ts_convert = new DateTime();
        $ts_convert->setTimestamp(intval($data['create_timestamp']));
        return userdate($ts_convert->getTimestamp());
    }

    public static function getAll() {
        global $DB;

        $response = $DB->get_records('opsbasics_clients');

        return array_values($response);
    }

    public static function getById($id) {
        global $DB;

        return $DB->get_record('opsbasics_clients', ['id' => $id], '*', IGNORE_MISSING);
    }

    public static function save($data) {
        global $DB;

        if (!empty($data->id)) {
            $DB->update_record('opsbasics_clients', $data);
        }
        else {
            $DB->insert_record('opsbasics_clients', $data);
        } 
    }
}