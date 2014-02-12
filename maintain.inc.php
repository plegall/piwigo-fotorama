<?php

defined('PHPWG_ROOT_PATH') or die('Hacking attempt!');

class Fotorama_maintain extends PluginMaintain
{
  private $installed = false;

  private $default_conf = array(
    'allowfullscreen' => 'native',
    'fit' => 'scaledown',
    'transition' => 'slide',
    'shadows' => false,
    'autoplay' => true,
    'stopautoplayontouch' => false,
    'loop' => true,
    'nav' => 'false',
    'fullscreen_nav' => 'false',
  );

  function __construct($plugin_id)
  {
    parent::__construct($plugin_id);
  }

  function install($plugin_version, &$errors=array())
  {
    global $conf;

    if (empty($conf['Fotorama']))
    {
      $conf['Fotorama'] = serialize($this->default_conf);
      conf_update_param('Fotorama', $conf['Fotorama']);
    }
    else
    {
      $new_conf = is_string($conf['Fotorama']) ? unserialize($conf['Fotorama']) : $conf['Fotorama'];

      $conf['Fotorama'] = serialize($new_conf);
      conf_update_param('Fotorama', $conf['Fotorama']);
    }
    
    $this->installed = true;
  }

  function activate($plugin_version, &$errors=array())
  {
    if (!$this->installed)
    {
      $this->install($plugin_version, $errors);
    }
  }

  function deactivate()
  {
  }

  function uninstall()
  {
    conf_delete_param('Fotorama');
  }
}

?>
