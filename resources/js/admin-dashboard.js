import Vue from 'vue/dist/vue.esm.js';
import VueRouter from 'vue-router';

import AdminLayout from './components/admin/AdminLayout.vue';
import DashboardView from './components/admin/DashboardView.vue';
import TaskManagerView from './components/admin/TaskManagerView.vue';
import UserManagerView from './components/admin/UserManagerView.vue';
import TaskIndexView from './components/admin/TaskIndexView.vue';
import TaskCreateView from './components/admin/TaskCreateView.vue';
import TaskShowView from './components/admin/TaskShowView.vue';
import TaskEditView from './components/admin/TaskEditView.vue';

Vue.use(VueRouter);

const routes = [
  {
    path: '/dashboard/admin',
    component: AdminLayout,
    children: [
      { path: '', component: DashboardView },
      { path: 'tasks', component: TaskManagerView },
      { path: 'tasks/view', component: TaskIndexView },
      { path: 'tasks/create', component: TaskCreateView },
      { path: 'tasks/:id', component: TaskShowView },
      { path: 'tasks/:id/edit', component: TaskEditView },


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
