<?php
    if ($pagination['lastpage'] > 0) {
?>
<div class="pagination">
<ul>
    <?php 


        $previous_page = $pagination['page'] - 1;
        if ($previous_page < 0) {
            $previous_page = -1;
        }

        $next_page = $pagination['page'] + 1;
        if ($next_page > $pagination['lastpage']) {
            $next_page = -1;
        }

        $min_page_range = $pagination['page'] - 3;
        $max_page_range = $pagination['page'] + 3;

        if ($pagination['lastpage'] > 7) {
            if ($min_page_range < 0) {
                $min_page_range = 0;
                $max_page_range += 3 - $pagination['page'];
            }

            if ($max_page_range > $pagination['lastpage']) {
                $min_page_range -= $max_page_range - $pagination['lastpage'];
                $max_page_range = $pagination['lastpage'];
            }
        } else {
            $min_page_range = 0;
            $max_page_range = $pagination['lastpage'];
        }



        if ($previous_page != -1) { 
            echo '<li><a href="?page=' . $previous_page . '&' . $pagination['urlparams'] . '">Prev</a></li>';
        } else {
            echo '<li><a href="#" class="disabled">Prev</a></li>';
        }

        for ($i = $min_page_range; $i <= $max_page_range; $i++) {
            echo '<li><a href="?page=' . $i . '&' . $pagination['urlparams'] . '"';
            if ($i == $pagination['page']) {
                echo ' class="active"';
            }
            echo '>' . $i . '</a></li>';
        }


        if ($next_page != -1) { 
            echo '<li><a href="?page=' . $next_page . '&' . $pagination['urlparams'] . '">Next</a></li>';
        } else {
            echo '<li><a href="#" class="disabled">Next</a></li>';
        }

    ?>
    
</ul>
</div>
<?php 
    }
?>