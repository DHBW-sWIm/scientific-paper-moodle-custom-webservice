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
 * Web service local plugin template external functions and service definitions.
 *
 * @package    localspsupman
 * @copyright  2011 Jerome Mouneyrac
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// We defined the web service functions to install.
$functions = array(
        'local_spsupman_get_supervisors' => array(
                'classname'   => 'local_spsupman_external',
                'methodname'  => 'get_supervisors',
                'classpath'   => 'local/spsupman/externallib.php',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'type'        => 'read',
        ),
        'local_spsupman_get_studenthassupervisor' => array(
                'classname'   => 'local_spsupman_external',
                'methodname'  => 'get_studenthassupervisor',
                'classpath'   => 'local/spsupman/externallib.php',
                'description' => 'Return Student has supervisor Relation',
                'type'        => 'read',
        ),
        'local_spsupman_get_token_submissions' => array(
                'classname'   => 'local_spsupman_external',
                'methodname'  => 'get_token_submissions',
                'classpath'   => 'local/spsupman/externallib.php',
                'description' => 'Return Assign Submissions for specific Corporate Token',
                'type'        => 'read',
        )
        ,
        'local_spsupman_get_tokendata' => array(
                'classname'   => 'local_spsupman_external',
                'methodname'  => 'get_tokendata',
                'classpath'   => 'local/spsupman/externallib.php',
                'description' => 'Return Token Data for specific Corporate Token',
                'type'        => 'read',
        )
        ,
        'local_spsupman_get_studenthascorpsupervisor' => array(
                'classname'   => 'local_spsupman_external',
                'methodname'  => 'get_studenthascorpsupervisor',
                'classpath'   => 'local/spsupman/externallib.php',
                'description' => 'Return Corporate Supervisor Data for User',
                'type'        => 'read',
        )
);

// We define the services to install as pre-build services. A pre-build service is not editable by administrator.
$services = array(
        'local_spsupman_service' => array(
                'functions' => array ('local_spsupman_get_supervisors', 'local_spsupman_get_studenthassupervisor'),
                'requiredcapability' => '', 
                'enabled'=>1,
                'restrictedusers' =>0,
        )
);
