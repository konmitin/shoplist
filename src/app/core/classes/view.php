<?php 

class View {
    public function generate($content_view, $temp_view, $data = null) {
        if(is_array($data)) {
            extract($data);
        }
        include "app/views/" . $temp_view;
    }
}