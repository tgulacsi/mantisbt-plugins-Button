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
			'buttons' => array('Dokumentáció' => 'http://unowebprd:10800/doku?bug_id={id}&reporter={reporter}&handler={handler}&summary={summary}'),
		);
	}

	function hooks() {
		return array(
			'EVENT_VIEW_BUG_DETAILS' => 'view_bug_buttons',
		);
	}

	function view_bug_buttons($p_event, $p_bug_id, $p_params = NULL) {
		log_event( LOG_EMAIL_RECIPIENT, "event=$p_event bug_id=".var_export($p_bug_id, true)." params=".var_export($p_params, true) );
		require_once( MANTIS_CORE . '/bug_api.php' );
		require_once( MANTIS_CORE . '/user_api.php' );
		$t_bug = bug_row_to_object( bug_cache_row($p_bug_id) );

		$t_needle = array(
			'{id}', 
			'{reporter}', 
			'{handler}', 
			'{summary}'
		);
		$t_repl = array(
			$t_bug->id, 
			urlencode(user_get_username($t_bug->reporter_id)),
			urlencode(user_get_username($t_bug->handler_id)),
			urlencode($t_bug->summary)
		);
		foreach( plugin_config_get( 'buttons', array() ) as $t_name => $t_url ) {
			$t_url = str_replace($t_needle, $t_repl, $t_url);
			print( '<a href="' . $t_url . '">' . $t_name . '</a>' );
		}
		return;
	}

}
