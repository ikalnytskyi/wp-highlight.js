<?php
/*
Plugin Name: wp-highlight.js
Plugin URI: http://kalnitsky.org/projects/wp-highlight.js/
Description: This is simple wordpress plugin for <a href="http://softwaremaniacs.org/soft/highlight/en/">highlight.js</a> library. Highlight.js highlights syntax in code examples on blogs, forums and in fact on any web pages. It&acute;s very easy to use because it works automatically: finds blocks of code, detects a language, highlights it.
Version: 0.3.4
Author: Igor Kalnitsky
Author URI: http://kalnitsky.org/
License: 3-clause BSD
*/


$PLUGIN_DIR =  plugins_url() . '/' . dirname(plugin_basename(__FILE__));


init_hljs_textdomain();  # initialize localization functions: _e(), __()

/**
 * Plugin Installation:
 *   - create configuration keys
 */
function hljs_install() {
    add_option('hljs_style', 'default.css');
    add_option('hljs_tab_replace', '    ');
    add_option('hljs_additional_css', "pre.hljs {padding: 0px;}\npre.hljs code {border: 1px solid #ccc; padding: 5px;}");
}
register_activation_hook(__FILE__, 'hljs_install');


/**
 * Plugin Deinstallation
 *   - delete configuration keys
 */
function hljs_deinstall() {
    delete_option('hljs_style');
    delete_option('hljs_tab_replace');
    delete_option('hljs_additional_css');
}
register_deactivation_hook(__FILE__, 'hljs_deinstall');


/**
 * Attach Highlight.js to the current page
 *   - attach highlight.pack.js
 *   - attach colorscheme stylesheet
 */
function hljs_include() {
    global $PLUGIN_DIR;
?>
    <script type="text/javascript" src="<?php echo ($PLUGIN_DIR . '/' . 'highlight.pack.js'); ?>"></script>
    <script type="text/javascript">hljs.initHighlightingOnLoad();</script>
    <link rel="stylesheet" href="<?php echo ($PLUGIN_DIR . '/' . 'styles' . '/' . get_option('hljs_style')); ?>" />
    <style><?php echo get_option('hljs_additional_css'); ?></style>
<?php
}
add_action('wp_head', 'hljs_include');


/**
 * Initialize Localization Functions
 */
function init_hljs_textdomain() {
    if (function_exists('load_plugin_textdomain')) {
        load_plugin_textdomain('hljs', false, dirname(plugin_basename( __FILE__ )) . '/' . 'translations');
    }
}


/**
 * Print Combobox With Styles
 */
function hljs_get_style_list($currentStyle) {
    $styleDir = '..' . '/' . PLUGINDIR . '/' . dirname(plugin_basename(__FILE__)) . '/' . 'styles'; # dirty hack

    if ($dir = opendir($styleDir))
    {
        while($file = readdir($dir))
        {
            if (($file == '.') or ($file == '..'))
                continue;

            if ($file != $currentStyle)
                echo "<option>$file</option>";
            else
                echo "<option selected=\"selected\">$file</option>";
        }
    }
    closedir($dir);
}

/**
 * Add Settings Page to Admin Menu
 */
function hljs_admin_page() {
    if (function_exists('add_submenu_page'))
        add_options_page(__('wp-highlight.js settings'), __('wp-highlight.js'), 'manage_options', 'wp-highlight.js', 'hljs_settings_page');
}
add_action('admin_menu', 'hljs_admin_page');


/**
 * Add Settings link to plugin page
 */
function hljs_add_settings_link($links, $file) {
    if ($file == plugin_basename(__FILE__)) {
      $links[] = '<a href="options-general.php?page=wp-highlight.js">' . __('Settings') . '</a>';
    }
    return $links;
}
add_filter('plugin_action_links', 'hljs_add_settings_link', 10, 2);


/**
 * Add BB-Tag for highlighting.
 *
 *   Usage: [CODE lang=C++]...[/CODE]
 */
function hljs_code_handler($atts, $content) {
    $language = $atts['lang'];
    return "<pre class=\"hljs\"><code class=\"$language\">" . ltrim($content, '\n') . '</code></pre>';
}
add_shortcode('code', 'hljs_code_handler');


/**
 * Highlight.js Settings Page
 */
