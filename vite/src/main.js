import { createApp } from 'vue'
import './style.css'
import App from './App.vue'

//路由
import router from "./router";  



//挂载根组件
const app = createApp(App);


//注册路由
app.use(router);

app.mount('#apps')
