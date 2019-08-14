@if (isset($categoriesMenu[$category->id]))

	<a id="{{$category->slug}}" href="{{ route('allProductsByCategory', $category->slug) }}" class="categoryMenuItem list-group-item list-group-item-success">{{$category->name}} 
		<span class="pull-right" href="#{{$category->id}}" data-parent="#{{$category->id}}" data-toggle="collapse"><i class="fa fa-plus"></i></span>
		</a>
    <div class="collapse" id="{{$category->id}}">
    @include ('categoriesMenu.categoriesMenuList', ['collection' => $categoriesMenu[$category->id]])
    </div>
@else
<a id="{{$category->slug}}" href="{{ route('allProductsByCategory', $category->slug) }}" class="categoryMenuItem list-group-item list-group-item-success" data-parent="#MainMenu">{{$category->name}}</a>  
@endif