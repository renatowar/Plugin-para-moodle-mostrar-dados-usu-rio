<?php
class block_mostrardadosusuario extends block_base {
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
            "cpfenable"=>[
                "source"=>"profile_field_cpfusuario",
                "eyeenable"=>true
            ],
            "emailenable"=>[
                "source"=>"email",
                "eyeenable"=>true
            ],
            "phoneenable"=>[
                "source"=>"profile_field_telefoneusuario",
                "eyeenable"=>false
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
        $data->eyeopen = $OUTPUT->image_url("olhoaberto","block_mostrardadosusuario");
        $data->eyeclosed = $OUTPUT->image_url("olhofechado","block_mostrardadosusuario");
        
        $config = get_config("block_mostrardadosusuario");
        /*
            Estrutura de dados
            ""[
                ""=>[
                    "fieldname"=>"Telefone",
                    "value"=>"(21) 999999999",
                    "eyeenable"=>true,
                    "breakline"=true
                ]
            ]
        */
        $data->items = array();
        foreach($config as $conf => $enabled) {
            $item = new stdClass();

            if(empty($dataitems[$conf])){continue;}
            if(!boolval($enabled)){continue;}
            $source = $dataitems[$conf]["source"];
            $item->fieldname = get_string("displayname".$conf,"block_mostrardadosusuario");
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

            $data->items[] = $item;
        }
        $data->mydatajson = json_encode($data);
        
        $this->content = new stdClass();
        $this->content->text = $OUTPUT->render_from_template('block_mostrardadosusuario/content',$data);
        
        return $this->content;
    }
}