module.exports = {
	globDirectory: 'public/',
	globPatterns: ['**/*.{js,css,png,jpg}','offline.html'],
	swSrc: 'public/sw-base.js',
	swDest: 'public/service-worker.js',
	globIgnores: [
		'../workbox-cli-config.js',
		'images/**'
  ],
  templatedURLs: {
     '/welcome': 'resources/views/welcome.blade.php',
     '/contacto': 'resources/views/contacto.blade.php',
     '/home': 'resources/views/home.blade.php',
     '/app': 'resources/views/layouts/app.blade.php',
     '/doctorsmostrar': 'resources/views/admin/doctor/mostrar.blade.php',
     '/orderscrear': 'resources/views/admin/order/crear.blade.php',
     '/ordersindice': 'resources/views/admin/order/indice.blade.php',
     '/shopping': 'resources/views/admin/product/shopping.blade.php',
     '/login': 'resources/views/auth/login.blade.php',
  }
};
