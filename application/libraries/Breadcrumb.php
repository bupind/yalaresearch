<?php

(defined('BASEPATH')) || exit('No direct script access allowed');

/**
* BreadCrumb Class
*
* This class manages the breadcrumb object.
*/
class Breadcrumb
{
    /**
     *  BreadCrumb Stacks
     */
    private $breadcrumbs = [];

    public function __construct($params = [])
    {
        $this->initialize($params);

        log_message('info', "Breadcrumb Class Initialized");
    }

    public function Initialize($params = [])
    {
        $themeParams = breadcrumbConfig();
    }

    public function append($title, $link)
    {
        if (empty($title) || empty($title)) {
            return;
        }

        $this->breadcrumbs[] = [
            'title'     => $title,
            'link'      => $link
        ];
    }

    public function output()
    {
        if (count($this->breadcrumbs) == 0) {
            return '';
        }

        $breadcrumbs = '';
        foreach ($this->breadcrumbs as $breadcrumb) {
            $breadcrumbs .= $breadcrumb['title'];
        }
        return $breadcrumbs;
    }
}
/* End of file Breadcrumb.php */
/* Location: ./application/libraries/Breadcrumb.php */