
const routes = [
  {
    path: "/",
    component: () => import("pages/Login.vue"),
    name: 'login',
    meta: { auth: false }
  },
  {
    path: "/welcome",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      { 
        path: "", 
        component: () => import("pages/Index.vue"),
        name: 'welcome',
        meta: { auth: true }
      },
      { 
        path: "/airports", 
        component: () => import("pages/airports/Index.vue"),
        name: 'airports',
        meta: { auth: true, permission: 'view airports' }
      },
      { 
        path: "/airlines", 
        component: () => import("pages/airlines/Index.vue"),
        name: 'airlines',
        meta: { auth: true, permission: 'view airlines' }
      },
      { 
        path: "/flights", 
        component: () => import("pages/flights/Index.vue"),
        name: 'flights',
        meta: { auth: true, permission: 'view flights' }
      },
      { 
        path: "/remarks/:id/:type", 
        component: () => import("pages/remarks/Index.vue"),
        name: 'remarks',
        meta: { auth: true }
      }

    ],
    meta: { auth: true },
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '*',
    component: () => import('pages/Error404.vue'),
    name: 'error'
  },
]

export default routes
