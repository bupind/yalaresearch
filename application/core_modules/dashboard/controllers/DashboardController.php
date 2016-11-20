<?php (defined('BASEPATH')) || exit('No direct script access allowed');

class DashboardController extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

        self::$viewData['pageInfo'] = (object)[
            'title' => $this->lang->line('dashboard_module')
        ];
	}
	
	public function index()
	{
		$this->load->admintheme('dashboard', self::$viewData);
	}
}
/* End of file 'DashboardController.php' */
/* Location: ./controllers/DashboardController.php */
