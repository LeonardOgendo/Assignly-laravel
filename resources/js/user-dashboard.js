import Vue from 'vue/dist/vue.esm.js';
import VueRouter from 'vue-router';
import axios from 'axios';

import UserLayout from './components/user/UserLayout.vue';
import DashboardView from './components/user/DashboardView.vue';
import TasksView from './components/user/TasksView.vue';
import NotificationsView from './components/user/NotificationsView.vue';
import TasksActiveView from './components/user/TasksActiveView.vue';
import TasksCompletedView from './components/user/TasksCompletedView.vue';
import TaskDetailView from './components/user/TaskDetailView.vue';
import TaskReadonlyView from './components/user/TaskReadonlyView.vue';

Vue.use(VueRouter);

window.axios = axios;

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found. Please check your meta tag.');
}

const routes = [
    {
        path: '/dashboard/user',
        component: UserLayout,
        children: [
            { path: '', component: DashboardView },
            { path: 'tasks', component: TasksView },
            { path: 'tasks/active', component: TasksActiveView },
            { path: 'tasks/completed', component: TasksCompletedView },
            { path: 'tasks/:id', component: TaskDetailView, props: true },
            { path: 'tasks/completed/:id', component: TaskReadonlyView, props: true },

            { path: 'notifications', component: NotificationsView },
        ],
    },
];

export default function startDashboardApp() {
    const router = new VueRouter({ mode: 'history', routes });

    new Vue({
        el: '#app',
        router,
    });
}