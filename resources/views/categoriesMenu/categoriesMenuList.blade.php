@forelse ($collection as $category)
    @include ('categoriesMenu.categoriesMenuListItem')
@empty
    <!-- Нет опубликованных комментариев -->
@endforelse