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

class UnityForm extends moodleform {

    public function __construct($id) {
        $this->id = $id;
        parent::__construct();
    }

    //Add elements to form
    public function definition() {
        global $CFG;
       
        $mform = $this->_form; 

        $mform->addElement('hidden',  'id',  '');
        $mform->setType('id', PARAM_NOTAGS);                   
        $mform->setDefault('id', $id);      

        $mform->addElement('header', 'basicinfo', get_string('unitybasicinfo', 'local_opsbasics'));

        // Nome da unidade:
        $mform->addElement('text',  'name',  get_string('unityfullname', 'local_opsbasics'));
        $mform->setType('name', PARAM_NOTAGS);                   
        $mform->setDefault('name', '');   
        
        // Código da unidade:
        $mform->addElement('text',  'unity_code',  get_string('unitycode', 'local_opsbasics'));
        $mform->setType('unity_code', PARAM_NOTAGS);                   
        $mform->setDefault('unity_code', '');   

        // Endereço:
        $mform->addElement('text',  'address',  get_string('unityaddress', 'local_opsbasics'));
        $mform->setType('address', PARAM_NOTAGS);                   
        $mform->setDefault('address', '');   

        // Cidade:
        $mform->addElement('text',  'city',  get_string('unitycity', 'local_opsbasics'));
        $mform->setType('city', PARAM_NOTAGS);                   
        $mform->setDefault('city', '');   

        // Estado (UF):
        $mform->addElement('text',  'state',  get_string('unitystate', 'local_opsbasics'));
        $mform->setType('state', PARAM_NOTAGS);                   
        $mform->setDefault('state', '');   

        // Tamanho da unidade:
        $sizes = ['Intinerante', 'Compacta', 'Mini', 'Mega'];
        $mform->addElement('select',  'size',  get_string('unitysize', 'local_opsbasics'),  $sizes);
        $mform->setType('size', PARAM_NOTAGS);                   
        $mform->setDefault('size', '');   

        $mform->addElement('header', 'unitymailinfo', get_string('unitymailinfo', 'local_opsbasics'));

        // Corpo do e-mail unidade:
        $mform->addElement('text',  'mail_pattern',  get_string('mailpattern', 'local_opsbasics'));
        $mform->setType('mail_pattern', PARAM_NOTAGS);                   
        $mform->setDefault('mail_pattern', '');    

        // E-mail comercial:
        $mform->addElement('text',  'com_email',  get_string('unitycomemail', 'local_opsbasics'));
        $mform->setType('com_email', PARAM_NOTAGS);                   
        $mform->setDefault('com_email', '');       

        // E-mail pedagógico:
        $mform->addElement('text',  'ped_email',  get_string('unitypedemail', 'local_opsbasics'));
        $mform->setType('ped_email', PARAM_NOTAGS);                   
        $mform->setDefault('ped_email', ''); 

        // E-mail da unidade:
        $mform->addElement('text',  'unity_email',  get_string('unityemail', 'local_opsbasics'));
        $mform->setType('unity_email', PARAM_NOTAGS);                   
        $mform->setDefault('unity_email', ''); 

        $mform->addElement('header', 'unitysapinfo', get_string('unitysapinfo', 'local_opsbasics'));

        // Login SAP da unidade:
        $mform->addElement('text',  'sap_login_unity',  get_string('unitysaplogin', 'local_opsbasics'));
        $mform->setType('sap_login_unity', PARAM_NOTAGS);                   
        $mform->setDefault('sap_login_unity', '');    

        // Senha SAP da unidade:
        $mform->addElement('passwordunmask',  'sap_pswd_unity',  get_string('unitysappswd', 'local_opsbasics'));
        $mform->setType('sap_pswd_unity', PARAM_NOTAGS);                   
        $mform->setDefault('sap_pswd_unity', ''); 

        // Login SAP comercial:
        $mform->addElement('text',  'sap_login_com',  get_string('unitysaplogincom', 'local_opsbasics'));
        $mform->setType('sap_login_com', PARAM_NOTAGS);                   
        $mform->setDefault('sap_login_com', ''); 

        // Senha SAP comercial:
        $mform->addElement('passwordunmask',  'sap_pswd_com',  get_string('unitysappswdcom', 'local_opsbasics'));
        $mform->setType('sap_pswd_com', PARAM_NOTAGS);                   
        $mform->setDefault('sap_pswd_com', ''); 

        // Login SAP pedagógico:
        $mform->addElement('text',  'sap_login_ped',  get_string('unitysaploginped', 'local_opsbasics'));
        $mform->setType('sap_login_ped', PARAM_NOTAGS);                   
        $mform->setDefault('sap_login_ped', ''); 

        // Senha SAP pedagógico:
        $mform->addElement('passwordunmask',  'sap_pswd_ped',  get_string('unitysappswdped', 'local_opsbasics'));
        $mform->setType('sap_pswd_ped', PARAM_NOTAGS);                   
        $mform->setDefault('sap_pswd_ped', ''); 

        $mform->addElement('header', 'dateinfo', get_string('unitydateinfo', 'local_opsbasics'));
        
        // Data estimada de operação:
        $mform->addElement('date_time_selector',  'est_ops_date',  get_string('unityestopsdate', 'local_opsbasics'));
        $mform->setType('est_ops_date', PARAM_NOTAGS);                   
        $mform->setDefault('est_ops_date', '');   

        // Data real de operação:
        $mform->addElement('date_time_selector',  'real_ops_date',  get_string('unityrealopsdate', 'local_opsbasics'));
        $mform->setType('real_ops_date', PARAM_NOTAGS);                   
        $mform->setDefault('real_ops_date', '');   

        // Data de criação (create_timestamp):
        $mform->addElement('date_time_selector',  'create_timestamp',  get_string('unitycreatetimestamp', 'local_opsbasics'));
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
