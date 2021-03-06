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

require_once('../../config.php');
require_once('classes/unity.php');
require_once('classes/client.php');
require_login();

$pageContext = [
    'plugindescription' => get_string('plugindescription', 'local_opsbasics'),
    'dashboardheading'  => get_string('dashboardheading', 'local_opsbasics'),

    'newclient' => get_string('newclient', 'local_opsbasics'),
    'newclient_description' => get_string('newclient_description', 'local_opsbasics'),
    'clientediturl' => get_string('clientediturl', 'local_opsbasics'),
    'clientviewurl' => get_string('clientviewurl', 'local_opsbasics'),

    'newunity'  => get_string('newunity',  'local_opsbasics'),
    'newunity_description' => get_string('newunity_description', 'local_opsbasics'),
    'unityediturl' => get_string('unityediturl', 'local_opsbasics'),
    'unityviewurl' => get_string('unityviewurl', 'local_opsbasics'),

    'startimp'  => get_string('startimp',  'local_opsbasics'),
    'startimp_description' => get_string('startimp_description', 'local_opsbasics'),
    'startimpurl' => get_string('startimplurl', 'local_opsbasics'),
    'pluginactions' => get_string('pluginactions', 'local_opsbasics'),

    'tooltipview' => get_string('tooltipview', 'local_opsbasics'),
    'tooltipedit' => get_string('tooltipedit', 'local_opsbasics'),
    'tooltipdelete' => get_string('tooltipdelete', 'local_opsbasics'),
    'tooltiponboarding' => get_string('tooltiponboarding', 'local_opsbasics'),
];

$pageContext['unity']  = (array) Unity::getAll();
$pageContext['client'] = (array) Client::getAll();
$context = context_system::instance();

$PAGE->set_url('/local/opsbasics/index.php');
$PAGE->set_title(get_string('plugintitle', 'local_opsbasics'));
$PAGE->set_heading(get_string('dashboardheading', 'local_opsbasics'));
$PAGE->set_context($context);

if (has_capability('local/opsbasics:managefranchising', $context)) {
    echo $OUTPUT->header();
    echo $OUTPUT->render_from_template('local_opsbasics/dashboard', $pageContext);
    echo $OUTPUT->footer();
}
else {
    print_error(get_string('errornocapability', 'local_opsbasics'));
}

