@php
    $hasChildren = empty($url) && ! $slot->isEmpty();
@endphp
<a
    href="{{ empty($url) ? '#' : $url }}"
    class="nav-link @if ($hasChildren) collapsed @endif"
    @if ($hasChildren)
        data-toggle="collapse"
        data-target="#sidebarMenu-{{ $menuId }}"
        aria-expanded="false"
        aria-controls="collapseUses"
    @endif
>
    @if ($icon)
        <div class="sb-nav-link-icon">
            <x-admin-icon :icon="$icon"/>
        </div>
    @endif
    {{ $title }}
    @if ($hasChildren)
        <div class="sb-sidenav-collapse-arrow">&#9662;</div>
    @endif
</a>
@if ($hasChildren)
<div id="sidebarMenu-{{ $menuId }}" class="collapse" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
        {{ $slot }}
    </nav>
</div>
@endif
