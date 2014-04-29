/**
 * Plugin Name: LinkedIN API - Jquery popup
 * Plugin URI: http://www.Teambuktoo.com/contact/
 * Description: LinkedIN Api develped by Khadime Diakhate Teambuktoo
 * Author: SkyVerge
 * Author URI: http://www.Teambuktoo.com
 * Version: 1.0
 *
 * Copyright: (c) 2013 Teambuktoo, Inc. (hello@teambuktoo.com)
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @author    Khadime Diakhate Teambuktoo
 * @category  Custom
 * @copyright Copyright (c) 2014, Teambuktoo, Inc.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

(function(jQuery){
    //  inspired by DISQUS
    jQuery.oauthpopup = function(options)
    {
        options.windowName = options.windowName ||  'ConnectWithOAuth'; // should not include space for IE
        options.windowOptions = options.windowOptions || 'location=0,status=0,width=900,height=500';
        options.callback = options.callback || function(){ window.location.reload(); };
        var that = this;

        that._oauthWindow = window.open(options.path, options.windowName, options.windowOptions);
        that._oauthInterval = window.setInterval(function(){
            if (that._oauthWindow.closed) {
                window.clearInterval(that._oauthInterval);
                options.callback();
            }
        }, 1000);
    };
})(jQuery);
