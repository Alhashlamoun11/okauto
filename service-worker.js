const CACHE_NAME = 'okauto-cache-v1';
const urlsToCache = [
    '/',
    '/about',
    '/blog',
    '/user/dashboard',
    '/user/login',
    '/user/register',
    '/manifest.json',
    '/contact',
  '/assets/templates/basic/css/main.css',
  '/assets/images/logo_icon/Screenshot_2025-04-06_152847-removebg-preview (1).png',
  '/assets/images/logo_icon/Screenshot_2025-04-06_152847-removebg-preview (2).png',
  '/offline.html'
];

//self.addEventListener('install', event => {
//  event.waitUntil(
//    caches.open(CACHE_NAME).then(cache => cache.addAll(urlsToCache))
//  );
//  self.skipWaiting();
//});

// تفعيل الخدمة
self.addEventListener('activate', event => {
  event.waitUntil(
    caches.keys().then(keys => Promise.all(
      keys.map(key => key !== CACHE_NAME && caches.delete(key))
    ))
  );
  self.clients.claim();
});

// التعامل مع الفتش
self.addEventListener('fetch', event => {
  if (event.request.method !== 'GET') return;
  event.respondWith(
    fetch(event.request)
      .then(res => {
        const resClone = res.clone();
        caches.open(CACHE_NAME).then(cache => cache.put(event.request, resClone));
        return res;
      })
      .catch(() => caches.match(event.request).then(r => r || caches.match('/offline.html')))
  );
});

// ✅ التعامل مع Push Notifications
self.addEventListener('push', event => {
  const data = event.data.json() || {
    title: 'OK AUTO Notification',
    body: 'You have a new notification',
    icon: '/assets/images/logo_icon/Screenshot_2025-04-06_152847-removebg-preview (1).png'
  };

  event.waitUntil(
    self.registration.showNotification(data.title, {
      body: data.body,
      icon: data.icon,
      data: data.url || '/'
    })
  );
});

// ✅ عند الضغط على الإشعار
self.addEventListener('notificationclick', event => {
  event.notification.close();
  event.waitUntil(
    clients.matchAll({ type: 'window' }).then(clientList => {
      for (const client of clientList) {
        if (client.url === event.notification.data && 'focus' in client) {
          return client.focus();
        }
      }
      return clients.openWindow(event.notification.data || '/');
    })
  );
});
