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

require_once("$CFG->libdir/formslib.php");

class ImplantationForm extends moodleform {

    public function definition() {
        global $CFG;
        global $DB;

        $unity_list = [];
        $client_list = [];

        $unity_registers = $DB->get_records('opsbasics_unities');
        $client_registers = $DB->get_records('opsbasics_clients');

        foreach($unity_registers as $unity) {
            $unity_list[$unity->id] = $unity->name;
        }

        foreach($client_registers as $client) {
            $client_list[$client->id] = $client->full_name;
        }

        $mform = $this->_form; 

        $mform->addElement('header', 'implinfo', get_string('implantationinfo', 'local_opsbasics'));

        // Lista de unidades:
        $mform->addElement('select',  'unity',  get_string('selectunity', 'local_opsbasics'), $unity_list);
        $mform->setType('unity', PARAM_NOTAGS);                   
        $mform->addRule('unity', get_string('formrequired', 'local_opsbasics'), 'required', null, 'server');
        
        // Lista de franqueados:
        $mform->addElement('select',  'client',  get_string('selectclient', 'local_opsbasics'), $client_list);
        $mform->setType('client', PARAM_NOTAGS);                   
        $mform->addRule('client', get_string('formrequired', 'local_opsbasics'), 'required', null, 'server');
        
        $this->add_action_buttons(true, get_string('startimp', 'local_opsbasics'));
    }

    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}