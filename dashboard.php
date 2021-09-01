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
require_login();

$PAGE->set_url('/local/opsbasics/dashboard.php');
$PAGE->set_title(get_string('plugintitle', 'local_opsbasics'));
$PAGE->set_heading(get_string('dashboardheading', 'local_opsbasics'));
$PAGE->set_context(context_system::instance());

/*
$pageContext = [
    'newclient_btn' => get_string('newclient', 'local_opsbasics'),
    'newunity_btn'  => get_string('newunity',  'local_opsbasics'),
    'startimp_btn'  => get_string('startimp',  'local_opsbasics'),
];
*/
echo $OUTPUT->header();
//echo $OUTPUT->render_from_template('local_opsbasic/dashboard', $pageContext);
echo $OUTPUT->footer();