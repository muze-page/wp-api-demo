<script setup>
import HelloWorld from "./components/HelloWorld.vue";
</script>

<template>
  <h3>请选择下列工具</h3>
  <router-link to="/hycd">汉字词典</router-link>
  <!-- 路由匹配到的组件将渲染在这里 -->
  <router-view></router-view>
</template>

<style scoped>
.logo {
  height: 6em;
  padding: 1.5em;
  will-change: filter;
  transition: filter 300ms;
}
.logo:hover {
  filter: drop-shadow(0 0 2em #646cffaa);
}
.logo.vue:hover {
  filter: drop-shadow(0 0 2em #42b883aa);
}
</style>
