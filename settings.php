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

if ($hassiteconfig) { // needs this condition or there is error on login page

    $ADMIN->add('localplugins', 
                new admin_category('local_opsbasics_api_keys', 
                get_string('pluginname', 'local_opsbasics')));

    $settings = new admin_settingpage('local_opsbasics', get_string('pluginname', 'local_opsbasics'));
    $ADMIN->add('local_opsbasics_api_keys', $settings);

    $settings->add(new admin_setting_heading('local_opsbasics/api_key', '', get_string('configheader', 'local_opsbasics')));

    $settings->add(new admin_setting_configtext('local_opsbasics/caf_api_key', get_string('caftoken', 'local_opsbasics'),
    get_string('desccaftoken', 'local_opsbasics'), false, PARAM_TEXT));
    $settings->add(new admin_setting_configtext('local_opsbasics/caf_domain', get_string('cafdomain', 'local_opsbasics'),
    get_string('descavadomain', 'local_opsbasics'), get_string('defaultcafdomain', 'local_opsbasics'), PARAM_TEXT));

    $settings->add(new admin_setting_configtext('local_opsbasics/ava_api_key', get_string('avatoken', 'local_opsbasics'),
    get_string('descavatoken', 'local_opsbasics'), false, PARAM_TEXT));
    $settings->add(new admin_setting_configtext('local_opsbasics/ava_domain', get_string('avadomain', 'local_opsbasics'),
    get_string('descavadomain', 'local_opsbasics'), get_string('defaultavadomain', 'local_opsbasics'), PARAM_TEXT));

    $settings->add(new admin_setting_configtext('local_opsbasics/std_pswd', get_string('stdpswd', 'local_opsbasics'),
    get_string('descstdpswd', 'local_opsbasics'), false, PARAM_TEXT));
}