<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Sekati CodeIgniter Asset Helper
 *
 * @package		Assets
 * @author		Kevin MWangi
 * @copyright	Copyright (c) 2013, Sekati LLC.
 * @license		http://www.opensource.org/licenses/mit-license.php
 * @link		http://sekati.com
 * @version		v1.2.7
 * @filesource
 *
 * @usage 		$autoload['config'] = array('asset');
 * 				$autoload['helper'] = array('asset');
 * @example		<img src="<?=asset_url();?>imgs/photo.jpg" />
 * @example		<?=img('photo.jpg')?>
 *
 * @install		Copy config/asset.php to your CI application/config directory
 *				& helpers/asset_helper.php to your application/helpers/ directory.
 * 				Then add both files as autoloads in application/autoload.php:
 *
 *				$autoload['config'] = array('asset');
 * 				$autoload['helper'] = array('asset');
 *
 *				Autoload CodeIgniter's url_helper in `application/config/autoload.php`:
 *				$autoload['helper'] = array('url');
 *
 * @notes		Organized assets in the top level of your CodeIgniter 2.x app:
 *					- assets/
 *						-- css/
 *						-- download/
 *						-- img/
 *						-- js/
 *						-- less/
 *						-- swf/
 *						-- upload/
 *						-- xml/
 *					- application/
 * 						-- config/asset.php
 * 						-- helpers/asset_helper.php
 */

/*
|--------------------------------------------------------------------------
| Custom Asset Paths for asset_helper.php
|--------------------------------------------------------------------------
|
| URL Paths to static assets library
|
*/

$config['asset_path'] 		= 	'assets/';
$config['css_path'] 		= 	'assets/css/';
$config['download_path'] 	= 	'assets/download/';
$config['less_path'] 		= 	'assets/less/';
$config['js_path'] 			= 	'assets/js/';
$config['img_path'] 		= 	'img/';
$config['swf_path'] 		= 	'assets/swf/';
$config['upload_path'] 		= 	'assets/upload/';
$config['xml_path'] 		= 	'assets/xml/';
$config['plugin_path']		=	'assets/plugins/';
$config['files_path']		=	'assets/files/';

$config['css_files']		=	array(
									array('title' => 'site'		,	'file'	=>	'site.css'),
									array('title' => 'nascop'	,	'file'	=>	'nascop.css'),
									array('title' => 'login'	,	'file'	=>	'login/login.css')
								);
$config['js_files']			=	array(
									array('title'	=>	'main'		,	'file'	=>	'main.js'),
									array('title'	=> 	'nascop'	,	'file'	=>	'nascop.js'),
									array('title'	=> 	'login'		,	'file'	=>	'login/login.js'),
									array('title'	=> 	'partner_uploads'		,	'file'	=>	'partner/uploads.js'),
									array('title'	=> 	'partner_equipment'		,	'file'	=>	'partner/equipment.js'),
									array('title'	=> 	'partner_tests'			,	'file'	=>	'partner/tests.js'),
									array('title'	=> 	'partner_reports'		,	'file'	=>	'partner/reports.js'),
									array('title'	=> 	'partner'				,	'file'	=>	'partner/partner.js'),

									array('title'	=> 	'poc_uploads'		,	'file'	=>	'poc/uploads.js'),
									array('title'	=> 	'poc_equipment'		,	'file'	=>	'poc/equipment.js'),
									array('title'	=> 	'poc_tests'			,	'file'	=>	'poc/tests.js'),
									array('title'	=> 	'poc_reports'		,	'file'	=>	'poc/reports.js'),
									array('title'	=> 	'poc_errors'		,	'file'	=>	'poc/errors.js'),
									array('title'	=> 	'poc'				,	'file'	=>	'poc/partner.js'),

									array('title'	=> 	'admin_facilities'		,	'file'	=>	'admin/facilities.js'),
									array('title'	=> 	'admin_equipment'		,	'file'	=>	'admin/equipment.js'),
									array('title'	=> 	'admin_users'			,	'file'	=>	'admin/users.js'),
									array('title'	=> 	'admin_reports'			,	'file'	=>	'admin/reports.js'),
									array('title'	=> 	'admin_settings'		,	'file'	=>	'admin/settings.js'),

									array('title'	=> 	'user_profile'			,	'file'	=>	'user/profile.js')
								);
