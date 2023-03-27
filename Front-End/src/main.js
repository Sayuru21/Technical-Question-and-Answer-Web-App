import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";

import FloatingVue from "floating-vue";
import VueLodash from "vue-lodash";
import lodash from "lodash";
import VModal from "vue-js-modal";
import VWave from "v-wave";

//Global shared component registration
import BaseIcon from "@/components/shared/BaseIcon.vue";
import BaseButton from "@/components/shared/Buttons/BaseButton.vue";
import BaseButtonIcon from "@/components/shared/Buttons/BaseButtonIcon.vue";
import BaseButtonIconMini from "@/components/shared/Buttons/BaseButtonIconMini.vue";
import FormTextarea from "@/components/shared/FormControls/FormTextarea.vue";
import FormTextfield from "@/components/shared/FormControls/FormTextfield.vue";
import FormDropdownSelector from "@/components/shared/FormControls/FormDropdownSelector.vue";
Vue.component("BaseIcon", BaseIcon);
Vue.component("base-button", BaseButton);
Vue.component("base-button-icon", BaseButtonIcon);
Vue.component("base-base-button-icon-mini", BaseButtonIconMini);
Vue.component("form-textarea", FormTextarea);
Vue.component("form-textfield", FormTextfield);
Vue.component("form-dropdown-selector", FormDropdownSelector);

Vue.use(VueLodash, { lodash: lodash });
Vue.use(FloatingVue, {
  themes: {
    tooltip: {
      handleResize: true,
      overflowPadding: 24,
      autoSize: "min",
    },
    "dropdown-menu": {
      $resetCss: true,
      triggers: ["click"],
      autoHide: true,
      placement: "bottom",
    },
    "Wix-default": {
      $extend: "tooltip",
      $resetCss: true,
      triggers: ["click", "hover"],
      autoHide: true,
      placement: "bottom",
      handleResize: true,
      overflowPadding: 24,
      autoSize: true,
    },
    mini: {
      $extend: "tooltip",
      autoSize: false,
      handleResize: false,
    },
  },
});
Vue.use(VModal);
Vue.use(VWave, {
  color: "#0077d9",
});

Vue.config.productionTip = false;

new Vue({
  router,
  store,
  render: (h) => h(App),
}).$mount("#app");
