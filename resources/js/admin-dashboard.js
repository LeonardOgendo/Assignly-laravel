import Vue from 'vue/dist/vue.esm.js';
import VueRouter from 'vue-router';

import AdminLayout from './components/admin/AdminLayout.vue';
import DashboardView from './components/admin/DashboardView.vue';
import TaskManagerView from './components/admin/TaskManagerView.vue';
import UserManagerView from './components/admin/UserManagerView.vue';

Vue.use(VueRouter);

const routes = [
  {
    path: '/dashboard/admin',
    component: AdminLayout,
    children: [
      { path: '', component: DashboardView },
      { path: 'tasks', component: TaskManagerView },
      { path: 'users', component: UserManagerView },
    ],
  },
];

export default function startAdminApp() {
  const router = new VueRouter({ mode: 'history', routes });

  new Vue({
    el: '#app',
    router,
  });
}
