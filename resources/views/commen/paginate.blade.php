<ui class="pagination">
    @if ($paginator->lastPage() > 1)
        <div class="text-muted pull-left" style="color: #aeaeae; cursor: auto; line-height: 38px; padding-right: 5px">{{ $paginator->total() }}</div>
        <li>
            <a class="btn btn-default {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}" href="{{ $paginator->url(1) }}">First</a>
        </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <?php
            $half_total_links = floor(10 / 2);
            $from = $paginator->currentPage() - $half_total_links;
            $to = $paginator->currentPage() + $half_total_links;
            if ($paginator->currentPage() < $half_total_links) {
                $to += $half_total_links - $paginator->currentPage();
            }
            if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
            }
            ?>
            @if ($from < $i && $i < $to)
                @if($paginator->currentPage() == $i)
                    <li class="active">
                        <span>{{ $i }}</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    </li>
                @endif

            @endif
        @endfor
        <li>
            <a href="{{ $paginator->url($paginator->lastPage()) }}"
               class="btn btn-default {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">Last</a>

        </li>

    @endif
</ui>
