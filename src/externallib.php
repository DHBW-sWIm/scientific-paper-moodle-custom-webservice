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
            $retsupervisor['title'] = $supervisor->title;
            $retsupervisor['gender'] = $supervisor->gender;
            $retsupervisor['birthdate'] = $supervisor->birthdate;

            $retsupervisor['languages'] = $supervisor->languages;
            $retsupervisor['company'] = $supervisor->company;
            $retsupervisor['address'] = $supervisor->address;
            $retsupervisor['city'] = $supervisor->city;
            $retsupervisor['postalcode'] = $supervisor->postalcode;
            $retsupervisor['phone'] = $supervisor->phone;

            $retsupervisor['email'] = $supervisor->email;
            $retsupervisor['iban'] = $supervisor->iban;
            $retsupervisor['specialisation'] = $supervisor->specialisation;
            $retsupervisor['topictype'] = $supervisor->topictype;
            $retsupervisor['supportperiod'] = $supervisor->supportperiod;
            $retsupervisor['bachelor'] = $supervisor->bachelor;

            $retsupervisor['peryear'] = $supervisor->peryear;
            $retsupervisor['atthesametime'] = $supervisor->atthesametime;
            $retsupervisor['timecreated'] = $supervisor->timecreated;
            $retsupervisor['timemodified'] = $supervisor->timemodified;    
      
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
                        'title' => new external_value(PARAM_TEXT, 'title'),
                        'gender'=> new external_value(PARAM_TEXT, 'gender'),
                        'birthdate' => new external_value(PARAM_TEXT, 'birthdate'),
                        'languages' => new external_value(PARAM_TEXT, 'languages'),
                        'company' => new external_value(PARAM_TEXT, 'company'),
                        'address' => new external_value(PARAM_TEXT, 'address'),
                        'city' => new external_value(PARAM_TEXT, 'city'),
                        'postalcode' => new external_value(PARAM_INT, 'zip'),
                        'phone' => new external_value(PARAM_ALPHANUM, 'phone'),
                        'email' => new external_value(PARAM_TEXT, 'email'),
                        'iban' => new external_value(PARAM_TEXT, 'iban'),
                        'specialisation' => new external_value(PARAM_TEXT, 'specialisation'),
                        'topictype' => new external_value(PARAM_TEXT, 'topictype'),
                        'supportperiod' => new external_value(PARAM_TEXT, 'supportperiod'),
                        'bachelor' => new external_value(PARAM_INT, 'bachelor'),
                        'peryear' => new external_value(PARAM_INT, 'peryear'),
                        'atthesametime' => new external_value(PARAM_INT, 'atthesametime'),
                        'timecreated' => new external_value(PARAM_INT, 'timecreated'),
                        'timemodified' => new external_value(PARAM_INT, 'timemodified')
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
