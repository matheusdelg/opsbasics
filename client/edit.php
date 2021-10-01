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
require_once('../classes/clientform.php');
require_once('../classes/client.php');
require_login();


$id = optional_param('id', 0, PARAM_INT);

if(!empty($id)) {
    $param = ['id' => $id];
}

$context = context_system::instance();
$PAGE->set_url('/local/opsbasics/client/view.php', $param);
$PAGE->set_title(get_string('plugintitle', 'local_opsbasics'));
$PAGE->set_heading(get_string('clientheading', 'local_opsbasics'));
$PAGE->set_context($context);

$PAGE->navbar->add(get_string('clientheading', 'local_opsbasics'),
                   get_string('clientediturl', 'local_opsbasics'));

$mform = new ClientForm($id);

if (!empty($id)) {
    $mform->set_data(Client::getById($id));
}

//Form processing and displaying is done here
if ($mform->is_cancelled()) {
    //Handle form cancel operation, if cancel button is present on form
    if (!empty($id)){
        redirect(get_string('clientviewurl', 'local_opsbasics').'?id='.($id+1));
    }
    else {
        redirect(get_string('dashboardurl', 'local_opsbasics'));
    }
} else if ($fromform = $mform->get_data()) {
    //In this case you process validated data. $mform->get_data() returns data posted in form.
    Client::save($fromform);
    redirect(get_string('dashboardurl', 'local_opsbasics'), get_string('clientaddedsuccess', 'local_opsbasics'));      
}

if (has_capability('local/opsbasics:managefranchising', $context)) {
    echo $OUTPUT->header();
    $mform->display();
    echo $OUTPUT->footer();    
}
else {
    print_error(get_string('errornocapability', 'local_opsbasics'));
}