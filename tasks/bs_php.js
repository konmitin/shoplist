const bs = require("browser-sync");

module.exports = function bs_php() {
  bs.init({
    browser: ["chrome"],
    watch: true,
    proxy: "shoplist.ru/",
    logLevel: "info",
    logPrefix: "BS-PHP:",
    logConnections: true,
    logFileChanges: true,
    https: true
  });
};
