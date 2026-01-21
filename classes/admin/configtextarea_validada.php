<?php
class admin_setting_configtextarea_validada extends admin_setting_configtextarea {
        public function validate ($value){

            global $USER;
            profile_load_data($USER);

            $fields = explode(",",$value);
            if(count($fields) % 3 != 0){return get_string("extrafieldsexceptions1","block_displaydatauser");}
            
            $datafileds = array();
            
            foreach($datafileds as $datafiled){
                $source = "profile_field_".$datafiled[0];
                if($datafiled[2] != "true" && $datafiled[2] != "false" ){
                    return get_string("extrafieldsexceptions2","block_displaydatauser");
                }
                if(empty($USER->$source)){
                    return get_string("extrafieldsexceptions3","block_displaydatauser").": ".$datafiled[0];
                }
            }
            return true;
        }
    }




