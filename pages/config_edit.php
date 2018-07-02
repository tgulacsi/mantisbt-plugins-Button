<?php
# MantisBT - a php based bugtracking system
# Copyright (C) 2002 - 2009  MantisBT Team - mantisbt-dev@lists.sourceforge.net
# MantisBT is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 2 of the License, or
# (at your option) any later version.
#
# MantisBT is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with MantisBT.  If not, see <http://www.gnu.org/licenses/>.

form_security_validate( 'plugin_button_config_edit' );

auth_reauthenticate( );
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );

function notempty($p_key, $p_value) {
    return ( $p_key !== '' && $p_value !== '' );
}

$t_buttons_old = json_encode(json_decode(plugin_config_get( 'buttons', '' )));
$f_names = gpc_get_string_array( 'names', array() );
$f_urls = gpc_get_string_array( 'urls', array() );
$f_buttons = array_combine($f_names, $f_urls);
$f_buttons = array_filter($f_buttons, 'notempty', ARRAY_FILTER_USE_BOTH);
$f_buttons_s = json_encode( $f_buttons );
if( $t_buttons_old != $f_buttons_s ) {
	plugin_config_set( 'buttons', $f_buttons_s );
}

form_security_purge( 'plugin_button_config_edit' );

print_successful_redirect( plugin_page( 'config', true ) );
?>
