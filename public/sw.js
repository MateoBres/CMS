importScripts(
	'https://storage.googleapis.com/workbox-cdn/releases/4.3.1/workbox-sw.js'
);

if (workbox) {
	console.log(`Yay! Workbox is loaded 🎉`);
	workbox.precaching.precacheAndRoute([]);
  } else {
	console.log(`Boo! Workbox didn't load 😬`);
  }



//image in cache
workbox.routing.registerRoute(
    /\.(?:png|gif|jpg|jpeg|svg)$/,
    workbox.strategies.staleWhileRevalidate({
      cacheName: 'images',
      plugins: [
        new workbox.expiration.Plugin({
          maxEntries: 60,
          maxAgeSeconds: 30 * 24 * 60 * 60, // 30 Days
        }),
      ],
    }),
  );


  //network request in cache
  workbox.routing.registerRoute(
    new RegExp('http://127.0.0.1:8000/api/'),
    workbox.strategies.networkFirst({
      cacheName: 'api',
    }),
  );

  //js and css in cache
  workbox.routing.registerRoute(
    /\.(?:js|css)$/,
    workbox.strategies.staleWhileRevalidate(),
  ); 

  //webfont in cache
  workbox.routing.registerRoute(
    new RegExp('https://fonts.(?:googleapis|gstatic).com/(.*)'),
    workbox.strategies.cacheFirst({
      cacheName: 'googleapis',
      plugins: [
        new workbox.expiration.Plugin({
          maxEntries: 30,
        }),
      ],
    }),
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
    