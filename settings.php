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
 * @package   block_displaydatauser
 * @copyright 2022, Leonardo Ferreira <leonardoferreira@blackbean.tech>
 */



global $USER, $CFG, $DB;
require_once($CFG->dirroot . '/user/profile/lib.php');
require_once($CFG->dirroot . '/blocks/displaydatauser/classes/admin/configtextarea_validada.php');

profile_load_data($USER);

if ($hassiteconfig) {
    if ($ADMIN->fulltree) {
        $settings->add( new admin_setting_configcheckbox(
            "block_displaydatauser/emailenable",
            get_string("emailenable","block_displaydatauser"),
            "",
            1
        ));
        $settings->add( new admin_setting_configcheckbox(
            "block_displaydatauser/lastloginenable",
            get_string("lastloginenable","block_displaydatauser"),
            "",
            1
        ));
        $settings->add( new admin_setting_configcheckbox(
            "block_displaydatauser/addressenable",
            get_string("addressenable","block_displaydatauser"),
            "",
            0
        ));
        $settings->add( new admin_setting_configcheckbox(
            "block_displaydatauser/cityenable",
            get_string("cityenable","block_displaydatauser"),
            "",
            0
        ));
        $settings->add( new admin_setting_configcheckbox(
            "block_displaydatauser/countryenable",
            get_string("countryenable","block_displaydatauser"),
            "",
            0
        ));
        $settings->add( new admin_setting_configcheckbox(
            "block_displaydatauser/timezoneenable",
            get_string("timezoneenable","block_displaydatauser"),
            "",
            0
        ));
        $settings->add( new admin_setting_configcheckbox(
            "block_displaydatauser/langenable",
            get_string("langenable","block_displaydatauser"),
            "",
            0
        ));
        $settings->add( new admin_setting_configcheckbox(
            "block_displaydatauser/institutionenable",
            get_string("institutionenable","block_displaydatauser"),
            "",
            0
        ));
        $settings->add( new admin_setting_configcheckbox(
            "block_displaydatauser/departmentenable",
            get_string("departmentenable","block_displaydatauser"),
            "",
            0
        ));
        $settings->add( new admin_setting_heading(
            "extra",
            get_string("extra","block_displaydatauser"),
            ''
        ));
        $settings->add( new admin_setting_configtextarea_validada(
            "block_displaydatauser/extrafields",
            get_string("extra","block_displaydatauser"),
            get_string("extradescription","block_displaydatauser"),
            ""
        ));
    }
}