function hljs_settings_page() {
    global $PLUGIN_DIR;

    if (isset( $_POST['cmd'] ) && $_POST['cmd'] == 'hljs_save')
    {
        update_option('hljs_style', $_POST['hljs_style']);
        update_option('hljs_tab_replace', $_POST['hljs_tab_replace']);
        update_option('hljs_additional_css', $_POST['hljs_additional_css']);

        echo '<p class="info">' . __('All configurations successfully saved...', 'hljs') . '</p>';
    }

    ?>

    <!-- html code of settings page -->

    <div class="wrap">

      <form id="hljs" method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">

        <script type="text/javascript" src="<?php echo ($PLUGIN_DIR . '/' . 'highlight.pack.js'); ?>"></script>
        <script type="text/javascript">hljs.initHighlightingOnLoad();</script>
        <link rel="stylesheet" href="<?php echo ($PLUGIN_DIR . '/' . 'styles' . '/default.css'); ?>" />

        <style>
            .info { padding: 15px; background: #EDEDED; border: 1px solid #333333; font: 14px #333333 Verdana; margin: 30px 10px 0px 0px; }

            .section { padding: 10px; margin: 30px 0 0px; background: #FAFAFA; border: 1px solid #DDDDDD; display: block; }
            input[type="text"] { width: 400px; margin: 10px 0px 0px;}
            textarea {width: 400px; height: 100px; }

            #hljs_style { width: 200px;  margin: 10px 0px 0px;}
            #submit { min-width: 40px; margin-top: 20px; } 

            table.hljs_copyright { font-size: 8px; margin-top: 50px;}
            table.hljs_copyright tr {margin-bottom: 10px;}
            table.hljs_copyright tr td {padding: 5px; font: 12px Sans-Serif; border: 1px solid #DDDDDD;}

        </style>

        <!-- combo box with styles -->
        <p class="section">
          <label for="hljs_style"><?php echo __('Color Scheme:', 'hljs') ?></label><br/>

          <select name="hljs_style" id="hljs_style">
             <?php hljs_get_style_list(get_option('hljs_style')); ?>
          </select>
        </p>

        <!-- text edit : tab replace -->
        <p class="section">
          <label for="hljs_tab_replace"><?php echo __('You can replaces TAB (\x09) characters used for indentation in your code with some fixed number of spaces or with a &lt;span&gt; to set them special styling:', 'hljs') ?></label><br/>
          <input type="text" name="hljs_tab_replace" id="hljs_tab_replace" value="<?php echo get_option('hljs_tab_replace') ?>" />
        </p>

        <!-- text edit : additional css -->
        <p class="section">
          <label for="hljs_additional_css"><?php echo __('You can add some additional CSS rules for better display:', 'hljs') ?></label><br/>
          <textarea type="text" name="hljs_additional_css" id="hljs_additional_css"><?php echo get_option('hljs_additional_css') ?></textarea>
        </p>

        <input type="hidden" name="cmd" value="hljs_save" />
        <input type="submit" name="submit" value="<?php echo __('Save', 'hljs') ?>" id="submit" />

      </form>

        <!-- copyright information -->
            <table border="0" class="hljs_copyright">
                <tr>
                    <td width="120px" align="center"><?php echo __('Author', 'hljs'); ?></td>
                    <td><p><a href="http://kalnitsky.org"><?php echo __('Igor Kalnitsky', 'hljs'); ?></a> &lt;<a href="mailto:igor@kalnitsky.org">igor@kalnitsky.org</a>&gt;</p></td>
                </tr>

                <tr>
                    <td width="120px" align="center"><?php echo __('Plugin Info', 'hljs'); ?></td>
                    <td><p><?php echo __('This is simple wordpress plugin for <a href="http://softwaremaniacs.org/soft/highlight/en/">highlight.js</a> library. <a href="http://softwaremaniacs.org/soft/highlight/en/">Highlight.js</a> highlights syntax in code examples on blogs, forums and in fact on any web pages. It&acute;s very easy to use because it works automatically: finds blocks of code, detects a language, highlights it.', 'hljs'); ?></p></td>
                </tr>

                <tr>
                    <td width="120px" align="center"><?php echo __('Plugin Usage', 'hljs'); ?></td>
                    <td><?php echo __('<p>For code highlighting you should use one of the following ways.</p>
                        
                        <p><strong>The first way</strong> is to use bb-codes:</p>
                        
                        <p><pre><code>[code] this language will be automatically determined [/code]</code></pre></p>
                        <p><pre><code>[code lang="cpp"] highlight the code with certain language [/code]</code></pre></p>
                        
                        <p><strong>The second way</strong> is to use html-tags:</p>
                        
                        <p><pre><code class="html">&lt;pre&gt;&lt;code&gt; this language will be automatically determined &lt;/code&gt;&lt;/pre&gt;</code></pre></p>
                        <p><pre><code class="html">&lt;pre&gt;&lt;code class="html"&gt; highlight the code with certain language &lt;/code&gt;&lt;/pre&gt;</code></pre></p>', 'hljs'); ?></td>
                </tr>

                <tr>
                    <td width="120px" align="center"><?php echo __('Language Support', 'hljs'); ?></td>
                    <td><p>
                        1C, ActionScript, Apache, AppleScript, ASCII Doc, AVR Asm, Axapta, Bash,
                        Brainfuck, Clojure, CMake, CoffeeScript, C++, C#, CSS, Delphi, Diff, Django,
                        D, Dos, Erlang, Erlang REPL, F#, GLSL, Go, HAML, Haskell, HTTP, Ini, Java,
                        JavaScript, JSON, Lasso, Lisp, Lua, Markdown, MatLab, MEL, Nginx, Objective C,
                        Parser3, Perl, PHP, Python profile, Python, R, RenderMan RSL, RenderMan RIB,
                        Ruby, Rules, Rust, Scala, SCSS, Smalltalk, SQL, TeX, Vala, VisualBasic.NET,
                        VBscript, VHDL, HTML/XML, Oxygene, Mathematica
                        </p>
                    </td>
                </tr>

            </table>


    </div>

    <!-- /html code of settings page -->

<?php
}
