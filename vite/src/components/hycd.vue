<script setup>
import { ref } from "vue";
import axios from "axios";

//存储搜索值
const queryContent = ref("");

//存储结果
const resule = ref("");

//渲染

//触发查询
const queryDo = () => {
  console.log(dataLocal.ajaxurl);
  const params = new URLSearchParams();
  params.append("action", "get_xh_callback");
  params.append("word", queryContent.value);

  axios
    .post(dataLocal.ajaxurl, params)
    .then(function (response) {
      // 请求成功的回调函数
      console.log("数据已获取");
      resule.value = response.data;
    })
    .catch(function (error) {
      // 请求失败的回调函数
      console.error("获取数据时出错：" + error.response.data);
    });
};
</script>

<template>
  <div class="hycd">
    <h3>请输入需要查询的词</h3>

    <input type="text" v-model="queryContent" />

    <br />
    <button @click="queryDo">查询</button>
    <br />
    <div v-if="resule">
      <h3>返回的结果</h3>
      <br />
      {{ resule }}
    </div>
  </div>
</template>

<style scoped>
.hycd {
  text-align: center;
}
.hycd  input {
  margin: 2em 0;
}
</style>
