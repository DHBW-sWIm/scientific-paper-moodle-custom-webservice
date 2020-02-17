<?php

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
 * External Web Service Template
 *
 * @package    localwstemplate
 * @copyright  2011 Moodle Pty Ltd (http://moodle.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once($CFG->libdir . "/externallib.php");

class local_spsupman_external extends external_api {

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_supervisors_parameters() {
        return new external_function_parameters(
                array('supervisorid' => new external_value(PARAM_INT, 'Supervisor ID', VALUE_DEFAULT, -1))
        );
    }

    /**
     * Returns welcome message
     * @return string welcome message
     */
    public static function get_supervisors($id = -1) {
        global $DB;
        global $USER;

        //Parameter validation
        //REQUIRED
        $params = self::validate_parameters(self::get_supervisors_parameters(),
                array('supervisorid' => $supervisorid));

        $rs = $DB->get_records('spsupman_supervisors');
        $retsupervisors = array();
        
        foreach($rs as $supervisor){
            $retsupervisor = array();
            $retsupervisor['id'] = $supervisor->id;
            $retsupervisor['firstname'] = $supervisor->firstname;
            $retsupervisor['lastname'] = $supervisor->lastname;
            $retsupervisors[] = $retsupervisor;
        }

      

        return $retsupervisors;
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function get_supervisors_returns() {
        return new external_multiple_structure(
            new external_single_structure(
                    array(
                        'id' => new external_value(PARAM_INT, 'course id'),
                        'firstname' => new external_value(PARAM_TEXT, 'course short name'),
                        'lastname' => new external_value(PARAM_TEXT, 'category id'),
                   
            )
                    ));
    }

        /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_studenthassupervisor_parameters() {
        return new external_function_parameters(
                array('assignid' => new external_value(PARAM_INT, 'Assignment ID', VALUE_DEFAULT, -1))
        );
    }

    /**
     * Returns welcome message
     * @return string welcome message
     */
    public static function get_studenthassupervisor($id = -1) {
        global $DB;
        global $USER;

        //Parameter validation
        //REQUIRED
        $params = self::validate_parameters(self::get_studenthassupervisor_parameters(),
                array('assignid' => $assignid));

        $rs = $DB->get_recordset('spam_studenthassupervisor');
        $retcombinations = array();
        
        foreach($rs as $combination){
            $retcombination = array();
            $retcombination['studentid'] = $combination->studentid;
            $retcombination['supervisorid'] = $combination->supervisorid;
            $retcombination['assignmentid'] = $combination->assignmentid;
            $retcombinations[] = $retcombination;
        }

        $rs->close();

        return $retcombinations;
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function get_studenthassupervisor_returns() {
        return new external_multiple_structure(
            new external_single_structure(
                    array(
                        'studentid' => new external_value(PARAM_INT, 'studentid'),
                        'supervisorid' => new external_value(PARAM_INT, 'supervisorid'),
                        'assignmentid' => new external_value(PARAM_INT, 'assignmentid'),
                   
            )
                    ));
    }



}
