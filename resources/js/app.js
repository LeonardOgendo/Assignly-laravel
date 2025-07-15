import Vue from 'vue/dist/vue.esm.js';
import LandingPage from './components/LandingPage.vue';

// Conditionally loading

if (window.location.pathname.startsWith('/dashboard/user')) {
    
    import('./user-dashboard').then(({ default: startDashboardApp }) => {
        startDashboardApp();
    });
} else if (window.location.pathname.startsWith('/dashboard/admin')) {
    import('./admin-dashboard').then(({ default: startAdminApp }) => {
        startAdminApp();
    });
} else {
   
    new Vue({
        el: '#app',
        components: { LandingPage },
    });
}
