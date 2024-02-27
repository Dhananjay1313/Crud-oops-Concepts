<?php

class SearchPagination {
    private $data;
    private $itemsPerPage;
    private $currentPage;

    public function __construct(array $data, $itemsPerPage = 5) {
        $this->data = $data;
        $this->itemsPerPage = $itemsPerPage;
        $this->currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    }

    public function performSearch($searchTerm) {
        $searchTerm = strtolower($searchTerm);
        $results = [];

        foreach ($this->data as $item) {
            if (stripos(strtolower($item), $searchTerm) !== false) {
                $results[] = $item;
            }
        }

        return $results;
    }

    public function getPaginatedResults($searchTerm) {
        $searchResults = $this->performSearch($searchTerm);

        $totalResults = count($searchResults);
        $offset = ($this->currentPage - 1) * $this->itemsPerPage;

        $paginatedResults = array_slice($searchResults, $offset, $this->itemsPerPage);

        return [
            'results' => $paginatedResults,
            'totalResults' => $totalResults,
        ];
    }

    public function renderPaginationLinks($searchTerm) {
        $totalResults = $this->getPaginatedResults($searchTerm)['totalResults'];
        $totalPages = ceil($totalResults / $this->itemsPerPage);

        $paginationHTML = '<ul class="pagination">';
        for ($i = 1; $i <= $totalPages; $i++) {
            $activeClass = ($i == $this->currentPage) ? 'active' : '';
            $paginationHTML .= "<li class='page-item $activeClass'><a class='page-link' href='?page=$i&search=$searchTerm'>$i</a></li>";
        }
        $paginationHTML .= '</ul>';

        return $paginationHTML;
    }
}
?>