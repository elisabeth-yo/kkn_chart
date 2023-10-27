<template>
  <component :is="this.$route.meta.layout || 'div'">
    <Navbar />
    <router-view />
    <Footer />
  </component>
</template>

<script>
import Navbar from './components/Navbar.vue'
import Footer from './components/Footer.vue'
export default {
  name: "App",
  components: {
    Navbar,
    Footer
  }
};
</script>
