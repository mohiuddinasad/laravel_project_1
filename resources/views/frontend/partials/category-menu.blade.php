@if ($category->children->count() > 0)
    <li class="dropdown-submenu">
        <a class="dropdown-item" href="{{ route('frontend.categories.show', $category->slug) }}">
            <span>{{ $category->title }}</span>
            <iconify-icon icon="iconamoon:arrow-right-2-duotone" width="18" height="18" class="submenu-arrow"></iconify-icon>
        </a>

        <ul class="dropdown-menu submenu">
            @foreach ($category->children as $child)
                @include('frontend.partials.category-menu', ['category' => $child])
            @endforeach
        </ul>
    </li>
@else
    <li>
        <a class="dropdown-item" href="{{ route('frontend.categories.show', $category->slug) }}">
            {{ $category->title }}
        </a>
    </li>
@endif
