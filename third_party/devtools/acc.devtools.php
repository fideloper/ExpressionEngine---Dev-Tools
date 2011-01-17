<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Dev Tools Accessory class
*
* @package			Dev Tools
* @version			1.0
* @author			Digital Surgeons
* @link				http://www.digitalsurgeons.com
* @license			http://creativecommons.org/licenses/by-sa/3.0/
* @since			1.0
*/
class Devtools_acc {

	var $name			= 'Devtools';
	var $id				= 'devtools';
	var $version		= '1.0';
	var $description	= 'Accessory for development ease.';
	var $sections		= array();

	// --------------------------------------------------------------------

	/**
	* PHP4 Constructor
	*
	* @see	__construct()
	*/
	function Devtools_acc()
	{
		$this->__construct();
	}

	// --------------------------------------------------------------------

	/**
	 * PHP5 Constructor
	 */
	function __construct()
	{
		$this->EE =& get_instance();
	}

	// --------------------------------------------------------------------

	/**
	* Set Sections
	*
	* Set content for the accessory
	*
	* @access	public
	* @return	void
	*/
	function set_sections()
	{
		$actions = $this->EE->db->select()
								->from('actions')
								->order_by('class, method', 'asc')
								->get();
		
		$heading = 'Registered Actions';
		$content = '<ul>';
		$temp = $actions->row()->class;
		foreach($actions->result() as $action) {
			if($temp != $action->class) {
				$content .= '<li>------------------------------------------------</li>';
				$temp = $action->class;
			}
			$content .= '<li><strong>ID:</strong> '.$action->action_id.' <strong>Class:</strong> '.$action->class.' <strong>Method:</strong> '.$action->method.'</li>';
		}
		$content .= '</ul>';		
		
		$this->sections[$heading] = $content;
		/*
		$this->EE->lang->loadfile('low_nospam');

		// Get closed comments
		$this->EE->db->select('COUNT(*) AS num');
		$this->EE->db->from('exp_comments');
		$this->EE->db->where('status', 'c');
		$this->EE->db->where('site_id', $this->EE->config->item('site_id'));
		$query = $this->EE->db->get();
		$result = $query->row_array();

		// Show accessory tab accordingly
		if ( $num = $result['num'] )
		{
			$this->name .= " ($num)";
			$heading = ($num == 1) ? $this->EE->lang->line('closed_comments_one') : sprintf($this->EE->lang->line('closed_comments_many'), $num);
			$content = '<a href="'.BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=low_nospam">'.$this->EE->lang->line('go_moderate').'</a>';
		}
		else
		{
			$heading = $this->EE->lang->line('no_closed_comments');
			$content = '<a href="'.$this->EE->lang->line('donate_url').'">'.$this->EE->lang->line('donate_link').'</a>';
		}

		$this->sections[$heading] = $content;
		*/
	}

	// --------------------------------------------------------------------

}
// END CLASS

/* End of file acc.devtools.php */