(function () {

    var laroute = (function () {

        var routes = {

            absolute: true,
            rootUrl: 'http://successvoyance.dev',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"api\/user","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":"home","action":"App\Http\Controllers\SiteController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"login","name":"login","action":"App\Http\Controllers\Auth\LoginController@showLoginForm"},{"host":null,"methods":["POST"],"uri":"login","name":null,"action":"App\Http\Controllers\Auth\LoginController@login"},{"host":null,"methods":["POST"],"uri":"logout","name":"logout","action":"App\Http\Controllers\Auth\LoginController@logout"},{"host":null,"methods":["GET","HEAD"],"uri":"register","name":"register","action":"App\Http\Controllers\Auth\RegisterController@showRegistrationForm"},{"host":null,"methods":["POST"],"uri":"register","name":null,"action":"App\Http\Controllers\Auth\RegisterController@register"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset","name":"password.request","action":"App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm"},{"host":null,"methods":["POST"],"uri":"password\/email","name":"password.email","action":"App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset\/{token}","name":"password.reset","action":"App\Http\Controllers\Auth\ResetPasswordController@showResetForm"},{"host":null,"methods":["POST"],"uri":"password\/reset","name":null,"action":"App\Http\Controllers\Auth\ResetPasswordController@reset"},{"host":null,"methods":["GET","HEAD"],"uri":"mon-compte","name":"account","action":"App\Http\Controllers\Auth\AccountController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"mon-compte\/mes-informations","name":"account.edit","action":"App\Http\Controllers\Auth\AccountController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"mon-compte\/mon-mot-de-passe","name":"account.password","action":"App\Http\Controllers\Auth\AccountController@password"},{"host":null,"methods":["GET","HEAD"],"uri":"mon-compte\/supprimer-mon-compte","name":"account.delete","action":"App\Http\Controllers\Auth\AccountController@delete"},{"host":null,"methods":["GET","HEAD"],"uri":"mon-compte\/supprimer-avatar","name":"account.avatar.delete","action":"App\Http\Controllers\Auth\AccountController@removePicture"},{"host":null,"methods":["DELETE"],"uri":"mon-compte\/supprimer-mon-compte","name":"account.destroy","action":"App\Http\Controllers\Auth\AccountController@destroy"},{"host":null,"methods":["POST"],"uri":"mon-compte\/mes-informations","name":"account.update","action":"App\Http\Controllers\Auth\AccountController@update"},{"host":null,"methods":["POST"],"uri":"mon-compte\/mon-mot-de-passe","name":"account.password.update","action":"App\Http\Controllers\Auth\AccountController@updatePassword"},{"host":null,"methods":["POST"],"uri":"mon-compte\/mes-preferences","name":"account.privacy.update","action":"App\Http\Controllers\Auth\AccountController@updatePrivacy"},{"host":null,"methods":["POST"],"uri":"mon-compte\/mon-avatar","name":"account.avatar.update","action":"App\Http\Controllers\Auth\AccountController@updatePicture"},{"host":null,"methods":["GET","HEAD"],"uri":"contact","name":"contact.get","action":"App\Http\Controllers\SiteController@contact"},{"host":null,"methods":["POST"],"uri":"contact","name":"contact.post","action":"App\Http\Controllers\SiteController@postContact"},{"host":null,"methods":["POST"],"uri":"newsletter","name":"newsletter.post","action":"App\Http\Controllers\SiteController@postNewsletter"},{"host":null,"methods":["GET","HEAD"],"uri":"signes-astrologiques","name":"signs.index","action":"App\Http\Controllers\SignsController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"signes-astrologiques\/{sign}","name":"signs.show","action":"App\Http\Controllers\SignsController@sign"},{"host":null,"methods":["GET","HEAD"],"uri":"signes-astrologiques\/{sign}\/horoscopes","name":null,"action":"App\Http\Controllers\SignsController@horoscopes"},{"host":null,"methods":["GET","HEAD"],"uri":"voyance-par-email","name":"telling.email","action":"App\Http\Controllers\TellingController@email"},{"host":null,"methods":["GET","HEAD"],"uri":"voyance-par-telephone","name":"telling.phone","action":"App\Http\Controllers\TellingController@phone"},{"host":null,"methods":["GET","HEAD"],"uri":"forum","name":"forum.index","action":"App\Http\Controllers\Forum\ForumsController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"forum\/{forum}","name":"forum.forum","action":"App\Http\Controllers\Forum\ForumsController@forum"},{"host":null,"methods":["GET","HEAD"],"uri":"forum\/{forum}\/{topic}","name":"forum.topic","action":"App\Http\Controllers\Forum\TopicsController@topic"},{"host":null,"methods":["GET","HEAD"],"uri":"forum\/sujets\/create","name":"sujets.create","action":"App\Http\Controllers\Forum\TopicsController@create"},{"host":null,"methods":["POST"],"uri":"forum\/sujets","name":"sujets.store","action":"App\Http\Controllers\Forum\TopicsController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"forum\/sujets\/{sujet}\/edit","name":"sujets.edit","action":"App\Http\Controllers\Forum\TopicsController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"forum\/sujets\/{sujet}","name":"sujets.update","action":"App\Http\Controllers\Forum\TopicsController@update"},{"host":null,"methods":["DELETE"],"uri":"forum\/sujets\/{sujet}","name":"sujets.destroy","action":"App\Http\Controllers\Forum\TopicsController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"forum\/messages\/create","name":"messages.create","action":"App\Http\Controllers\Forum\PostsController@create"},{"host":null,"methods":["POST"],"uri":"forum\/messages","name":"messages.store","action":"App\Http\Controllers\Forum\PostsController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"forum\/messages\/{message}\/edit","name":"messages.edit","action":"App\Http\Controllers\Forum\PostsController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"forum\/messages\/{message}","name":"messages.update","action":"App\Http\Controllers\Forum\PostsController@update"},{"host":null,"methods":["DELETE"],"uri":"forum\/messages\/{message}","name":"messages.destroy","action":"App\Http\Controllers\Forum\PostsController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"forum\/moderate\/{topic}","name":null,"action":"App\Http\Controllers\Forum\TopicsController@moderate"},{"host":null,"methods":["GET","HEAD"],"uri":"forum\/moderate\/{post}","name":null,"action":"App\Http\Controllers\Forum\PostsController@moderate"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard-123","name":"admin.index","action":"App\Http\Controllers\Admin\DashBoardController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard-123\/roles","name":"admin.roles.index","action":"App\Http\Controllers\Admin\RolesController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard-123\/roles\/create","name":"admin.roles.create","action":"App\Http\Controllers\Admin\RolesController@create"},{"host":null,"methods":["POST"],"uri":"dashboard-123\/roles","name":"admin.roles.store","action":"App\Http\Controllers\Admin\RolesController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard-123\/roles\/{role}\/edit","name":"admin.roles.edit","action":"App\Http\Controllers\Admin\RolesController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"dashboard-123\/roles\/{role}","name":"admin.roles.update","action":"App\Http\Controllers\Admin\RolesController@update"},{"host":null,"methods":["DELETE"],"uri":"dashboard-123\/roles\/{role}","name":"admin.roles.destroy","action":"App\Http\Controllers\Admin\RolesController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard-123\/pages","name":"admin.pages.index","action":"App\Http\Controllers\Admin\PagesController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard-123\/pages\/create","name":"admin.pages.create","action":"App\Http\Controllers\Admin\PagesController@create"},{"host":null,"methods":["POST"],"uri":"dashboard-123\/pages","name":"admin.pages.store","action":"App\Http\Controllers\Admin\PagesController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard-123\/pages\/{page}\/edit","name":"admin.pages.edit","action":"App\Http\Controllers\Admin\PagesController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"dashboard-123\/pages\/{page}","name":"admin.pages.update","action":"App\Http\Controllers\Admin\PagesController@update"},{"host":null,"methods":["DELETE"],"uri":"dashboard-123\/pages\/{page}","name":"admin.pages.destroy","action":"App\Http\Controllers\Admin\PagesController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard-123\/signs","name":"admin.signs.index","action":"App\Http\Controllers\Admin\SignsController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard-123\/signs\/create-sign","name":"admin.signs.create_sign","action":"App\Http\Controllers\Admin\SignsController@createSign"},{"host":null,"methods":["POST"],"uri":"dashboard-123\/signs\/create-sign","name":"admin.signs.store_sign","action":"App\Http\Controllers\Admin\SignsController@storeSign"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard-123\/horoscopes\/create-horoscope","name":"admin.signs.create_horoscope","action":"App\Http\Controllers\Admin\SignsController@createHoroscope"},{"host":null,"methods":["POST"],"uri":"dashboard-123\/horoscopes\/create-horoscope","name":"admin.signs.store_horoscope","action":"App\Http\Controllers\Admin\SignsController@storeHoroscope"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard-123\/signs\/{id}\/edit-sign","name":"admin.signs.edit_sign","action":"App\Http\Controllers\Admin\SignsController@editSign"},{"host":null,"methods":["PATCH"],"uri":"dashboard-123\/signs\/{id}\/edit-sign","name":"admin.signs.update_sign","action":"App\Http\Controllers\Admin\SignsController@updateSign"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard-123\/horoscopes\/{id}\/edit-horoscope","name":"admin.signs.edit_horoscope","action":"App\Http\Controllers\Admin\SignsController@editHoroscope"},{"host":null,"methods":["PATCH"],"uri":"dashboard-123\/horoscopes\/{id}\/edit-horoscope","name":"admin.signs.update_horoscope","action":"App\Http\Controllers\Admin\SignsController@updateHoroscope"},{"host":null,"methods":["DELETE"],"uri":"dashboard-123\/signs\/{id}","name":"admin.signs.destroy_sign","action":"App\Http\Controllers\Admin\SignsController@destroySign"},{"host":null,"methods":["DELETE"],"uri":"dashboard-123\/horoscopes\/{id}","name":"admin.signs.destroy_horoscope","action":"App\Http\Controllers\Admin\SignsController@destroyHoroscope"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard-123\/signs\/{slug}","name":"admin.signs.show","action":"App\Http\Controllers\Admin\SignsController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard-123\/users","name":"admin.users.index","action":"App\Http\Controllers\Admin\UsersController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard-123\/users\/{id}","name":"admin.users.show","action":"App\Http\Controllers\Admin\UsersController@show"},{"host":null,"methods":["PATCH"],"uri":"dashboard-123\/users\/{id}","name":"admin.users.update","action":"App\Http\Controllers\Admin\UsersController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard-123\/management","name":"admin.manager.index","action":"App\Http\Controllers\Admin\ManagerController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard-123\/management\/link\/{id}","name":"admin.manager.link","action":"App\Http\Controllers\Admin\ManagerController@link"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard-123\/management\/links\/create","name":"admin.manager.create_link","action":"App\Http\Controllers\Admin\ManagerController@createLink"},{"host":null,"methods":["POST"],"uri":"dashboard-123\/management\/links\/create","name":"admin.manager.store_link","action":"App\Http\Controllers\Admin\ManagerController@storeLink"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard-123\/management\/links\/{id}\/edit","name":"admin.manager.edit_link","action":"App\Http\Controllers\Admin\ManagerController@editLink"},{"host":null,"methods":["PATCH"],"uri":"dashboard-123\/management\/links\/{id}\/edit","name":"admin.manager.update_link","action":"App\Http\Controllers\Admin\ManagerController@updateLink"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard-123\/management\/order\/{id}\/{asc}\/{type}","name":"admin.manager.order","action":"App\Http\Controllers\Admin\ManagerController@order"},{"host":null,"methods":["DELETE"],"uri":"dashboard-123\/management\/links\/{id}","name":"admin.manager.destroy_link","action":"App\Http\Controllers\Admin\ManagerController@destroyLink"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard-123\/management\/carousels\/create","name":"admin.manager.create_carousel","action":"App\Http\Controllers\Admin\ManagerController@createCarousel"},{"host":null,"methods":["POST"],"uri":"dashboard-123\/management\/carousels\/create","name":"admin.manager.store_carousel","action":"App\Http\Controllers\Admin\ManagerController@storeCarousel"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard-123\/management\/carousels\/{id}\/edit","name":"admin.manager.edit_carousel","action":"App\Http\Controllers\Admin\ManagerController@editCarousel"},{"host":null,"methods":["PATCH"],"uri":"dashboard-123\/management\/carousels\/{id}\/edit","name":"admin.manager.update_carousel","action":"App\Http\Controllers\Admin\ManagerController@updateCarousel"},{"host":null,"methods":["DELETE"],"uri":"dashboard-123\/management\/carousels\/{id}","name":"admin.manager.destroy_carousel","action":"App\Http\Controllers\Admin\ManagerController@destroyCarousel"},{"host":null,"methods":["POST"],"uri":"dashboard-123\/management\/config","name":"admin.manager.update_config","action":"App\Http\Controllers\Admin\ManagerController@updateConfig"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard-123\/pictures\/destroy","name":"admin.pictures.destroy","action":"App\Http\Controllers\Admin\PicturesController@destroy"},{"host":null,"methods":["POST"],"uri":"dashboard-123\/pictures\/upload","name":"admin.pictures.upload","action":"App\Http\Controllers\Admin\PicturesController@upload"},{"host":null,"methods":["GET","HEAD"],"uri":"{slug}","name":"page","action":"App\Http\Controllers\SiteController@page"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                if (this.absolute && this.isOtherHost(route)){
                    return "//" + route.host + "/" + uri + qs;
                }

                return this.getCorrectUrl(uri + qs);
            },

            isOtherHost: function (route){
                return route.host && route.host != window.location.hostname;
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if ( ! this.absolute) {
                    return url;
                }

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

