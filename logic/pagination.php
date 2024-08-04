<?php
    $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1 ;
    $recordsPerPage = 10;
    $totalRecords = count($inquiriesArray) ;
    $totalPages = ceil($totalRecords/$recordsPerPage);
    $startIndex = ($currentPage - 1) * $recordsPerPage;
    $slicedInquiriesArray = array_slice($inquiriesArray, $startIndex, $recordsPerPage);