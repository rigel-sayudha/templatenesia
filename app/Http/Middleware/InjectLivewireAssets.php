<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class InjectLivewireAssets
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Hanya inject untuk HTML responses
        if (! $this->isHtmlResponse($response)) {
            return $response;
        }

        $content = $response->getContent();

        $csrfToken = csrf_token();
        $csrfMetaPattern = '/<meta\s+name=["\']csrf-token["\']\s+content=["\'](.*?)["\']\s*\/?>/i';
        
        if (preg_match($csrfMetaPattern, $content)) {
            $content = preg_replace(
                $csrfMetaPattern,
                sprintf('<meta name="csrf-token" content="%s" />', htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8')),
                $content
            );
        } else {
            $headPattern = '/<head[^>]*>/i';
            if (preg_match($headPattern, $content)) {
                $csrfMeta = sprintf(
                    "\n    <meta name=\"csrf-token\" content=\"%s\" />\n",
                    htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8')
                );
                $content = preg_replace($headPattern, '$0' . $csrfMeta, $content, 1);
            }
        }

        if (strpos($content, 'livewire.js') === false && strpos($content, '</head>') !== false) {
            $livewireScript = "\n    <script src=\"/livewire/livewire.js\"></script>\n";
            $content = str_replace('</head>', $livewireScript . '</head>', $content);
        }

        $response->setContent($content);
        return $response;
    }

    private function isHtmlResponse($response): bool
    {
        $contentType = $response->headers->get('Content-Type', '');
        return strpos($contentType, 'text/html') !== false || $contentType === '';
    }
}
