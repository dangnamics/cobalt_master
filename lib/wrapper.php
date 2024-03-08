<?php
/**
 * Theme wrapper
 *
 * @link http://cobalt.io/an-introduction-to-the-cobalt-theme-wrapper/
 * @link http://scribu.net/wordpress/theme-wrappers.html
 */
function cobalt_template_path() {
  return Cobalt_Wrapping::$main_template;
}

function cobalt_sidebar_path() {
  return new Cobalt_Wrapping('templates/sidebar.php');
}

class Cobalt_Wrapping {
  // Stores the full path to the main template file
  public static $main_template;

  // basename of template file
  public $slug;

  // array of templates
  public $templates;

  // Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
  static $base;

  public function __construct($template = 'base.php') {
    $this->slug = basename($template, '.php');
    $this->templates = array($template);

    if (self::$base) {
      $str = substr($template, 0, -4);
      array_unshift($this->templates, sprintf($str . '-%s.php', self::$base));
    }
  }

  public function __toString() {
    $this->templates = apply_filters('cobalt/wrap_' . $this->slug, $this->templates);
    return locate_template($this->templates);
  }

  static function wrap($main) {
    // Check for other filters returning null
    if (!is_string($main)) {
      return $main;
    }

    self::$main_template = $main;
    self::$base = basename(self::$main_template, '.php');

    if (self::$base === 'index') {
      self::$base = false;
    }

    return new Cobalt_Wrapping();
  }
}
add_filter('template_include', array('Cobalt_Wrapping', 'wrap'), 99);
