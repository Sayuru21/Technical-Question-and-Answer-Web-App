const { defineConfig } = require("@vue/cli-service");
module.exports = defineConfig({
  publicPath: "/cw2/",
  transpileDependencies: true,
  devServer: {
    proxy: "https://w1790114.users.ecs.westminster.ac.uk/",
  },
  css: {
    loaderOptions: {
      scss: {
        // module.exports = defineConfig({
        //   publicPath: "/cw2/",
        //   transpileDependencies: true,
        //   css: {
        //     loaderOptions: {
        //       scss: {
        additionalData: `@import "~@/styles/global.scss";`,
      },
    },
  },
});
