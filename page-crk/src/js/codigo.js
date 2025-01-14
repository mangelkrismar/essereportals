/**
 * @module ONLOAD
 */
window.addEventListener("load", function () {
  const online = false; //Obtener si está online
  if (online) initChat(); //Si está online, iniciar el chat
});
/**
 * @module CODIGO_CHAT
 */
initChat = () => {
  let LHCChatOptions = {};
  LHCChatOptions.opt = {
    widget_height: 240,
    widget_width: 200,
    popup_height: 420,
    popup_width: 400,
    domain: "www.crk.lat",
  };
  (function () {
    let po = document.createElement("script");
    po.type = "text/javascript";
    po.async = true;
    let referrer = document.referrer
      ? encodeURIComponent(
          document.referrer.substr(document.referrer.indexOf("://") + 1)
        )
      : "";
    let location = document.location
      ? encodeURIComponent(
          window.location.href.substring(window.location.protocol.length)
        )
      : "";
    po.src =
      "https://www.krismar-educa.com.mx/soporteLive/index.php/esp/chat/getstatus/(position)/middle_right/(top)/50/(units)/percents/(leaveamessage)/true/(department)/3/(theme)/3?r=" +
      referrer +
      "&l=" +
      location;
    let s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(po, s);
    po.addEventListener("load", function () {
      if (document.getElementById("online-icon"))
        document.getElementById(
          "online-icon"
        ).innerHTML = `<p class="d_txt d_h1" id="p_chat_mssg">¡H O L A!</>`;
    });
  })();
};
