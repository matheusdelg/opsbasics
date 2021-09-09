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

    private $domain, $token;

    public function __construct($domain, $token) {
        $this->domain = $domain;
        $this->token  = $token;

        parent::__construct();
    }

    public function validate($fct_name, $params) {

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

        if ($label[$fct_name] != array_key_first($params))
            throw Exception("Erro na validação do Webservice: 'labels' não coincidem.");
    }

    public function paramLabel($fct_name) {
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

        return $labels[$fct_name];
    }

    public function call($fct_name, $data) {

        
        $label = $this->paramLabel($fct_name);
        $params = [$label => [$data]];
        $this->validate($fct_name, $params);

        $url = $this->domain.'/webservice/rest/server.php?wstoken='.
               $this->token.'&wsfunction='.$fct_name;

        $response = $this->post($url, $params);
        return $response;
    }
 }