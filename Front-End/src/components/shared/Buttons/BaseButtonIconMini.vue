<template>
  <button
    class="flex-center-center icon-btn-mini"
    :class="model"
    :disabled="disable"
  >
    <div
      class="icon"
      :style="{
        '-webkit-mask-image': backgroundImage,
        'mask-image': backgroundImage,
        '-webkit-mask-size': 'cover',
        ' mask-size': 'cover',
      }"
    ></div>
  </button>
</template>

<script>
export default {
  name: "base-base-button-icon-mini",
  props: {
    model: {
      type: String,
      default: "main",
    },
    iconName: {
      type: String,
      default: "icon-user-admin",
    },
    disable: {
      type: Boolean,
      default: false,
    },
  },
  methods: {},
  computed: {
    backgroundImage() {
      return "url(" + require("@/assets/Icons/" + this.iconName + ".svg") + ")";
    },
  },
};
</script>

<style lang="scss" scoped>
.icon-btn-mini {
  background: $primary-300;
  color: $white;
  cursor: pointer;
  transition: 0.2s;
  text-decoration: unset;
  padding: 0;
  min-width: 20px;
  min-height: 20px;
  border-radius: 3px;
  .icon {
    width: 14px;
    height: 14px;
    -webkit-mask-size: cover;
    mask-size: cover;
    background-color: $white;
  }

  &.sub {
    background: transparent;
    color: $primary-300;
    border: 1px solid $primary-200;
    .icon {
      background-color: $primary-300;
    }

    &:hover {
      background: $primary-50;
    }
    &:disabled {
      background: transparent;
      border: 1px solid $gray-300;
    }
  }

  &.text {
    background: transparent;
    color: $primary-300;
    .icon {
      background-color: $primary-300;
    }

    &:hover {
      background: $primary-100;
    }
    &:disabled {
      background: transparent;
    }
  }

  &:disabled {
    background: $gray-300;
    color: $black-disabled;
    cursor: not-allowed;
    pointer-events: none;
    .icon {
      background-color: $black-disabled;
    }
  }
}

.v-popper--shown {
  .icon-btn-mini {
    background: $primary-100;
    border: 2px solid $primary-100;
  }
}
</style>
