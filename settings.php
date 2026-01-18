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
 * Languages configuration for the block_upload_users plugin.
 *
 * @package   block_mostrardadosusuario
 * @copyright 2022, Leonardo Ferreira <leonardoferreira@blackbean.tech>
 */

use core_cache\config;

global $USER, $CFG, $DB;

require_once($CFG->dirroot . '/user/profile/lib.php');
profile_load_custom_fields($USER);

if ($hassiteconfig) {
    if ($ADMIN->fulltree) {

        /*$settings->add( new admin_setting_configcheckbox(
            "block_mostrardadosusuario/cpfenable",
            get_string("cpfenable","block_mostrardadosusuario"),
            "",
            1
        ));
        $settings->add( new admin_setting_configcheckbox(
            "block_mostrardadosusuario/emailenable",
            get_string("emailenable","block_mostrardadosusuario"),
            "",
            1
        ));
        $settings->add( new admin_setting_configcheckbox(
            "block_mostrardadosusuario/phoneenable",
            get_string("phoneenable","block_mostrardadosusuario"),
            "",
            1
        ));
        $settings->add( new admin_setting_configcheckbox(
            "block_mostrardadosusuario/lastloginenable",
            get_string("lastloginenable","block_mostrardadosusuario"),
            "",
            1
        ));
        $settings->add( new admin_setting_configcheckbox(
            "block_mostrardadosusuario/addressenable",
            get_string("addressenable","block_mostrardadosusuario"),
            "",
            0
        ));
        $settings->add( new admin_setting_configcheckbox(
            "block_mostrardadosusuario/cityenable",
            get_string("cityenable","block_mostrardadosusuario"),
            "",
            0
        ));
        $settings->add( new admin_setting_configcheckbox(
            "block_mostrardadosusuario/countryenable",
            get_string("countryenable","block_mostrardadosusuario"),
            "",
            0
        ));
        $settings->add( new admin_setting_configcheckbox(
            "block_mostrardadosusuario/timezoneenable",
            get_string("timezoneenable","block_mostrardadosusuario"),
            "",
            0
        ));
        $settings->add( new admin_setting_configcheckbox(
            "block_mostrardadosusuario/langenable",
            get_string("langenable","block_mostrardadosusuario"),
            "",
            0
        ));
        $settings->add( new admin_setting_configcheckbox(
            "block_mostrardadosusuario/institutionenable",
            get_string("institutionenable","block_mostrardadosusuario"),
            "",
            0
        ));
        $settings->add( new admin_setting_configcheckbox(
            "block_mostrardadosusuario/departmentenable",
            get_string("departmentenable","block_mostrardadosusuario"),
            "",
            0
        ));*/
        /*
            shortname
            name
        */
            $settings->add(new admin_setting_heading(
            'block_mostrardadosusuario/divisor_linha',
            'asdasdasdasdasdasd', 
            'sdasdasd'
        ));
        $campos = $DB->get_records('user_info_field', null, 'sortorder ASC');

        foreach($campos as $conf => $name){
        }
    }
}

