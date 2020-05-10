importScripts(
	'https://storage.googleapis.com/workbox-cdn/releases/4.3.1/workbox-sw.js'
);

workbox.precaching.precacheAndRoute([
  {
    "url": "css/app-amparo.css",
    "revision": "1dfa3481a3090e0f00c6b59545bee693"
  },
  {
    "url": "css/app.css",
    "revision": "59d0739fbb4efbdffda1c4f36eb47e97"
  },
  {
    "url": "css/ferozo.css",
    "revision": "892c0b36995ae7a8f725bee672d14af0"
  },
  {
    "url": "css/fresh-bootstrap-table.css",
    "revision": "95d9dafe15982cf8b53ebe6cfcacb282"
  },
  {
    "url": "css/material-kit.css",
    "revision": "8834050e94a5e2db93990635509bad04"
  },
  {
    "url": "img/sprite.png",
    "revision": "95cf14a14ab5db4dc386b3da2a8fbaa2"
  },
  {
    "url": "js/addToHomeScreen.js",
    "revision": "03db0a6b6d8a02bf34771f20fd85d224"
  },
  {
    "url": "js/app.js",
    "revision": "9f56bcf86e02c555120601b33636cacb"
  },
  {
    "url": "material/js/bootstrap.min.js",
    "revision": "79b5346433d3bdf736aab2379a008083"
  },
  {
    "url": "material/js/core/bootstrap-material-design.min.js",
    "revision": "479f5022008b8d4b6ef6f2d406ead5cf"
  },
  {
    "url": "material/js/core/jquery.min.js",
    "revision": "986d2baef41aa37ae02ab33355413b98"
  },
  {
    "url": "material/js/core/popper.min.js",
    "revision": "10a554dd975faf4004fc557d7cf8c998"
  },
  {
    "url": "material/js/envioForm.js",
    "revision": "17ba0987693ae97dce473028bbfc66be"
  },
  {
    "url": "material/js/form_object.js",
    "revision": "0c5ce72b4793c42b5d532a77d8e56910"
  },
  {
    "url": "material/js/material-kit.js",
    "revision": "03b428e1babd3fe4771b7c5a62288696"
  },
  {
    "url": "material/js/material-kit.min.js",
    "revision": "869129d75f741aeb914db9e726bf7c6a"
  },
  {
    "url": "material/js/material.min.js",
    "revision": "71691fa851c2e609069b7c5c70fdff06"
  },
  {
    "url": "material/js/plugins/bootstrap-datetimepicker.js",
    "revision": "4df98b35813fbe2047135171afc23628"
  },
  {
    "url": "material/js/plugins/bootstrap-selectpicker.js",
    "revision": "b880760095ac3d4ccf31bed886c0161a"
  },
  {
    "url": "material/js/plugins/bootstrap-tagsinput.js",
    "revision": "ada40916745c321bce2c3920c5dc9bab"
  },
  {
    "url": "material/js/plugins/jasny-bootstrap.min.js",
    "revision": "290771f24de1f08dfddd81871442355c"
  },
  {
    "url": "material/js/plugins/jquery.flexisel.js",
    "revision": "18d345ee57a756ceb749f036ff8c31e2"
  },
  {
    "url": "material/js/plugins/moment.min.js",
    "revision": "234c4f6c148398f299e8ba0911e2fc3b"
  },
  {
    "url": "material/js/plugins/nouislider.min.js",
    "revision": "e7a013b83fd3efa2dbe243cb0f446c52"
  },
  {
    "url": "material/material-kit.css",
    "revision": "8834050e94a5e2db93990635509bad04"
  },
  {
    "url": "sw-base.js",
    "revision": "a9159f0348a9300e3404caf69a4d6b69"
  },
  {
    "url": "offline.html",
    "revision": "e237ae2d8c06140f9cbf9fe560297483"
  },
  {
    "url": "/welcome",
    "revision": "11c48f9e545f9bcee00f17db7ad4b412"
  },
  {
    "url": "/contacto",
    "revision": "e13d203db1668123189c13673101b184"
  },
  {
    "url": "/home",
    "revision": "c47cc5f4629505327dff0c60e977036c"
  },
  {
    "url": "/app",
    "revision": "44e90acc3d3003228d17c7314fb9e072"
  },
  {
    "url": "/doctorsmostrar",
    "revision": "01e1d18da1ed9d8a25c44a9a47421ea4"
  },
  {
    "url": "/orderscrear",
    "revision": "c13e8b80d0ecff889efe7821b58767bb"
  },
  {
    "url": "/ordersindice",
    "revision": "13bfcc88b7e77eed7a54f47520d0ace6"
  },
  {
    "url": "/shopping",
    "revision": "b9a4ebad25b37322efe236e472bb9339"
  },
  {
    "url": "/login",
    "revision": "5db48c5c3e9d2b37f7f9f86b46e45bb9"
  }
]);

workbox.routing.registerRoute(
	new RegExp('/images/'),
	new workbox.strategies.StaleWhileRevalidate({
		cacheName: 'images',
		plugins: [
			new workbox.expiration.Plugin({
				maxEntries: 15
			}),
			new workbox.cacheableResponse.Plugin({
				statuses: [200]
			})
		]
	})
);

const networkFirstHandler = new workbox.strategies.NetworkFirst({
	cacheName: 'dynamic',
	plugins: [
		new workbox.expiration.Plugin({
			maxEntries: 10
		}),
		new workbox.cacheableResponse.Plugin({
			statuses: [200]
		})
	]
});

const FALLBACK_URL = workbox.precaching.getCacheKeyForURL('/offline.html');
const matcher = ({ event }) => event.request.mode === 'navigate';
const handler = args =>
	networkFirstHandler
		.handle(args)
		.then(response => response || caches.match(FALLBACK_URL))
		.catch(() => caches.match(FALLBACK_URL));

workbox.routing.registerRoute(matcher, handler);
