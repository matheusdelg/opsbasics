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

//$defined('MOODLE_INTERNAL') || die();


require_once('../../../config.php');
require_once("$CFG->libdir/formslib.php");

class ClientForm extends moodleform {

    public function __construct($id) {
        $this->id = $id;
        parent::__construct();
    }

    //Add elements to form
    public function definition() {
        global $CFG;
       
        $mform = $this->_form; 

        $mform->addElement('header', 'clientinfo', get_string('clientinfo', 'local_opsbasics'));

        $mform->addElement('hidden',  'id',  'ID');
        $mform->setType('id', PARAM_NOTAGS);                   
        $mform->setDefault('id', $id);      

        // Nome completo (full_name):
        $mform->addElement('text',  'full_name',  get_string('clientfullname', 'local_opsbasics'));
        $mform->setType('full_name', PARAM_NOTAGS);                   
        $mform->setDefault('full_name', '');   
        
        // E-mail pessoal (personal_email):
        $mform->addElement('text',  'personal_email',  get_string('clientpersonalemail', 'local_opsbasics'));
        $mform->setType('personal_email', PARAM_NOTAGS);                   
        $mform->setDefault('personal_email', '');   

        // Telefone (phone_number):
        $mform->addElement('text',  'phone_number',  get_string('clientphonenumber', 'local_opsbasics'));
        $mform->setType('phone_number', PARAM_NOTAGS);                   
        $mform->setDefault('phone_number', '');   

        // E-mail do franqueado (client_mail):
        $mform->addElement('text',  'client_mail',  get_string('clientmail', 'local_opsbasics'));
        $mform->setType('client_mail', PARAM_NOTAGS);                   
        $mform->setDefault('client_mail', '');   

        // Data de criação (create_timestamp):
        $mform->addElement('date_time_selector',  'create_timestamp',  get_string('clientcreatetimestamp', 'local_opsbasics'));
        $mform->setType('create_timestamp', PARAM_NOTAGS);                   
        $mform->setDefault('create_timestamp', '');   
        $mform->disabledIf('create_timestamp', '');

        $this->add_action_buttons();
    }

    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}
