<?php
# :vim set noet:

define(MANTIS_DIR, dirname(__FILE__) . '/../..' );
define(MANTIS_CORE, MANTIS_DIR . '/core' );

require_once(MANTIS_DIR . '/core.php');
require_once( config_get( 'class_path' ) . 'MantisPlugin.class.php' );

class ButtonPlugin extends MantisPlugin {
	function register() {
		$this->name = 'Button';	# Proper name of plugin
		$this->description = 'Call another web endpoint on a push of a button';	# Short description of the plugin
		$this->page = 'config';		   # Default plugin page

		$this->version = '0.1';	 # Plugin version string
		$this->requires = array(	# Plugin dependencies, array of basename => version pairs
			'MantisCore' => '2.15.0',  #   Should always depend on an appropriate version of MantisBT
			);

		$this->author = 'Tamás Gulácsi';		 # Author/team name
		$this->contact = 'T.Gulacsi@unosoft.hu';		# Author/team e-mail address
		$this->url = 'http://www.unosoft.hu';			# Support webpage
	}

	function config() {
		return array(
			'buttons' => array(),
		);
	}

	function hooks() {
		return array(
			'EVENT_VIEW_BUG_AFTER_DETAILS' => 'view_bug_buttons',
		);
	}

	function view_bug_buttons($p_event, $p_params = NULL) {
		log_event( LOG_EMAIL_RECIPIENT, "event=$p_event params=".var_export($p_params, true) );
		#require_once( MANTIS_CORE . '/database_api.php' );
		#require_once( MANTIS_CORE . '/user_api.php' );
		#$t_query = 'SELECT user_id
		                #FROM {bug_file}
		                #WHERE id=' . db_param();
		#$t_db_result = db_query( $t_query, array( $p_attachment['id'] ), 1 );
		#$t_name =  user_get_name( db_result( $t_db_result ) );
		return ' <span class="underline"><pre>' . $var_export($p_params, true) . '</pre></span>';
	}

}
