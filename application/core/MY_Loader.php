<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class MY_Loader extends CI_Loader {



    public function front($template_name, $vars = array(), $return = FALSE){

        if($return):

            $content  = $this->view('template/header_home', $vars, $return);

            $content .= $this->view($template_name, $vars, $return);

            $content .= $this->view('template/footer_home', $vars, $return);

            return $content;

        else:

            $this->view('template/header_home', $vars);

            $this->view($template_name, $vars);

            $this->view('template/footer_home', $vars);

        endif;

    }  







      public function frontAdmin($template_name, $vars = array(), $return = FALSE){

        if($return):

            $content  = $this->view('template/header_home', $vars, $return);

            $content .= $this->view($template_name, $vars, $return);

            $content .= $this->view('template/footer_home', $vars, $return);

            return $content;

        else:

            $this->view('template/header_home', $vars);

            $this->view($template_name, $vars);

            $this->view('template/footer_home', $vars);

        endif;

    }  



 







    public function admin($template_name, $vars = array(), $return = FALSE){ 

        if($return){

            if($template_name=="admin_dashboard"){

            $content .= $this->view('admin/'.$template_name, $vars, $return);

            } else {

            $content  = $this->view('admin/template/header', $vars, $return);

            $content  = $this->view('admin/template/sidebar', $vars, $return);

            $content .= $this->view('admin/'.$template_name, $vars, $return);

            $content .= $this->view('admin/template/footer', $vars, $return);

            }

            return $content;

         } else {

            if($template_name=="admin_dashboard"){

            $this->view('admin/'.$template_name, $vars);

            } else {

            $this->view('admin/template/header', $vars);

            $this->view('admin/template/sidebar', $vars);

            $this->view('admin/'.$template_name, $vars);

            $this->view('admin/template/footer', $vars);

        };

    }



}

}