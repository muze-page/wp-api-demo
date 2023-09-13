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
          action: "save_object_api_option_callback", // 自定义的Ajax处理函数名称
          object_data: JSON.stringify(datas.myObject), // 将对象转换为 JSON 字符串
        },
        success: function (response) {
          // 请求成功的回调函数
          console.log("设置选项已保存！");
          console.log(datas.myObject);
          alert("保存成功，现在可以使用查询功能了");
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

    return { datas, postData, getXh, getTest, value };
  },
  template: `
  令牌：<input type="text" placeholder="appCode" v-model="datas.myObject.key" style="
  width: 300px;
">
<br/>
  请填写您申请的令牌，申请地址：<a href="https://doc.topthink.com/think-api/APIdiaoyong.html" target="_blank">点击申请</a>
  <br/>

  
  <hr/><button class="button button-primary" @click="postData">保存选项</button>
  <hr/><button class="button button-primary" @click="getTest">测试获取</button>


  <hr/>查字：<input type="text" v-model="datas.myObject.query">
 
  <hr/><button class="button button-primary" @click="getXh">查询</button>
  <div v-if="value">
  <h3>返回的数据</h3>
  {{value}}
  <ul>
  <li>
  代码：{{value.code}}
  </li>
  <li>
  信息  ：{{value.message}}
  </li>
  <li>
  ID ：{{value.data.id}}
  </li>

  <li >
  查询的字 ：{{value.data.zi}}
  </li>
  <li >
  拼音 ：{{value.data.py}}
  </li>
  <li >
  读音：{{value.data.pinyin}}
  </li>
  <li >
  五笔：{{value.data.wubi}}
  </li>
  <li >
  部首：{{value.data.bushou}}
  </li>
  <li >
  笔画数：{{value.data.bihua}}
  </li>
  <li >
  简解：{{value.data.jijie}}
  </li>
  <li >
  详解：{{value.data.xiangjie}}
  </li>

  </ul>

  </div>
  `,
};

Vue.createApp(App).mount("#api");



