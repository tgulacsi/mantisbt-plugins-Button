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

auth_reauthenticate( );
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );

layout_page_header( lang_get( 'plugin_format_title' ) );

layout_page_begin( 'manage_overview_page.php' );

print_manage_menu( 'manage_plugin_page.php' );
?>

<div class="col-md-12 col-xs-12">
<div class="space-10"></div>
<div class="form-container" >

<form id="formatting-config-form" action="<?php echo plugin_page( 'config_edit' )?>" method="post">
<?php echo form_security_field( 'plugin_button_config_edit' ) ?>

<div class="widget-box widget-color-blue2">
<div class="widget-header widget-header-small">
	<h4 class="widget-title lighter">
		<i class="ace-icon fa fa-video-camera"></i>
		<?php echo plugin_lang_get( 'config' )?>
	</h4>
</div>
<div class="widget-body">
<div class="widget-main no-padding">
<div class="table-responsive">
<table class="table table-bordered table-condensed table-striped">
<tr><th class="category width-40"><?php echo plugin_lang_get( 'buttons' )?></th></tr>
<?php
    $t_buttons = json_decode(plugin_config_get( 'buttons', '{}' ));
    $t_buttons->{''} = '';
    $i = 0;
    foreach( $t_buttons as $t_name => $t_url ) {
?>
<tr>
    <th class="category width-40">
        <input type="text" class="ace" name="names[]" value="<?php echo htmlentities($t_name); ?>" />
    </th>
    <td>
        <input type="text" class="ace" name="urls[]" value="<?php echo htmlentities($t_url); ?>" />
    </td>
    </tr>
<?php
    }
?>

</table>
</div>
</div>
<div class="widget-toolbox padding-8 clearfix">
	<input type="submit" class="btn btn-primary btn-white btn-round" value="<?php echo lang_get( 'change_configuration' )?>" />
</div>
</div>
</div>
</form>
</div>
</div>
