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

require_once("webservices/cafwebservice.php");
require_once("webservices/avawebservice.php");

 class Operations {

    /**
     * Função principal da classe. Organiza as chamadas de métodos necessários para
     * a implantação (criar usuários, cadastrar treinamentos e gerar coortes no AVA).
     * 
     * @param [object] $form_data       Dados recebidos do formulário.
     */
    public static function startImplantation($form_data) {
        global $DB;

        $user_data = $DB->get_record('opsbasics_clients', ['id' => $form_data->client]);

       // if(!isset($user_data->user_id)) {
            $user_response  = Operations::createUser($form_data);
       // }   
        
        $enrol_response = Operations::enrolUser($form_data);
    }

    /**
     * Cria usuário (FRA, PED, COM) no CAF e no AVA.
     */
    public static function createUser($form_data){
        global $DB;

        $user_data  = $DB->get_record('opsbasics_clients', ['id' => $form_data->client]);
        $unity_data = $DB->get_record('opsbasics_unities', ['id' => $form_data->unity]);

        $user = Operations::addUserFields($user_data, $unity_data, $std_pswd);
        
        $caf_ws = new CafWebService();
        $response = $caf_ws->createUser($user);

        $user_id = Operations::getUserIdFromResponse($response);
        $DB->set_field('opsbasics_clients', 'user_id', $user_id, ['id' => $user_data->id]);
    }

    /**
     * O Webservice retorna um XML contendo o id do novo usuário. Este método captura
     * o ID recebido.
     */
    public static function getUserIdFromResponse($response) {
        $xml_response = simplexml_load_string($response);

        return (string) $xml_response->MULTIPLE->SINGLE->children()[0]->VALUE;
    }

    /**
     * Cadastra usuário criado nos treinamentos do CAF
     */
    public static function enrolUser($form_data) {
        global $DB;

        $user_data = $DB->get_record('opsbasics_clients', ['id' => $form_data->client]);

        $courses = [
            (object) [
                'roleid'   => 5, // student: https://stackoverflow.com/questions/52510849/how-to-get-roleid-for-enrol-user-on-moodle-web-service
                'userid'   => intval($user_data->user_id),
                'courseid' => 7
            ],
            (object) [
                'roleid'   => 5, // student: https://stackoverflow.com/questions/52510849/how-to-get-roleid-for-enrol-user-on-moodle-web-service
                'userid'   => intval($user_data->user_id),
                'courseid' => 8
            ],
            (object) [
                'roleid'   => 5, // student: https://stackoverflow.com/questions/52510849/how-to-get-roleid-for-enrol-user-on-moodle-web-service
                'userid'   => intval($user_data->user_id),
                'courseid' => 9
            ]
        ];

        $caf_ws = new CafWebService();
        return $caf_ws->enrolUser($courses);
    }

    /**
     *  Cria um objeto válido PHP para inserir no BD do Moodle (usuários)
     */
    public static function addUserFields($user_data, $unity_data, $std_pswd) {

        $user_name = explode(" ", $user_data->full_name);
        $first_name = $user_name[0];
        array_shift($user_name);
        $last_name = implode(" ", $user_name);

        return (object) [
            'firstname' => $first_name,
            'lastname'  => $last_name,

            'username' => Operations::makeUsername(explode(" ", $user_data->full_name), $unity_data),
            'password' => get_config('local_opsbasics', 'std_pswd'),

            'email' => $user_data->client_mail,
            'city' => $unity_data->city." - ".$unity_data->state,
            'country' => 'BR',

            'customfields' => [
                [
                    'type'  => 'unity_name',
                    'value' => $unity_data->name
                ],
                [
                    'type'  => 'unity_code',
                    'value' => $unity_data->unity_code
                ]
            ]
        ];
    }

    /**
     * Cria o username no padrão:
     * (primeiro nome).(iniciais do restante do nome)_(código da unidade)
     */
    public static function makeUsername($user_name, $unity_data) {
        
        $first_name = strtolower($user_name[0]);
        array_shift($user_name);
        $initials   = ".";

        foreach($user_name as $names) {
            $initials .= strtolower($names[0]);
        }

        return $first_name.$initials."_".$unity_data->unity_code;
    }
 }
