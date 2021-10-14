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

require_once('webservices.php');

class CafWebService extends WebServices {

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
            'enrol_manual_enrol_users'          => 'enrolments',
        ];

        parent::__construct(get_config('local_opsbasics', 'caf_domain'),
                            get_config('local_opsbasics', 'caf_api_key'), $labels);
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

    public function enrolUser($courses) {
        return $this->_call('enrol_manual_enrol_users', $courses, 'SINGLE');
    }
}