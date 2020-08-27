    var Ziggy = {
        namedRoutes: {"welcome":{"uri":"\/","methods":["GET","HEAD"],"domain":null},"about":{"uri":"about","methods":["GET","HEAD"],"domain":null},"privacidad":{"uri":"privacidad","methods":["GET","HEAD"],"domain":null},"preguntas.frecuentes":{"uri":"frecuentes","methods":["GET","HEAD"],"domain":null},"installApp":{"uri":"installApp","methods":["GET","HEAD"],"domain":null},"login":{"uri":"login","methods":["GET","HEAD"],"domain":null},"logout":{"uri":"logout","methods":["POST"],"domain":null},"password.request":{"uri":"password\/reset","methods":["GET","HEAD"],"domain":null},"password.email":{"uri":"password\/email","methods":["POST"],"domain":null},"password.reset":{"uri":"password\/reset\/{token}","methods":["GET","HEAD"],"domain":null},"password.update":{"uri":"password\/reset","methods":["POST"],"domain":null},"home":{"uri":"home","methods":["GET","HEAD"],"domain":null},"specialties.index":{"uri":"admin\/specialties","methods":["GET","HEAD"],"domain":null},"specialties.create":{"uri":"admin\/specialties\/create","methods":["GET","HEAD"],"domain":null},"specialties.store":{"uri":"admin\/specialties","methods":["POST"],"domain":null},"specialties.show":{"uri":"admin\/specialties\/{specialty}","methods":["GET","HEAD"],"domain":null},"specialties.edit":{"uri":"admin\/specialties\/{specialty}\/edit","methods":["GET","HEAD"],"domain":null},"specialties.update":{"uri":"admin\/specialties\/{specialty}","methods":["PUT","PATCH"],"domain":null},"specialties.destroy":{"uri":"admin\/specialties\/{specialty}","methods":["DELETE"],"domain":null},"subscriptions.index":{"uri":"admin\/subscriptions","methods":["GET","HEAD"],"domain":null},"subscriptions.create":{"uri":"admin\/subscriptions\/create","methods":["GET","HEAD"],"domain":null},"subscriptions.store":{"uri":"admin\/subscriptions","methods":["POST"],"domain":null},"subscriptions.show":{"uri":"admin\/subscriptions\/{subscription}","methods":["GET","HEAD"],"domain":null},"subscriptions.edit":{"uri":"admin\/subscriptions\/{subscription}\/edit","methods":["GET","HEAD"],"domain":null},"subscriptions.update":{"uri":"admin\/subscriptions\/{subscription}","methods":["PUT","PATCH"],"domain":null},"subscriptions.destroy":{"uri":"admin\/subscriptions\/{subscription}","methods":["DELETE"],"domain":null},"doctors.index":{"uri":"admin\/doctors","methods":["GET","HEAD"],"domain":null},"doctors.create":{"uri":"admin\/doctors\/create","methods":["GET","HEAD"],"domain":null},"doctors.store":{"uri":"admin\/doctors","methods":["POST"],"domain":null},"doctors.show":{"uri":"admin\/doctors\/{doctor}","methods":["GET","HEAD"],"domain":null},"doctors.edit":{"uri":"admin\/doctors\/{doctor}\/edit","methods":["GET","HEAD"],"domain":null},"doctors.update":{"uri":"admin\/doctors\/{doctor}","methods":["PUT","PATCH"],"domain":null},"doctors.destroy":{"uri":"admin\/doctors\/{doctor}","methods":["DELETE"],"domain":null},"categories.index":{"uri":"admin\/categories","methods":["GET","HEAD"],"domain":null},"categories.create":{"uri":"admin\/categories\/create","methods":["GET","HEAD"],"domain":null},"categories.store":{"uri":"admin\/categories","methods":["POST"],"domain":null},"categories.show":{"uri":"admin\/categories\/{category}","methods":["GET","HEAD"],"domain":null},"categories.edit":{"uri":"admin\/categories\/{category}\/edit","methods":["GET","HEAD"],"domain":null},"categories.update":{"uri":"admin\/categories\/{category}","methods":["PUT","PATCH"],"domain":null},"categories.destroy":{"uri":"admin\/categories\/{category}","methods":["DELETE"],"domain":null},"orders.index":{"uri":"admin\/orders","methods":["GET","HEAD"],"domain":null},"orders.create":{"uri":"admin\/orders\/create","methods":["GET","HEAD"],"domain":null},"orders.store":{"uri":"admin\/orders","methods":["POST"],"domain":null},"orders.show":{"uri":"admin\/orders\/{order}","methods":["GET","HEAD"],"domain":null},"orders.edit":{"uri":"admin\/orders\/{order}\/edit","methods":["GET","HEAD"],"domain":null},"orders.update":{"uri":"admin\/orders\/{order}","methods":["PUT","PATCH"],"domain":null},"orders.destroy":{"uri":"admin\/orders\/{order}","methods":["DELETE"],"domain":null},"products.index":{"uri":"admin\/products","methods":["GET","HEAD"],"domain":null},"products.create":{"uri":"admin\/products\/create","methods":["GET","HEAD"],"domain":null},"products.store":{"uri":"admin\/products","methods":["POST"],"domain":null},"products.show":{"uri":"admin\/products\/{productId}","methods":["GET","HEAD"],"domain":null},"products.edit":{"uri":"admin\/products\/{product}\/edit","methods":["GET","HEAD"],"domain":null},"products.update":{"uri":"admin\/products\/{product}","methods":["PUT","PATCH"],"domain":null},"products.destroy":{"uri":"admin\/products\/{product}","methods":["DELETE"],"domain":null},"roles.index":{"uri":"admin\/roles","methods":["GET","HEAD"],"domain":null},"roles.create":{"uri":"admin\/roles\/create","methods":["GET","HEAD"],"domain":null},"roles.store":{"uri":"admin\/roles","methods":["POST"],"domain":null},"roles.show":{"uri":"admin\/roles\/{role}","methods":["GET","HEAD"],"domain":null},"roles.edit":{"uri":"admin\/roles\/{role}\/edit","methods":["GET","HEAD"],"domain":null},"roles.update":{"uri":"admin\/roles\/{role}","methods":["PUT","PATCH"],"domain":null},"roles.destroy":{"uri":"admin\/roles\/{role}","methods":["DELETE"],"domain":null},"profits.index":{"uri":"admin\/profits","methods":["GET","HEAD"],"domain":null},"profits.create":{"uri":"admin\/profits\/create","methods":["GET","HEAD"],"domain":null},"profits.store":{"uri":"admin\/profits","methods":["POST"],"domain":null},"profits.show":{"uri":"admin\/profits\/{profit}","methods":["GET","HEAD"],"domain":null},"profits.edit":{"uri":"admin\/profits\/{profit}\/edit","methods":["GET","HEAD"],"domain":null},"profits.update":{"uri":"admin\/profits\/{profit}","methods":["PUT","PATCH"],"domain":null},"profits.destroy":{"uri":"admin\/profits\/{profit}","methods":["DELETE"],"domain":null},"interests.index":{"uri":"admin\/interests","methods":["GET","HEAD"],"domain":null},"interests.create":{"uri":"admin\/interests\/create","methods":["GET","HEAD"],"domain":null},"interests.store":{"uri":"admin\/interests","methods":["POST"],"domain":null},"interests.show":{"uri":"admin\/interests\/{interest}","methods":["GET","HEAD"],"domain":null},"interests.edit":{"uri":"admin\/interests\/{interest}\/edit","methods":["GET","HEAD"],"domain":null},"interests.update":{"uri":"admin\/interests\/{interest}","methods":["PUT","PATCH"],"domain":null},"interests.destroy":{"uri":"admin\/interests\/{interest}","methods":["DELETE"],"domain":null},"payment_methods.index":{"uri":"admin\/payment_methods","methods":["GET","HEAD"],"domain":null},"payment_methods.create":{"uri":"admin\/payment_methods\/create","methods":["GET","HEAD"],"domain":null},"payment_methods.store":{"uri":"admin\/payment_methods","methods":["POST"],"domain":null},"payment_methods.edit":{"uri":"admin\/payment_methods\/{payment_method}\/edit","methods":["GET","HEAD"],"domain":null},"payment_methods.update":{"uri":"admin\/payment_methods\/{payment_method}","methods":["PUT","PATCH"],"domain":null},"payment_methods.destroy":{"uri":"admin\/payment_methods\/{payment_method}","methods":["DELETE"],"domain":null},"users.index":{"uri":"admin\/users","methods":["GET","HEAD"],"domain":null},"users.show":{"uri":"admin\/users\/{user}","methods":["GET","HEAD"],"domain":null},"users.edit":{"uri":"admin\/users\/{user}\/edit","methods":["GET","HEAD"],"domain":null},"users.update":{"uri":"admin\/users\/{user}","methods":["PUT","PATCH"],"domain":null},"users.destroy":{"uri":"admin\/users\/{user}","methods":["DELETE"],"domain":null},"shopping_cart.cart":{"uri":"carrito","methods":["GET","HEAD"],"domain":null},"shopping_cart.buy":{"uri":"carrito\/{product}","methods":["GET","HEAD"],"domain":null},"shopping_cart.products":{"uri":"carrito\/productos","methods":["GET","HEAD"],"domain":null},"shopping_cart.store":{"uri":"carritostore","methods":["POST"],"domain":null},"shopping_cart.show":{"uri":"carritofin","methods":["GET","HEAD"],"domain":null},"iniciar.pago":{"uri":"pagar","methods":["POST"],"domain":null},"shopping_cart.index":{"uri":"shoppingcart","methods":["GET","HEAD"],"domain":null},"shopping_cart.destroy":{"uri":"shopping_cart_destroy\/{id}","methods":["DELETE"],"domain":null},"getProducts":{"uri":"getProducts\/{id}","methods":["POST"],"domain":null},"out_shopping_cart.destroy":{"uri":"out_shopping_cart\/{id}","methods":["DELETE"],"domain":null},"in_shopping_cart.store":{"uri":"in_shopping_cart\/{product_id}","methods":["POST"],"domain":null},"interests.visor":{"uri":"user_interest","methods":["GET","HEAD"],"domain":null},"user_interest.borrar":{"uri":"out_user_interest\/{id}","methods":["DELETE"],"domain":null},"emergencia":{"uri":"emergencia","methods":["GET","HEAD"],"domain":null},"odontologia":{"uri":"odontologia","methods":["GET","HEAD"],"domain":null},"usersSearch":{"uri":"users\/search","methods":["GET","HEAD"],"domain":null},"users.search":{"uri":"search\/{name?}\/{nroDoc?}","methods":["POST"],"domain":null},"users.uploadfiles":{"uri":"uploadfiles","methods":["GET","HEAD"],"domain":null},"users.updatedb":{"uri":"updatedb","methods":["POST"],"domain":null},"activar.plan":{"uri":"activar\/plan","methods":["POST"],"domain":null},"activar.salud":{"uri":"activar\/salud","methods":["POST"],"domain":null},"activar.odontologia":{"uri":"activar\/odontologia","methods":["POST"],"domain":null},"pdf":{"uri":"pdf\/{id}","methods":["GET","HEAD"],"domain":null},"factura":{"uri":"factura\/{id}","methods":["GET","HEAD"],"domain":null},"recibo":{"uri":"imprimir\/recibo\/{id}\/letras\/{num_en_letras}","methods":["GET","HEAD"],"domain":null},"receipt.create":{"uri":"recibo\/crear\/{id}","methods":["GET","HEAD"],"domain":null},"receipt.store":{"uri":"recibo\/store","methods":["POST"],"domain":null},"asignar.roles":{"uri":"asignar\/roles","methods":["GET","HEAD"],"domain":null},"doctors.mostrar":{"uri":"doctors\/mostrar","methods":["GET","HEAD"],"domain":null},"getDoctors":{"uri":"getDoctors\/{id}","methods":["POST"],"domain":null},"getProfesionales":{"uri":"getProfesionales\/{id}","methods":["POST"],"domain":null},"getCoseguro":{"uri":"getCoseguro\/{id}","methods":["POST"],"domain":null},"getDataUser":{"uri":"getDataUser\/{id}","methods":["POST"],"domain":null},"products.shopping":{"uri":"products\/shopping","methods":["GET","HEAD"],"domain":null},"getCategories":{"uri":"getCategories","methods":["GET","HEAD"],"domain":null},"getProductsXCategory":{"uri":"getProductsXCategory\/{id}","methods":["POST"],"domain":null},"orders.indice":{"uri":"orders\/indice","methods":["GET","HEAD"],"domain":null},"getOnlyOrders":{"uri":"getOnlyOrders\/{id}","methods":["POST"],"domain":null},"cantOrders":{"uri":"cantOrders\/{id}","methods":["POST"],"domain":null},"users.panel":{"uri":"users\/panel\/{id}","methods":["GET","HEAD"],"domain":null},"password.edit":{"uri":"password\/edit","methods":["GET","HEAD"],"domain":null},"password.change":{"uri":"password\/change","methods":["POST"],"domain":null},"getPlans":{"uri":"getPlans\/{idGroup}","methods":["POST"],"domain":null},"getLayers":{"uri":"getLayers\/{id}","methods":["POST"],"domain":null},"otros":{"uri":"otros","methods":["GET","HEAD"],"domain":null},"planes":{"uri":"planes","methods":["GET","HEAD"],"domain":null},"users.darkMode":{"uri":"darkmode","methods":["POST"],"domain":null},"users.afiliar":{"uri":"users\/afiliar","methods":["GET","HEAD"],"domain":null},"users.promotor":{"uri":"users\/promotor","methods":["GET","HEAD"],"domain":null},"contacto.appVista":{"uri":"contacto\/app","methods":["GET","HEAD"],"domain":null},"contacto.app":{"uri":"contacto\/app","methods":["POST"],"domain":null},"contacto.llamadaVista":{"uri":"contacto\/llamada","methods":["GET","HEAD"],"domain":null},"contacto.llamada":{"uri":"contacto\/llamada","methods":["POST"],"domain":null},"contacto.promotorVista":{"uri":"contacto\/promotor","methods":["GET","HEAD"],"domain":null},"contacto.promotor":{"uri":"contacto\/promotor","methods":["POST"],"domain":null},"contacto.welcome":{"uri":"\/","methods":["POST"],"domain":null}},
        baseUrl: 'http://app-amparo.test/',
        baseProtocol: 'http',
        baseDomain: 'app-amparo.test',
        basePort: false,
        defaultParameters: []
    };

    if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
        for (var name in window.Ziggy.namedRoutes) {
            Ziggy.namedRoutes[name] = window.Ziggy.namedRoutes[name];
        }
    }

    export {
        Ziggy
    }
