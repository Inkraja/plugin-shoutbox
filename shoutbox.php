<?php
/*
 * Project:     EQdkp Shoutbox
 * License:     Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:        http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:       2008
 * Date:        $Date:$
 * -----------------------------------------------------------------------
 * @author      $Author:$
 * @copyright   2008 Aderyn
 * @link        http://eqdkp-plus.com
 * @package     shoutbox
 * @version     $Rev:$
 *
 * $Id:$
 */

define('EQDKP_INC', true);
$eqdkp_root_path = './../../';
include_once('includes/common.php');


// -- Insert? ---------------------------------------------
if (isset($_POST['sb_text']) && ($_POST['sb_text'] != '') &&
    isset($_POST['sb_member_id']) && ($_POST['sb_member_id'] != ''))
{
  // insert
  $shoutbox->insertShoutboxEntry($_POST['sb_member_id'], $_POST['sb_text']);
}
// -- Delete? ---------------------------------------------
else if (isset($_GET['shoutbox_delete']))
{
  // delete
  $shoutbox->deleteShoutboxEntry($_GET['shoutbox_delete']);
}


// -- Output ----------------------------------------------
echo $shoutbox->getContent($_REQUEST['sb_root'], true);

?>
