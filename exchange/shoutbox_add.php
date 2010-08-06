<?php
/*
 * Project:     EQdkp Shoutbox
 * License:     Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:        http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:       2008
 * Date:        $Date$
 * -----------------------------------------------------------------------
 * @author      $Author$
 * @copyright   2008 Aderyn
 * @link        http://eqdkp-plus.com
 * @package     shoutbox
 * @version     $Rev$
 *
 * $Id$
 */

if (!defined('EQDKP_INC'))
{
  header('HTTP/1.0 404 Not Found');exit;
}


/*+----------------------------------------------------------------------------
  | exchange_shoutbox_add
  +--------------------------------------------------------------------------*/
if (!class_exists('exchange_shoutbox_add'))
{
  class exchange_shoutbox_add
  {
    public $options = array();
    public $type = 'REST';

    function post_shoutbox_add($params, $body)
    {
      global $user, $eqdkp_root_path;

      // parse xml request
      $xml = simplexml_load_string($body);
      $member_id = ($xml && $xml->member_id && is_numeric($xml->member_id)) ? $xml->member_id : -1;
      $text      = ($xml && $xml->text) ? trim($xml->text) : '';
      if ($xml && !empty($text) && $member_id != -1)
      {
        // insert xml text
        include_once($eqdkp_root_path.'plugins/shoutbox/includes/common.php');
        $result = $shoutbox->insertShoutboxEntry($member_id, trim($text));

        // return status
        $response = '<response><result>'.$result.'</result></response>';
      }
      else
      {
        // missing data
        if (empty($text))
          $response = '<response><result>'.$user->lang['sb_missing_text'].'</result></response>';
        else
          $response = '<response><result>'.$user->lang['sb_missing_member_id'].'</result></response>';
      }

      return $response;
    }

  }
}

?>