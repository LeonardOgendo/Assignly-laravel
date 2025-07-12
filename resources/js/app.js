import Vue from 'vue/dist/vue.esm.js';
import LandingPage from './components/LandingPage.vue';

// Conditionally load dashboard Vue app
if (window.location.pathname.startsWith('/dashboard/user')) {
    // Import Vue Router setup only if on dashboard route
    import('./user-dashboard').then(({ default: startDashboardApp }) => {
        startDashboardApp();
    });
} else {
    // Render LandingPage component for '/' or any other non-dashboard routes
    new Vue({
        el: '#app',
        components: { LandingPage },
    });
}
