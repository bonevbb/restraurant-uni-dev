// /**
//  * Created by Borko on 14.4.2017 г..
//  */
$(document).ready(function () {
    routie('*', function () {
        var url = window.location.href;

        var p = url.split('/');

        if (p[4] !== 'dashboard' && url.indexOf('#') === -1) {
            var controllerAction = url.substr(url.lastIndexOf('/') + 1);
            var pos = controllerAction.indexOf('*');
            var menu = controllerAction;

            if (pos > -1) {
                menu = controllerAction.substr(0, pos);
            }
            // var parentTag = $( 'li.nav_menus' ).parent().parent();
            //
            // console.log(parentTag)
            activeMenu("nav_" + menu.replace('/', '_'));
            //ajaxLoad(controllerAction.replace('*', '/'));
        } else {
            if(url.indexOf('#') > -1){

            }
            else {
                activeMenu("nav_dashboard");
            }
        }
    });
    function activeMenu(nav) {
        $('ul.sidebar-menu li.active').removeClass('active');
        if(nav === 'nav_dashboard') {
            $('ul.sidebar-menu li.' + nav).addClass('active');
        }
        else{
            $('li.' + nav).parent().parent().addClass('active');
        }
    }
});