//导入Vue Router模块中的两个方法
import { createRouter, createWebHistory } from "vue-router";
//导入路由需要用到的自定义组件
import Home from "../components/HelloWorld.vue";
import Hycd from "../components/hycd.vue";

//定义路由
const routes = [
  {
    path: "/",
    name: "首页",
    component: Home,
  },
  {
    path: "/hycd",
    name: "汉语词典",
    component: Hycd,
  },
];

//创建路由对象
const router = createRouter({
  history: createWebHistory(),
  routes: routes,
});
export default router;
