import Vue from 'vue/dist/vue.esm.js';
import VueRouter from 'vue-router';

import AdminLayout from './components/admin/AdminLayout.vue';
import DashboardView from './components/admin/DashboardView.vue';
import TaskManagerView from './components/admin/TaskManagerView.vue';
import UserManagerView from './components/admin/UserManagerView.vue';
import TaskListView from './components/admin/TaskListView.vue';
import TaskCreateView from './components/admin/TaskCreateView.vue';
import TaskDetailView from './components/admin/TaskDetailView.vue';
import TaskEditView from './components/admin/TaskEditView.vue';
import UserListView from './components/admin/UserListView.vue';
import UserCreateView from './components/admin/UserCreateView.vue';

Vue.use(VueRouter);

const routes = [
  {
    path: '/dashboard/admin',
    component: AdminLayout,
    children: [
      { path: '', component: DashboardView },
      { path: 'tasks', component: TaskManagerView },
      { path: 'tasks/view', component: TaskListView },
      { path: 'tasks/create', component: TaskCreateView },
      { path: 'tasks/:id', component: TaskDetailView },
      { path: 'tasks/:id/edit', component: TaskEditView },


      { path: 'users', component: UserManagerView },
      { path: 'users/list', component: UserListView },
      { path: 'users/create', component: UserCreateView },
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
