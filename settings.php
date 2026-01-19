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

use core\oauth2\rest;
use core_cache\config;
use core_calendar\type_base;
use core_grades\local\gradeitem\itemnumber_mapping;

use function DI\string;
use function PHPSTORM_META\type;

global $USER, $CFG, $DB;
require_once($CFG->dirroot . '/user/profile/lib.php');
profile_load_data($USER);

if (!class_exists('admin_setting_configtextarea_validada')) {
    class admin_setting_configtextarea_validada extends admin_setting_configtextarea {
        public function validate ($value){

            global $USER;
            profile_load_data($USER);

            $fields = explode(",",$value);
            if(count($fields) % 3 != 0){return get_string("extrafieldsexceptions1","block_mostrardadosusuario");}
            
            $datafileds = array();
            for($n = 1; $n <= count($fields) ; $n++){
                
                if($n % 3 != 0){continue;}

                $item = array();
                $item[] = trim($fields[$n - 3]);
                $item[] = trim($fields[$n - 2]);
                $item[] = trim($fields[$n - 1]);
                $datafileds[] = $item;
            }
            foreach($datafileds as $datafiled){
                $source = "profile_field_".$datafiled[0];
                if($datafiled[2] != "true" && $datafiled[2] != "false" ){
                    return get_string("extrafieldsexceptions2","block_mostrardadosusuario");
                }
                if(empty($USER->$source)){
                    return get_string("extrafieldsexceptions3","block_mostrardadosusuario").": ".$datafiled[0];
                };
            }
            return true;
        }
    }
}

if ($hassiteconfig) {
    if ($ADMIN->fulltree) {

        $settings->add( new admin_setting_configcheckbox(
            "block_mostrardadosusuario/emailenable",
            get_string("emailenable","block_mostrardadosusuario"),
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
        ));
        $settings->add( new admin_setting_heading(
            "extra",
            get_string("extra","block_mostrardadosusuario"),
            ''
        ));
        /*
            "fieldname"=>"Telefone",
            "eyeenable"=>true,
        */
        $settings->add( new admin_setting_configtextarea_validada(
            "block_mostrardadosusuario/extrafields",
            get_string("extra","block_mostrardadosusuario"),
            get_string("extradescription","block_mostrardadosusuario"),
            ""
        ));
    }
}

