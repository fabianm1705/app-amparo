importScripts(
	'https://storage.googleapis.com/workbox-cdn/releases/4.3.1/workbox-sw.js'
);

// if (workbox) { //workbox solo existe en el scope del serviceWorker
//   console.log('Workbox loaded!');
// } else {
//   console.log(`Can't load Workbox`);
// }

workbox.core.setCacheNameDetails({
  prefix: 'app-amparo',
  suffix: 'v3',
  precache: 'precache-cache',
  runtime: 'runtime-cache'
});

workbox.precaching.precacheAndRoute([]);

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
