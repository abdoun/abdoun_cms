<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * Privacy notice / cookie consent modal ("Datenschutzerklärung").
 *
 * The returned markup is injected into the <privacy_tag /> placeholder of
 * both springbre templates at the END of the front controllers, after the global
 * "images" / "style." URL rewrites, so the inline CSS and JavaScript are
 * left untouched.
 *
 * No JavaScript -> the overlay stays hidden, so the site remains usable.
 * Clicking OK stores consent in a browser cookie for one year and a small
 * "Privacy" tab is shown so the notice can be reopened at any time.
 */
class privacy
{
    private static function esc($value)
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    public static function view($l='')
    {
        $rtl = (defined('_DIR') && _DIR == 'rtl');
        $modifier = $rtl ? ' ab-privacy-rtl' : '';

        $html = '<style type="text/css">' . "\n"
              . '.ab-privacy{display:none;position:fixed;top:0;right:0;bottom:0;left:0;z-index:2147483000;background:rgba(0,0,0,0.62);overflow:auto;padding:18px;}' . "\n"
              . '.ab-privacy.is-visible{display:block;}' . "\n"
              . '.ab-privacy-dialog{background:#ffffff;color:#222222;max-width:560px;width:100%;margin:6vh auto 18px;border-radius:5px;box-shadow:0 8px 30px rgba(0,0,0,0.4);font-family:Arial,Tahoma,sans-serif;font-size:14px;line-height:1.6;}' . "\n"
              . '.ab-privacy-header{padding:18px 22px 0;}' . "\n"
              . '.ab-privacy-title{margin:0;font-size:20px;font-weight:bold;}' . "\n"
              . '.ab-privacy-subtitle{margin:2px 0 0;font-size:12px;color:#777777;}' . "\n"
              . '.ab-privacy-body{padding:14px 22px 0;}' . "\n"
              . '.ab-privacy-lead{margin:0 0 12px;}' . "\n"
              . '.ab-privacy-warning{margin:0 0 12px;padding:12px 14px;background:#fff6e5;border-left:4px solid #d98600;border-radius:3px;}' . "\n"
              . '.ab-privacy-warning-title{margin:0 0 6px;font-weight:bold;color:#8a4b00;}' . "\n"
              . '.ab-privacy-cookies{margin:0;color:#555555;}' . "\n"
              . '.ab-privacy-footer{padding:8px 22px 20px;text-align:right;}' . "\n"
              . '.ab-privacy-ok{background:#acbebc;color:#1d2b2a;border:1px solid #8fa6a3;padding:9px 22px;font-size:14px;font-weight:bold;cursor:pointer;border-radius:3px;}' . "\n"
              . '.ab-privacy-ok:hover{background:#9db3b0;}' . "\n"
              . '.ab-privacy-rtl .ab-privacy-footer{text-align:left;}' . "\n"
              . '.ab-privacy-rtl .ab-privacy-warning{border-left:0;border-right:4px solid #d98600;}' . "\n"
              . '.ab-privacy-reopen{display:none;position:fixed;bottom:0;left:0;z-index:2147482990;padding:7px 12px;background:#acbebc;color:#1d2b2a;border:0;border-radius:0 3px 0 0;font-family:Arial,Tahoma,sans-serif;font-size:12px;font-weight:bold;cursor:pointer;}' . "\n"
              . '.ab-privacy-reopen.is-visible{display:block;}' . "\n"
              . '.ab-privacy-rtl .ab-privacy-reopen{left:auto;right:0;border-radius:3px 0 0 0;}' . "\n"
              . '</style>' . "\n";

        $html .= '<div id="abdoun-privacy" class="ab-privacy' . $modifier . '" role="dialog" aria-modal="true" aria-labelledby="ab-privacy-title" aria-describedby="ab-privacy-desc" dir="' . ($rtl ? 'rtl' : 'ltr') . '">' . "\n"
               . '  <div class="ab-privacy-dialog">' . "\n"
               . '    <div class="ab-privacy-header">' . "\n"
               . '      <h2 class="ab-privacy-title" id="ab-privacy-title">' . self::esc(_PRIVACY_TITLE) . '</h2>' . "\n"
               . '      <p class="ab-privacy-subtitle">' . self::esc(_PRIVACY_SUBTITLE) . '</p>' . "\n"
               . '    </div>' . "\n"
               . '    <div class="ab-privacy-body" id="ab-privacy-desc">' . "\n"
               . '      <p class="ab-privacy-lead">' . self::esc(_PRIVACY_LEAD) . '</p>' . "\n"
               . '      <div class="ab-privacy-warning">' . "\n"
               . '        <p class="ab-privacy-warning-title">' . self::esc(_PRIVACY_WARNING_TITLE) . '</p>' . "\n"
               . '        <p>' . self::esc(_PRIVACY_WARNING) . '</p>' . "\n"
               . '      </div>' . "\n"
               . '      <p class="ab-privacy-cookies">' . self::esc(_PRIVACY_COOKIES) . '</p>' . "\n"
               . '    </div>' . "\n"
               . '    <div class="ab-privacy-footer">' . "\n"
               . '      <button type="button" class="ab-privacy-ok" id="abdoun-privacy-ok">' . self::esc(_PRIVACY_OK) . '</button>' . "\n"
               . '    </div>' . "\n"
               . '  </div>' . "\n"
               . '</div>' . "\n"
               . '<button type="button" class="ab-privacy-reopen' . $modifier . '" id="abdoun-privacy-reopen">' . self::esc(_PRIVACY_LINK) . '</button>' . "\n";

        $html .= '<script type="text/javascript">' . "\n"
               . '(function () {' . "\n"
               . '  var name = "abdoun_privacy";' . "\n"
               . '  var overlay = document.getElementById("abdoun-privacy");' . "\n"
               . '  var ok = document.getElementById("abdoun-privacy-ok");' . "\n"
               . '  var reopen = document.getElementById("abdoun-privacy-reopen");' . "\n"
               . '  if (!overlay || !ok || !reopen) { return; }' . "\n"
               . '  function accepted() {' . "\n"
               . '    var parts = document.cookie.split(";");' . "\n"
               . '    for (var i = 0; i < parts.length; i++) {' . "\n"
               . '      var part = parts[i].replace(/^\\s+/, "");' . "\n"
               . '      if (part.indexOf(name + "=") === 0) { return part.substring(name.length + 1) === "1"; }' . "\n"
               . '    }' . "\n"
               . '    return false;' . "\n"
               . '  }' . "\n"
               . '  function show(element) {' . "\n"
               . '    if (element.classList) { element.classList.add("is-visible"); }' . "\n"
               . '    else { element.className += " is-visible"; }' . "\n"
               . '  }' . "\n"
               . '  function hide(element) {' . "\n"
               . '    if (element.classList) { element.classList.remove("is-visible"); }' . "\n"
               . '    else { element.className = element.className.replace(/(^|\\s)is-visible(\\s|$)/g, " "); }' . "\n"
               . '  }' . "\n"
               . '  function onClick(element, handler) {' . "\n"
               . '    if (element.addEventListener) { element.addEventListener("click", handler); }' . "\n"
               . '    else if (element.attachEvent) { element.attachEvent("onclick", handler); }' . "\n"
               . '    else { element.onclick = handler; }' . "\n"
               . '  }' . "\n"
               . '  onClick(ok, function () {' . "\n"
               . '    var date = new Date();' . "\n"
               . '    date.setFullYear(date.getFullYear() + 1);' . "\n"
               . '    document.cookie = name + "=1; expires=" + date.toUTCString() + "; path=/; SameSite=Lax";' . "\n"
               . '    hide(overlay);' . "\n"
               . '    show(reopen);' . "\n"
               . '  });' . "\n"
               . '  onClick(reopen, function () { show(overlay); if (ok.focus) { ok.focus(); } });' . "\n"
               . '  if (accepted()) { show(reopen); }' . "\n"
               . '  else { show(overlay); if (ok.focus) { ok.focus(); } }' . "\n"
               . '})();' . "\n"
               . '</script>' . "\n";

        return $html;
    }
}
?>
