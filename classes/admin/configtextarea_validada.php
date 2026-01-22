<?php

global $CFG;

class admin_setting_configtextarea_validada extends admin_setting_configtextarea {
        public function validate ($value){

            global $USER, $DB;
            profile_load_data($USER);
            $rawsepareteddata = explode(";", $value);
            
            if(empty($value)){return true;}

            foreach($rawsepareteddata as $n => $d){
                $data = explode(",", $d);

                $shortname = $data[0];

                if(!$DB->record_exists("user_info_field",["shortname"=>$shortname])){
                    return get_string("extrafieldsexceptions7","block_displaydatauser")
                    .$shortname.
                    get_string("extrafieldsexceptions2","block_displaydatauser").$n+1;
                }

                if(empty(trim($d))){return true;}
                if(count($data) > 4){
                    return get_string("extrafieldsexceptions1","block_displaydatauser").$n;
                }

                $color = array_reduce($data,function($n, $d){
                    if(substr_count($d,"#")){return trim($d);}
                        return "";
                    });
                if(strlen($color) != 7 && strlen($color) != 0){
                    return get_string("extrafieldsexceptions3","block_displaydatauser")
                    .$color.
                    get_string("extrafieldsexceptions2","block_displaydatauser").$n+1;
                }

                $bool = array_reduce($data,function($n, $d){
                    $d = trim($d);
                    if($n == 0 || $n == 1){
                        $n ++;
                    }else if(substr_count($d,"#") == 0 && $d != "true" && $d != "false"){
                        return $d;
                    }
                    return $n;
                });
                
                if($bool != 2 && $bool != ""){
                    return get_string("extrafieldsexceptions4","block_displaydatauser")
                    .$bool.
                    get_string("extrafieldsexceptions2","block_displaydatauser").$n+1;
                }
                if($bool == ""){
                    return get_string("extrafieldsexceptions5","block_displaydatauser").$n+1;
                }
            }

            $numbersemicolon = substr_count($value, ";");
            $numbercolon = substr_count($value,",");
            if($numbersemicolon > $numbercolon){
                return get_string("extrafieldsexceptions6","block_displaydatauser");
            }

            return true;
        }
    }




