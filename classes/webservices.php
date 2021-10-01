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

 require_once('curl.php');

 class WebService extends curl{

    private string $domain, $token;
    private array $labels;

    public function __construct($domain, $token, $labels) {

        $this->domain = $domain;
        $this->token  = $token;
        $this->labels = $labels;

        parent::__construct();
    }

    private function _validate($fct_name, $params) {

        if ($this->labels[$fct_name] != array_key_first($params))
            throw Exception("Erro na validação do Webservice: 'labels' não coincidem.");
    }

    /**
     * Ajusta o array de parâmetros para a chamada do Webservice.
     * 
     * @param string $label     nome da função do webservice.
     * @param object $data      dados para a chamada.
     * @param string $mode      SINGLE ou MULTIPLE. Ver docs do WS.
     * 
     * @return array            Array adequado de parâmetros.
     */
    private function _params($label, $data, $mode) {
        if ($mode === "SINGLE") {
            $value = $data;
        }
        else {
            $value = [$data];
        }
        return array($label => $value);
    }

    /**
     *  Faz chamada com o cURL do PHP.
     * 
     * @param string $fct_name      Nome da função do WS.
     * @param object $data          Dado para a chamada do WS.
     * @param string $mode          SINGLE ou MULTIPLE.
     * 
     * @return object $response     Objeto PHP com resposta do cURL.
     */ 
    private function _call ($fct_name, $data, $mode) {

        $label  = $this->labels[$fct_name];
        $params = $this->_params($label, $data, $mode);
        $this->_validate($fct_name, $params);

        $url = $this->domain.'/webservice/rest/server.php?wstoken='.
        $this->token.'&wsfunction='.$fct_name;

        $response = $this->post($url, $params);
        return $response;
    }
 }

 class AvaWebService extends WebService {

    public function __construct($domain, $token) {

        // Funções usadas no WebService do AVA:
        $labels = [
            'core_cohort_create_cohorts'        => 'cohorts',
            'core_cohort_delete_cohorts'        => 'cohortids',
            'core_cohort_add_cohort_members'    => 'members',
            'core_cohort_delete_cohort_members' => 'members',
            'core_cohort_update_cohorts'        => 'cohorts',
            'core_user_create_users'            => 'users',
            'core_user_delete_users'            => 'userids',
            'core_webservice_get_site_info'     => 'serviceshortnames',
        ];

        parent::__construct($domain, $token, $labels);
    }

    /**
     * Cria um usuário na base de dados do AVA (via Webservices)
     * 
     * @param object $user      Informações do usuário.
     * @return object           Resposta do servidor.
     */
    public function createUser($user) {

        return $this->_call('core_user_create_users', $user, 'MULTIPLE');
    }
 }

 class CafWebService extends WebService {

    public function __construct() {

        // Funções usadas no WebService do CAF:
        $labels = [
            'core_cohort_create_cohorts'        => 'cohorts',
            'core_cohort_delete_cohorts'        => 'cohortids',
            'core_cohort_add_cohort_members'    => 'members',
            'core_cohort_delete_cohort_members' => 'members',
            'core_cohort_update_cohorts'        => 'cohorts',
            'core_user_create_users'            => 'users',
            'core_user_delete_users'            => 'userids',
            'core_webservice_get_site_info'     => 'serviceshortnames',
        ];

        parent::__construct(get_config('local_opsbasics', 'caf_domain'),
                            get_config('local_opsbasics', 'caf_token'), $labels);
    }

    /**
     * Cria um usuário na base de dados do CAF (via Webservices)
     * 
     * @param object $user      Informações do usuário.
     * @return object           Resposta do servidor.
     */
    public function createUser($user) {

        return $this->_call('core_user_create_users', $user, 'MULTIPLE');
    }    

    
 }