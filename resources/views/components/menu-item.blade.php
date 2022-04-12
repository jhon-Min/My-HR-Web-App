<a href="{{ $link }}" class="nav_link {{ request()->url() == $link ? 'active-item' : '' }}">
    <i class="{{ $icon }}"></i>
    <span class="nav_name">{{ $slot }}</span>
</a>
