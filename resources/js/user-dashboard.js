import Vue from 'vue/dist/vue.esm.js';
import VueRouter from 'vue-router';

import UserLayout from './components/user/UserLayout.vue';
import DashboardView from './components/user/DashboardView.vue';
import TasksView from './components/user/TasksView.vue';
import NotificationsView from './components/user/NotificationsView.vue';

Vue.use(VueRouter);

const routes = [
    {
        path: '/dashboard/user',
        component: UserLayout,
        children: [
            { path: '', component: DashboardView },
            { path: 'tasks', component: TasksView },
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