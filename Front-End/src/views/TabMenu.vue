<template>
  <div class="tab-menu flex-start flex-v gap-24">
    <img src="@/assets/logo.svg" />
    <div class="flex-start flex-v gap-6">
      <router-link
        class="sidebar-item"
        v-for="item in menuItems"
        :key="item.tabName"
        :to="item.route"
        exact
      >
        <BaseMenuItem :icon="item.icon" :name="item.name" />
      </router-link>
    </div>

    <base-button @click.native="$emit('openQuestionModal')">
      Ask Question
    </base-button>
  </div>
</template>

<script>
import BaseMenuItem from "@/components/BaseMenuItem.vue";
export default {
  name: "tab-menu",
  components: {
    BaseMenuItem,
  },
  props: {
    active: {
      type: String,
      default: "Home",
    },
  },
  data() {
    return {
      menuItems: [
        {
          name: "Home",
          icon: "icon-menu-home",
          route: "/",
        },
        {
          name: "Explore",
          icon: "icon-menu-hash",
          route: "/explore",
        },
        {
          name: "Bookmarks",
          icon: "icon-menu-bookmark",
          route: "/bookmarks",
        },
        {
          name: "Profile",
          icon: "icon-menu-user",
          route: "/profile",
        },
      ],
    };
  },
};
</script>

<style lang="scss">
.tab-menu {
  min-width: 186px;
  padding: 18px 24px 16px 24px;
  background-color: $gray-200;

  .sidebar-item {
    text-transform: capitalize;
    text-decoration: none;

    // &:hover {
    //   transition: 0.1s;
    //   background-color: $gray-200;
    //   color: $black;
    // }
  }
}
.sidebar-item.router-link-exact-active {
  color: $primary-200;
  &:hover {
    color: $primary-200;
    background-color: unset;
  }
}
</style>
