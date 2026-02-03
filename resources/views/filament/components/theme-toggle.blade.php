@php
    $theme = \App\Models\Setting::get('admin_theme', 'light');
    $isDarkInit = $theme === 'dark' ? 'true' : 'false';
@endphp

<div x-data="{ isDark: @js($isDarkInit === 'true') }"
     style="display:inline-flex;align-items:center;margin-left:1rem;padding:0 0.5rem;"
     x-init="() => { if (isDark) document.documentElement.classList.add('dark'); }"
>
    <button
        x-on:click.prevent="isDark = !isDark; if (isDark) document.documentElement.classList.add('dark'); else document.documentElement.classList.remove('dark'); localStorage.setItem('theme', isDark ? 'dark' : 'light'); fetch('/admin/toggle-theme', { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']')?.getAttribute('content') || '' }, body: JSON.stringify({ theme: isDark ? 'dark' : 'light' }) })"
        x-bind:title="isDark ? 'Switch to Light Mode' : 'Switch to Dark Mode'"
        style="background:none;border:0;padding:0.5rem;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;border-radius:0.5rem;transition:background-color 0.2s;color:#6b7280;"
        x-bind:style="{ color: isDark ? '#fbbf24' : '#6b7280', backgroundColor: isDark ? 'rgba(251, 191, 36, 0.1)' : 'rgba(107, 114, 128, 0.1)' }"
        x-on:mouseenter="$el.style.backgroundColor = isDark ? 'rgba(251, 191, 36, 0.2)' : 'rgba(107, 114, 128, 0.2)'"
        x-on:mouseleave="$el.style.backgroundColor = isDark ? 'rgba(251, 191, 36, 0.1)' : 'rgba(107, 114, 128, 0.1)'"
    >
        <!-- Sun Icon -->
        <svg x-show="!isDark" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="5"></circle>
            <line x1="12" y1="1" x2="12" y2="3"></line>
            <line x1="12" y1="21" x2="12" y2="23"></line>
            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
            <line x1="1" y1="12" x2="3" y2="12"></line>
            <line x1="21" y1="12" x2="23" y2="12"></line>
            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
        </svg>
        <!-- Moon Icon -->
        <svg x-show="isDark" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
        </svg>
    </button>
</div>
