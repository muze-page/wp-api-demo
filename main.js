//vue内容部分
const App = {
  setup() {
    const datas = Vue.reactive({
      myObject: {
        key: "",
        query: "",
      },
    });
    //设为默认值
    datas.myObject = apiObjectOption;

    //存储返回值
    const value = Vue.ref("");
    //保存选项
    const postData = () => {
      // 发送POST请求
      jQuery.ajax({
        url: ajaxurl, // WordPress提供的全局变量，指向admin-ajax.php文件
        type: "POST",
        data: {
          action: "save_object_api_option", // 自定义的Ajax处理函数名称
          object_data: JSON.stringify(datas.myObject), // 将对象转换为 JSON 字符串
        },
        success: function (response) {
          // 请求成功的回调函数
          console.log("设置选项已保存！");
          console.log(datas.myObject);
        },
        error: function (error) {
          // 请求失败的回调函数
          console.error("保存设置选项时出错：" + error.responseText);
        },
      });
    };

    //新华字典接口
    const getXh = () => {
      jQuery.ajax({
        url: ajaxurl, // WordPress提供的全局变量，指向admin-ajax.php文件
        type: "POST",
        data: {
          action: "get_xh_callback", // 自定义的Ajax处理函数名称
          //authorization: datas.myObject.key,
          word: datas.myObject.query,
        },
        success: function (response) {
          // 请求成功的回调函数
          console.log("已获取");
          console.log(response);
          value.value = response.data;
        },
        error: function (error) {
          // 请求失败的回调函数
          console.error("获取值时出错：" + error.responseText);
          console.error(error);
        },
      });
    };
    
    //简单的测试
    const getTest = () => {
      jQuery.ajax({
        url: ajaxurl, // WordPress提供的全局变量，指向admin-ajax.php文件
        type: "GET",
        data: {
          action: "get_test_callback", // 自定义的Ajax处理函数名称
        },
        success: function (response) {
          // 请求成功的回调函数
          console.log("已获取");
          console.log(response);
        },
        error: function (error) {
          // 请求失败的回调函数
          console.error("获取值时出错：" + error.responseText);
          console.error(error);
        },
      });
    };

    return { datas, postData, getXh, getTest,value };
  },
  template: `
  令牌：<input type="text" v-model="datas.myObject.key">
  查字：<input type="text" v-model="datas.myObject.query">
  <h3>返回的数据</h3>
  {{value}}
  <hr/><button class="button button-primary" @click="postData">保存选项</button>
  <hr/><button class="button button-primary" @click="getXh">获取返回值</button>
  <hr/><button class="button button-primary" @click="getTest">测试获取</button>
  `,
};

Vue.createApp(App).mount("#api");