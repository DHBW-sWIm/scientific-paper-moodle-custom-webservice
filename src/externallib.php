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
require_once($CFG->dirroot . "/mod/assign/externallib.php");

class local_spsupman_external extends external_api
{

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_supervisors_parameters()
    {
        return new external_function_parameters(
            array('supervisorid' => new external_value(PARAM_INT, 'Supervisor ID', VALUE_DEFAULT, -1))
        );
    }

    /**
     * Returns welcome message
     * @return string welcome message
     */
    public static function get_supervisors($id = -1)
    {
        global $DB;
        global $USER;

        //Parameter validation
        //REQUIRED
        $params = self::validate_parameters(
            self::get_supervisors_parameters(),
            array('supervisorid' => $supervisorid)
        );

        $rs = $DB->get_records('spsupman_supervisors');
        $retsupervisors = array();

        foreach ($rs as $supervisor) {
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
    public static function get_supervisors_returns()
    {
        return new external_multiple_structure(
            new external_single_structure(
                array(
                    'id' => new external_value(PARAM_INT, 'course id'),
                    'firstname' => new external_value(PARAM_TEXT, 'course short name'),
                    'lastname' => new external_value(PARAM_TEXT, 'category id'),
                    'title' => new external_value(PARAM_TEXT, 'title'),
                    'gender' => new external_value(PARAM_TEXT, 'gender'),
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
            )
        );
    }

        /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_studenthascorpsupervisor_parameters()
    {
        return new external_function_parameters(
            array('assignid' => new external_value(PARAM_TEXT, 'Assignment ID', VALUE_DEFAULT, ''))
        );
    }

    /**
     * Returns welcome message
     * @return string welcome message
     */
    public static function get_studenthascorpsupervisor($assignid = '')
    {
        global $DB;
        global $USER;

        //Parameter validation
        //REQUIRED
        $params = self::validate_parameters(
            self::get_tokendata_parameters(),
            array('logintoken' => $logintoken)
        );

        require_login();
        $userid = $USER->id;

        $result = $DB->get_records('spam_studenthascorpsup', array('studentid' => $userid));

        return $result;
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function get_studenthascorpsupervisor_returns()
    {
        return
        new external_multiple_structure(
            new external_single_structure(
                array(
                    'studentid' => new external_value(PARAM_INT, 'studentid'),
                    'assignmentid' => new external_value(PARAM_INT, 'supervisorid'),
                    'cpsupervisorfirst' => new external_value(PARAM_TEXT, 'cpsupervisorfirst'),
                    'cpsupervisorlast' => new external_value(PARAM_TEXT, 'cpsupervisorlast'),
                    'cpsupervisormail' => new external_value(PARAM_TEXT, 'cpsupervisormail'),
                    'cpsupervisortoken' => new external_value(PARAM_TEXT, 'cpsupervisortoken'),
                    'cpsupervisortokenvalid' => new external_value(PARAM_TEXT, 'cpsupervisortokenvalid')
                )
            )
            );
    }



    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_tokendata_parameters()
    {
        return new external_function_parameters(
            array('logintoken' => new external_value(PARAM_TEXT, 'Login Token', VALUE_DEFAULT, ''))
        );
    }

    /**
     * Returns welcome message
     * @return string welcome message
     */
    public static function get_tokendata($logintoken = '')
    {
        global $DB;
        global $USER;

        //Parameter validation
        //REQUIRED
        $params = self::validate_parameters(
            self::get_tokendata_parameters(),
            array('logintoken' => $logintoken)
        );

        $result = $DB->get_record('spam_studenthascorpsup', array('cpsupervisortoken' => $logintoken), '*');

        return $result;
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function get_tokendata_returns()
    {
        return
            new external_single_structure(
                array(
                    'studentid' => new external_value(PARAM_INT, 'studentid'),
                    'assignmentid' => new external_value(PARAM_INT, 'supervisorid'),
                    'cpsupervisorfirst' => new external_value(PARAM_TEXT, 'cpsupervisorfirst'),
                    'cpsupervisorlast' => new external_value(PARAM_TEXT, 'cpsupervisorlast'),
                    'cpsupervisormail' => new external_value(PARAM_TEXT, 'cpsupervisormail'),
                    'cpsupervisortoken' => new external_value(PARAM_TEXT, 'cpsupervisortoken'),
                    'cpsupervisortokenvalid' => new external_value(PARAM_TEXT, 'cpsupervisortokenvalid')
                )

            );
    }

    //////////////////////////////////////////////////



    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_studenthassupervisor_parameters()
    {
        return new external_function_parameters(
            array('assignid' => new external_value(PARAM_INT, 'Assignment ID', VALUE_DEFAULT, -1))
        );
    }

    /**
     * Returns welcome message
     * @return string welcome message
     */
    public static function get_studenthassupervisor($id = -1)
    {
        global $DB;
        global $USER;

        //Parameter validation
        //REQUIRED
        $params = self::validate_parameters(
            self::get_studenthassupervisor_parameters(),
            array('assignid' => $assignid)
        );

        $rs = $DB->get_recordset('spam_studenthassupervisor');
        $retcombinations = array();

        foreach ($rs as $combination) {
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
    public static function get_studenthassupervisor_returns()
    {
        return new external_multiple_structure(
            new external_single_structure(
                array(
                    'studentid' => new external_value(PARAM_INT, 'studentid'),
                    'supervisorid' => new external_value(PARAM_INT, 'supervisorid'),
                    'assignmentid' => new external_value(PARAM_INT, 'assignmentid'),

                )
            )
        );
    }




    public static function get_token_submissions_parameters()
    {
        return new external_function_parameters(array('token' => new external_value(PARAM_TEXT, 'Custom Token', VALUE_DEFAULT, '')));
    }


    public static function get_token_submissions($token)
    {
        global $DB, $CFG;
        $params = self::validate_parameters(self::get_token_submissions_parameters(), array('token' => $token));

        $result = $DB->get_record('spam_studenthascorpsup', array('cpsupervisortoken' => $token), '*', $strictness = IGNORE_MISSING);

        $unfilteredResult = mod_assign_external::get_submissions(array($result->assignmentid));

        foreach ($unfilteredResult['assignments'][0]['submissions'] as $key => $value) {
            if ($value["userid"] != "$result->studentid") {
                unset($unfilteredResult['assignments'][0]['submissions'][$key]);
            }
        }
        return $unfilteredResult;
    }

    private static function get_plugin_structure()
    {
        return new external_single_structure(
            array(
                'type' => new external_value(PARAM_TEXT, 'submission plugin type'),
                'name' => new external_value(PARAM_TEXT, 'submission plugin name'),
                'fileareas' => new external_multiple_structure(
                    new external_single_structure(
                        array(
                            'area' => new external_value(PARAM_TEXT, 'file area'),
                            'files' => new external_files('files', VALUE_OPTIONAL),
                        )
                    ),
                    'fileareas',
                    VALUE_OPTIONAL
                ),
                'editorfields' => new external_multiple_structure(
                    new external_single_structure(
                        array(
                            'name' => new external_value(PARAM_TEXT, 'field name'),
                            'description' => new external_value(PARAM_RAW, 'field description'),
                            'text' => new external_value(PARAM_RAW, 'field value'),
                            'format' => new external_format_value('text')
                        )
                    ),
                    'editorfields',
                    VALUE_OPTIONAL
                )
            )
        );
    }


    private static function get_submission_structure($required = VALUE_REQUIRED)
    {
        return new external_single_structure(
            array(
                'id' => new external_value(PARAM_INT, 'submission id'),
                'userid' => new external_value(PARAM_INT, 'student id'),
                'attemptnumber' => new external_value(PARAM_INT, 'attempt number'),
                'timecreated' => new external_value(PARAM_INT, 'submission creation time'),
                'timemodified' => new external_value(PARAM_INT, 'submission last modified time'),
                'status' => new external_value(PARAM_TEXT, 'submission status'),
                'groupid' => new external_value(PARAM_INT, 'group id'),
                'assignment' => new external_value(PARAM_INT, 'assignment id', VALUE_OPTIONAL),
                'latest' => new external_value(PARAM_INT, 'latest attempt', VALUE_OPTIONAL),
                'plugins' => new external_multiple_structure(self::get_plugin_structure(), 'plugins', VALUE_OPTIONAL),
                'gradingstatus' => new external_value(PARAM_ALPHANUMEXT, 'Grading status.', VALUE_OPTIONAL),
            ),
            'submission info',
            $required
        );
    }

    /**
     * Creates an assign_submissions external_single_structure
     *
     * @return external_single_structure
     * @since Moodle 2.5
     */
    private static function get_submissions_structure()
    {
        return new external_single_structure(
            array(
                'assignmentid' => new external_value(PARAM_INT, 'assignment id'),
                'submissions' => new external_multiple_structure(self::get_submission_structure())
            )
        );
    }

    /**
     * Describes the get_submissions return value
     *
     * @return external_single_structure
     * @since Moodle 2.5
     */
    public static function get_token_submissions_returns()
    {
        return new external_single_structure(
            array(
                'assignments' => new external_multiple_structure(self::get_submissions_structure(), 'assignment submissions'),
                'warnings' => new external_warnings()
            )
        );
    }
}