$config['plugin_js_files']	=	array(
									array('title'	=> 'jquery'				,	'file'	=>	'JQuery/jquery-1.10.2.js'),
									array('title'	=> 'dhtmlx'				,	'file'	=>	'dhtmlx/dhtmlx.js'),
									array('title'	=> 'dhtmlxcommon'		,	'file'	=>	'dhtmlx/dhtmlxcommon.js'),
									array('title'	=> 'dhtmlxcombo'		,	'file'	=>	'dhtmlx/dhtmlxcombo.js'),
									array('title'	=> 'dhtmlxcombo_extra'	,	'file'	=>	'dhtmlx/dhtmlxcombo_extra.js'),
									array('title'	=> 'FusionCharts'		,	'file'	=>	'Fusion/FusionCharts/FusionCharts.js'),
									array('title'	=> 'jquery.fancybox.js?v=2.0.6'	,	'file'	=>	'FancyBox/jquery.fancybox.js?v=2.0.6'),
									array('title'	=> 'fancybox'			,	'file'	=>	'FancyBox/jquery.fancybox.pack.js'),
									array('title'	=> 'calendar'			,	'file'	=>	'Calendar/calendar.js'),
									array('title'	=> 'calendar'			,	'file'	=>	'Calendar/jquery.prettyPhoto.js'),
									array('title'	=> 'bootstrap'			,	'file'	=>	'Bootstrap/js/bootstrap.min.js'),
									array('title'	=> 'dataTables'			,	'file'	=>	'DataTables/media/js/jquery.dataTables.js'),
									array('title'	=> 'jqueryui'			,	'file'	=>	'jquery_ui/js/jquery-ui-1.10.3.custom.js'),
									array('title'	=> 'bootstrap-datepicker'		,	'file'	=>	'bootstrapDatepicker/js/bootstrap-datepicker.js'),
									array('title'	=> 'datepicker'			,	'file'	=>	'datepicker/js/bootstrap-datepicker.js'),
									array('title'	=> 'chartjs'			,	'file'	=>	'Chartjs/Chart.js'),
									array('title'	=> 'highcharts'			,	'file'	=>	'Highcharts/js/highcharts.js'),
									array('title'	=> 'highcharts-adapers'			,	'file'	=>	'Highcharts/js/adapters/prototype-adapter.js'),
									array('title'	=> 'highcharts-adapers'			,	'file'	=>	'Highcharts/js/adapters/mootools-adapter.js'),
									array('title'	=> 'highcharts-adapers'			,	'file'	=>	'Highcharts/js/adapters/standalone-framework-adapers.js'),
									array('title'	=> 'highcharts'			,	'file'	=>	'Highcharts/js/modules/exporting.js'),
									array('title'	=> 'highcharts'			,	'file'	=>	'Highcharts/js/modules/no-data-to-display.js'),
									array('title'	=> 'highchart-canvas'			,	'file'	=>	'Highcharts/js/modules/canvas-tools.js'),
									array('title'	=> 'highcharts_drilldown'		,	'file'	=>	'Highcharts/js/modules/drilldown.js'),
									array('title'	=> 'tree'				,	'file'	=>	'tree/tree.js'),
									array('title'	=> 'ajax_file_uploader'	,	'file'	=>	'ajax_file_uploader/ajaxfileupload.js'),
									array('title'	=> 'highmaps'			,	'file'	=>	'Highmaps/js/modules/map.js'),
									array('title'	=> 'highcharts'			,	'file'	=>	'Highmaps/js/themes/grid.js'),
									array('title'	=> 'highmaps'			,	'file'	=>	'Highmaps/mapdata/tz-all.js')
					
								);	
$config['plugin_css_files']	=	array(
									//array('title' 	=> 	'jquery'			,			'file'	=>	'jquery_ui/css/smoothness/jquery-ui-1.10.3.custom.css'),
									array('title' 	=> 	'dhtmlxcombo'		,			'file'	=>	'dhtmlx/dhtmlxcombo.css'),
									array('title' 	=> 	'fancybox'			,			'file'	=>	'FancyBox/jquery.fancybox.css'),
									array('title' 	=> 	'fancybox'			,			'file'	=>	'FancyBox/jquery.fancybox.css'),
									array('title' 	=> 	'calendar'			,			'file'	=>	'Calendar/calendar.css'),
									array('title' 	=> 	'calendar_css_only'	,			'file'	=>	'Calendar/calendar.css'),
									array('title' 	=> 	'bootstrap'			,			'file'	=>	'Bootstrap/css/bootstrap.min.css'),
									array('title' 	=> 	'bootstrap'			,			'file'	=>	'Bootstrap/css/bootstrap-theme.min.css'),
									array('title' 	=> 	'dataTables'		,			'file'	=>	'DataTables/media/css/jquery.dataTables.css'),
									array('title' 	=> 	'dataTables'		,			'file'	=>	'DataTables/media/css/demo_table.css'),
									array('title' 	=> 	'dataTables'		,			'file'	=>	'DataTables/media/css/demo_page.css'),
									array('title' 	=> 	'dataTables'		,			'file'	=>	'DataTables/media/css/demo_table_jui.css'),
									array('title' 	=> 	'dataTables'		,			'file'	=>	'DataTables/media/css/jquery.dataTables.css'),
									array('title' 	=> 	'dataTables'		,			'file'	=>	'DataTables/media/css/jquery.dataTables_themeroller.css'),
									array('title'	=> 	'jqueryui'			,			'file'	=>	'jquery_ui/css/smoothness/jquery-ui-1.10.3.custom.css'),
									array('title'	=> 	'bootstrap-datepicker'		,	'file'	=>	'bootstrapDatepicker/css/datepicker.css'),
									array('title'	=> 	'datepicker'		,			'file'	=>	'datepicker/css/datepicker.css'),
									array('title'	=> 	'tree'				,			'file'	=>	'tree/tree.css')
								);
$config['plugin_php_files']	=	array(
									array('title'	=> 	'phpexcel'		,			'file'	=>	'PHPExcel/PHPExcel.php'),
									array('title'	=> 	'mpdf'			,			'file'	=>	'pdf/mpdf.php'),
									array('title'	=>	'FusionCharts'	,			'file'	=>	'Fusion/FusionCharts/FusionCharts.php')
								);
/* End of file asset.php */
