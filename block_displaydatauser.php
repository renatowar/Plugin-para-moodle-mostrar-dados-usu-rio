<?php
class block_displaydatauser extends block_base {
    public function init(){
        $this->title = "";
    }

    public function has_config() {
        return true;
    }

    public function get_content() {
        global $OUTPUT, $USER, $CFG;

        require_once($CFG->dirroot . '/user/profile/lib.php');
        profile_load_data($USER);

        if($this->content !== null){
            return $this->content;
        }

        $data = new stdClass();
        $dataitems = [
            "emailenable"=>[
                "source"=>"email",
                "eyeenable"=>true
            ],
            "lastloginenable"=>[
                "source"=>"lastlogin",
                "eyeenable"=>false
            ],
            "addressenable"=>[
                "source"=>"address",
                "eyeenable"=>false
            ],
            "cityenable"=>[
                "source"=>"city",
                "eyeenable"=>false
            ],
            "countryenable"=>[
                "source"=>"country",
                "eyeenable"=>false
            ],
            "timezoneenable"=>[
                "source"=>"timezone",
                "eyeenable"=>false
            ],
            "langenable"=>[
                "source"=>"lang",
                "eyeenable"=>false
            ],
            "institutionenable"=>[
                "source"=>"institution",
                "eyeenable"=>false
            ],
            "departmentenable"=>[
                "source"=>"department",
                "eyeenable"=>false
            ],
        ];

        $data->fullname = fullname($USER);
        $data->photo = $OUTPUT->user_picture($USER, array("size" => 50));
        $data->eyeopen = $OUTPUT->image_url("eyeopen","block_displaydatauser");
        $data->eyeclosed = $OUTPUT->image_url("eyeclosed","block_displaydatauser");

        $config = get_config("block_displaydatauser");
        
        $data->items = array();
        foreach($config as $conf => $enabled) {
            $item = new stdClass();
            if(empty($dataitems[$conf])){continue;}
            if(!boolval($enabled)){continue;}

            $source = $dataitems[$conf]["source"];
            $item->fieldname = get_string("displayname".$conf,"block_displaydatauser");
            $item->eyeenable = $dataitems[$conf]["eyeenable"];

            if($conf == "lastloginenable"){
                $value = userdate($USER->$source,"%d de %B %Y às %H:%M ");
                $item->breakline = true;
            }else{
                $value = $USER->$source;
                $item->breakline = false;
            }
            if($conf == "timezoneenable"){
                $value = \core_date::get_user_timezone($USER);
            }
            if($conf == "langenable"){
                $value = get_string('thislanguage', 'langconfig');
            }

            $item->value = $value;
            $item->color = "#ffffff";
            $data->items[] = $item;
        }

        $extrafields = $config->extrafields;
        $fields = explode(";",$extrafields);
        foreach($fields as $field){ 
            if(trim($field) == ""){
                continue;
            }
            $field = explode(",",$field);
            $item = new stdClass();

            $source = "profile_field_".trim($field[0]);
            $item->value = $USER->$source;
            $item->fieldname = trim($field[1]);
            $item->breakline = false;

            $color = array_reduce($field,function($n, $d){
                if(substr_count($d,"#")){return trim($d);}
                return "";
            });
            if($color != ""){
                $item->color = $color;
            }else{
                $item->color = "#ffffff";
            }

            $bool = array_reduce($field,function($n, $d){
                if(trim($d) == "true"){
                    return true;
                }
                if(trim($d) == "false"){
                    return false;
                }
                return $n;
            });

            $item->eyeenable = $bool;

            $data->items[] = $item;
        }
        $data->mydatajson = json_encode($data);

        $this->content = new stdClass();
        $this->content->text = $OUTPUT->render_from_template('block_displaydatauser/content',$data);

        return $this->content;
    }
}