<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;

class InjectAdminThemeScript
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // only inject on admin routes and HTML responses
        if (! $request->is('admin*')) {
            return $response;
        }

        $contentType = $response->headers->get('Content-Type') ?? '';
        if (stripos($contentType, 'text/html') === false) {
            return $response;
        }

        $theme = Setting::get('admin_theme', 'light');

        $script = <<<HTML

<script>
(function(){
    var theme = '{$theme}';
    try {
        if (theme === 'dark') document.documentElement.classList.add('dark');
    } catch(e){}

    var btn = document.createElement('button');
    btn.id = 'admin-theme-toggle';
    btn.innerText = theme === 'dark' ? '🌙' : '☀️';
    btn.style.cssText = 'position:fixed;right:12px;bottom:12px;z-index:9999;padding:8px;border-radius:8px;background:var(--color-bg,#fff);border:1px solid rgba(0,0,0,0.08);cursor:pointer';

    btn.onclick = function(){
        var isDark = document.documentElement.classList.toggle('dark');
        var newTheme = isDark ? 'dark' : 'light';
        btn.innerText = isDark ? '🌙' : '☀️';
        try {
            fetch('/admin/toggle-theme', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '' },
                body: JSON.stringify({ theme: newTheme })
            });
        } catch (e) { console.error(e); }
    };

    document.addEventListener('DOMContentLoaded', function(){
        document.body.appendChild(btn);
    });
})();
</script>
HTML;

        $content = $response->getContent();

        // insert before closing </body> if present, else append
        if (stripos($content, '</body>') !== false) {
            $content = str_ireplace('</body>', $script . "\n</body>", $content);
        } else {
            $content .= $script;
        }

        $response->setContent($content);
        return $response;
    }
}
