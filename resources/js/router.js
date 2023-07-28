import Vue from 'vue';
import LoginPage from './pages/LoginPage';
import RegisterPage from './pages/RegisterPage';
import HomePage from './pages/HomePage';
import ViewRecordsPage from './pages/ViewRecordsPage';
import WelcomePage from './pages/WelcomePage';
import VueRouter from 'vue-router';
import store from './store';

Vue.use(VueRouter);

const router = new VueRouter({
 mode: 'history',
 routes: [
  {
   path: '/',
   component: LoginPage,
   meta: { guest: true },
  },
  {
   path: '/login',
   name: 'login',
   component: LoginPage,
   meta: { guest: true },
  },
  {
   path: '/register',
   name: 'register',
   component: RegisterPage,
   meta: { guest: true },
  },
  {
   path: '/home',
   name: 'home',
   component: HomePage,
   meta: { requiresAuth: true },
   children: [
    {
     path: '/',
     component: WelcomePage,
     meta: { requiresAuth: true },
    },
    {
     path: 'welcome',
     name: 'welcome',
     component: WelcomePage,
     meta: { requiresAuth: true },
    },
    {
     path: 'view-records',
     name: 'view_records',
     component: ViewRecordsPage,
     meta: { requiresAuth: true },
    },
    {
     path: 'subscribe',
     name: 'subscribe',
     meta: { requiresAuth: true },
     component: {
      template: '<h1>Unsubscribe</h1>',
     },
    },
   ],
  },
 ],
});

router.beforeEach((to, from, next) => {
 if (to.matched.some((record) => record.meta.requiresAuth)) {
  if (store.getters['auth/getAuth']) {
   next();
   return;
  }
  next({ name: 'login' });
 } else {
  next();
 }
});

router.beforeEach((to, from, next) => {
 if (to.matched.some((record) => record.meta.guest)) {
  if (store.getters['auth/getAuth']) {
   next({ name: 'home' });
   return;
  }
  next();
 } else {
  next();
 }
});

export default router;
