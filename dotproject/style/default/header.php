<?php /* STYLE/DEFAULT $Id$ */
$dialog = dPgetParam( $_GET, 'dialog', 0 );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta name="Description" content="dotProject Default Style" />
	<meta name="Version" content="<?php echo @$AppUI->getVersion();?>" />
	<meta http-equiv="Content-Type" content="text/html;charset=<?php echo isset( $locale_char_set ) ? $locale_char_set : 'UTF-8';?>" />
	<title><?php echo @dPgetConfig( 'page_title' );?></title>
	<link rel="stylesheet" type="text/css" href="./style/<?php echo $uistyle;?>/main.css" media="all" />
	<style type="text/css" media="all">@import "./style/<?php echo $uistyle;?>/main.css";</style>
	<link rel="shortcut icon" href="./style/<?php echo $uistyle;?>/images/favicon.ico" type="image/ico" />
</head>

<body onload="this.focus();">
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
	<td><table width='100%' cellpadding=3 cellspacing=0 border=0><tr>
	<th background="style/<?php echo $uistyle;?>/images/titlegrad.jpg" class="banner" align="left"><strong><?php echo $dPconfig['page_title'];
	echo "&nbsp;";
	echo $AppUI->getVersion();?></strong></th>
	<th align="right" width='50'><a href='http://www.dotproject.net/'><img src="style/<?php echo $uistyle;?>/images/dp_icon.gif" border=0></a></th>
	</tr></table></td>
</tr>
<?php if (!$dialog) {
	// top navigation menu
	$nav = $AppUI->getMenuModules();
?>
<tr>
	<td class="nav" align="left">
	<table width="100%" cellpadding="3" cellspacing="0" width="100%">
	<tr>
		<td>
		<?php
		$links = array();
		foreach ($nav as $module) {
			if (!getDenyRead( $module['mod_directory'])) {
				$links[] = '<a href="?m='.$module['mod_directory'].'">'.$AppUI->_($module['mod_ui_name']).'</a>';
			}
		}
		echo implode( ' | ', $links );
		echo "\n";
		?>
		</td>
<?php if ( !( $_GET['m'] == 'install' && $dPrunLevel < 2 ) ) {	// allow the installer to run without db ?>
		<form name="frm_new" method=GET action="./index.php">
<?php
	echo '        <td nowrap="nowrap" align="right">';
	$newItem = array( ""=>'- New Item -' );
	$newItem["companies"] = "Company";
	$newItem["contacts"] = "Contact";
	$newItem["calendar"] = "Event";
	$newItem["files"] = "File";
	$newItem["projects"] = "Project";

	echo arraySelect( $newItem, 'm', 'style="font-size:10px" onChange="f=document.frm_new;mod=f.m.options[f.m.selectedIndex].value;if(mod) f.submit();"', '', true);

	echo "</td>\n";
	echo "        <input type=\"hidden\" name=\"a\" value=\"addedit\" />\n";

//build URI string
	if (isset( $company_id )) {
		echo '<input type="hidden" name="company_id" value="'.$company_id.'" />';
	}
	if (isset( $task_id )) {
		echo '<input type="hidden" name="task_parent" value="'.$task_id.'" />';
	}
	if (isset( $file_id )) {
		echo '<input type="hidden" name="file_id" value="'.$file_id.'" />';
	}
?>
		</form>
		</td>
<?php } // END allow the installer to run without db ?>
	</tr>
	</table>
	</td>
</tr>
<tr>
	<td>
		<table cellspacing="0" cellpadding="3" border="0" width="100%">
		<tr>
			<td width="100%"><?php echo $AppUI->_('Welcome')." $AppUI->user_first_name $AppUI->user_last_name"; ?></td>
			<td nowrap="nowrap">
			<?php if ( !( $_GET['m'] == 'install' && $dPrunLevel < 2 ) ) {	// allow the installer to run without db ?>
				<?php echo dPcontextHelp( 'Help' );?> |
				<a href="./index.php?m=admin&a=viewuser&user_id=<?php echo $AppUI->user_id;?>"><?php echo $AppUI->_('My Info');?></a> |
<?php
	if (!getDenyRead( 'calendar' )) {
		$now = new CDate();
?>                              <b><a href="./index.php?m=calendar&a=day_view&date=<?php echo $now->format( FMT_TIMESTAMP_DATE );?>&tab=1"><?php echo $AppUI->_('Todo');?></a></b> |
				<a href="./index.php?m=calendar&a=day_view&date=<?php echo $now->format( FMT_TIMESTAMP_DATE );?>"><?php echo $AppUI->_('Today');?></a> |
<?php } ?>
			<?php } // END allow the installer to run without db ?>
				<a href="./index.php?logout=-1<?php echo ($m=='install') ? '&m=install' : ''; ?>"><?php echo $AppUI->_('Logout');?></a>
			</td>
		</tr>
		</table>
	</td>
</tr>
<?php } // END showMenu ?>
</table>

<table width="100%" cellspacing="0" cellpadding="4" border="0">
<tr>
<td valign="top" align="left" width="98%">
<?php
	echo $AppUI->getMsg();
?>
