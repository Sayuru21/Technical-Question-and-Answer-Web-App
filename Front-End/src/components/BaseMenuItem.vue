<template>
  <div class="menu-item flex-center gap-6" v-wave>
    <BaseIcon :iconName="icon" size="16" color="black" />
    <div class="tab-name">{{ name }}</div>
  </div>
</template>

<script>
export default {
  name: "base-menu-item",
  props: {
    icon: {
      type: String,
      default: "editor/icon-plus",
    },
    name: {
      type: String,
      default: "label",
    },
    activeTab: {
      type: String,
      default: "label",
    },
    type: {
      type: String,
      default: "default",
    },

    lording: {
      type: Boolean,
      default: false,
    },
  },
  computed: {
    limitReached() {
      return this.limit <= 0;
    },
  },
};
</script>

<style lang="scss" scoped>
.menu-item {
  display: flex;
  justify-content: center;
  align-content: baseline;
  flex-wrap: wrap;

  padding: 6px 12px 6px 10px;
  height: 32px;
  border-radius: 17px;
  color: $black;
  cursor: pointer;
  transition: 0.3s all ease-in-out;
  .tab-name {
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }
  &:hover {
    transition: 0.1s all ease-in-out;
    color: $primary-200;
    background-color: $primary-25;
    .icon {
      background-color: $primary-200;
    }
  }
  &.pink {
    color: $pink;
    &:hover {
      background-color: $pink-50;
    }
  }
}
.router-link-active .menu-item {
  color: $primary-300;
  background-color: $primary-50;
  .icon {
    background-color: $primary-300;
  }
}

.menu-divider {
  padding: 6px 12px;
  width: 100%;
  hr {
    border-top: 1px solid $gray-400;
  }
}
</style>
