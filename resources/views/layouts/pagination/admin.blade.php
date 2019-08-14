<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item {{$paginator->onFirstPage() ? 'disabled' : ''}}"><a class="page-link" href="{{$paginator->previousPageUrl()}}">Предыдущая</a></li>
    <li class="page-item {{$paginator->hasMorePages() ? '' : 'disabled'}}"><a class="page-link" href="{{$paginator->nextPageUrl()}}">Следующая</a></li>
  </ul>
</nav>   