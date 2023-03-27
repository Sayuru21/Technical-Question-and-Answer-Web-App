<template>
  <modal
    class="modal-confirm"
    :name="modalName"
    :adaptive="true"
    :class="{
      upgrade: checkUpgradeModal,
      loading: state == 'loading',
      success: state == 'success',
    }"
  >
    <div class="modal-left">
      <img
        src="@/assets/logo signup rewards.svg"
        alt="logo signup rewards"
        v-if="state == 'default'"
      />

      <div
        class="loading-wrapper"
        v-if="state == 'loading' || state == 'success'"
      >
        <div class="left">
          <img
            src="@/assets/logo signup rewards compact.svg"
            alt="logo signup rewards compact"
          />
        </div>
        <div class="right">
          <h3>Sending...</h3>
          <div class="wrapper">
            <div class="spinner">
              <div class="spinner-1"></div>
              <div class="spinner-2"></div>
              <div class="spinner-3"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="success-wrapper">
        <div class="icon-state-success-fill"></div>
        <h3>Sent successfully</h3>
      </div>
    </div>
    <div class="modal-right">
      <div class="content-container">
        <div class="sub-title">{{ subTitle }}</div>
        <h3>
          {{ msgTitle }}
          <div class="credit-cost" v-if="showMiniInfo">
            {{ miniInfoMsg }}
          </div>
        </h3>
      </div>

      <div class="action-btn-container">
        <button class="btn-gray" @click="hide">
          {{ backBtnText }}
        </button>
        <button
          class="btn-blue"
          :class="{
            'btn-orange': checkUpgradeModal,
            'btn-with-icon': checkUpgradeModal,
          }"
          @click="clicked"
          v-if="showActionBtn"
        >
          <div class="icon icon-premium"></div>
          {{ actionBtnText }}
        </button>
      </div>
    </div>
  </modal>
</template>

<script>
export default {
  name: "confirmation-modal",
  props: {
    modalName: {
      required: true,
      type: String,
    },
    subTitle: {
      type: String,
      default: "CONFIRMATION",
    },
    msgTitle: {
      type: String,
      default: "Msg Title",
    },
    showMiniInfo: {
      type: Boolean,
      default: false,
    },
    miniInfoMsg: {
      type: String,
      default: "mini title",
    },
    backBtnText: {
      type: String,
      default: "Go Back",
    },
    showActionBtn: {
      type: Boolean,
      default: true,
    },
    actionBtnText: {
      type: String,
      default: "Send SMS",
    },
    state: {
      type: String,
      default: "default",
    },
  },
  methods: {
    clicked() {
      this.$emit("clicked");
    },
    show() {
      this.$modal.show(this.modalName);
    },
    hide() {
      this.$modal.hide(this.modalName);
    },
  },
  computed: {
    checkUpgradeModal() {
      return this.actionBtnText == "UPGRADE NOW";
    },
  },
};
</script>

<style lang="scss" scoped>
.modal-confirm {
  &.loading,
  &.success {
    width: 400px !important;
    .modal-right {
      flex: 0;
      padding: 0;
      height: 0;
      width: 0;
      opacity: 0;
    }
    .modal-left {
      max-width: 400px;
    }
  }

  &.success {
    .success-wrapper {
      height: unset;
      transform: translateY(0) scale(1);
      opacity: 1;
    }
    .loading-wrapper {
      height: 0;
      transform: translateY(-24px) scale(0.9);
      opacity: 0;
    }
  }

  .loading-wrapper {
    display: flex;
    gap: 12px;
    color: $white;
    align-items: center;
    transition: 0.2s;
    .right{
      display: flex;
      flex-direction: column;
      gap: 4px;
    }
    img{
      margin-bottom: -6px;
    }
  }

  .success-wrapper {
    display: flex;
    gap: 4px;
    color: $white;
    align-items: center;
    .icon-state-success-fill {
      @include icon("icon-state-success-fill", 24px, $white);
    }
    height: 0;
    transform: translateY(24px) scale(0.9);
    opacity: 0;
    transition: 0.2s;
  }

  .modal-left {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: $primary-200;
    max-width: 180px;
    min-width: 180px;
    transition: all ease-in 0.2s;
    flex-direction: column;
  }
  .modal-right {
    flex: 2;
    display: flex;
    flex-direction: column;
    gap: 24px;
    padding: 24px;
    justify-content: space-between;
    .content-container {
      .sub-title {
        margin-bottom: 6px;
      }
      h3 {
        color: $black-HE;
        line-height: 1.3;
      }
      .credit-cost {
        margin-top: 4px;
        font-size: 12px;
        font-weight: 400 !important;
        color: $black-ME;
      }
    }
    transition: all ease-in 0.2s;
  }
  .action-btn-container {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
  }
}

.upgrade {
  .modal-left {
    background: $orange !important;
  }
  .icon-premium {
    @include icon("icon-up-premium", 24px, $white);
  }
}

// spinner
$spinner-color: $white;
$spinner-size: 0.75;
$faded-opacity: 0.35;
$spinner-delay: 0.18;
$spinner-scale: 0.87;
$animation-duration: 1.1s;
$animation-rest: 25;

.wrapper {
  display: flex;
  // justify-content: center;
  align-items: center;
}

.spinner {
  & * {
    display: inline-block;
    width: #{$spinner-size}rem;
    height: #{$spinner-size}rem;
    background-color: $spinner-color;
    border-radius: #{$spinner-size}rem;
    margin: 0 #{$spinner-size * 0.2}rem;
  }

  @for $i from 1 through 3 {
    & .spinner-#{$i} {
      animation: fade
        $animation-duration
        ease-in-out
        #{$i *
        $spinner-delay}s
        infinite
        both;
    }
  }
}

@keyframes fade {
  0% {
    opacity: $faded-opacity;
    transform: scale($spinner-scale);
  }
  25% {
    opacity: 1;
    transform: scale(1);
  }
  75% {
    opacity: $faded-opacity;
    transform: scale($spinner-scale);
  }
  100% {
    opacity: $faded-opacity;
    transform: scale($spinner-scale);
  }
}

</style>
