<div class="page-nav">
    <div class="pusher"></div>
    <?php
        if(!isset($clickparams)) {
            $clickparams = '';
        } else{
            $clickparams = ', ' . $clickparams;
        }

        $buttonconfig;
        if($currentpage === 1){
            $buttonconfig = '<a class="btn page-nav-btn-lr-n" name="navigation button">';
        }
        else{
            $buttonconfig = '<a class="btn page-nav-btn-lr"  name="navigation button"
                            onclick="' . $clickfunction . '(' . 1 . $clickparams . ')' . '">';
        }
        echo $buttonconfig . "&lt First </a>";
    ?>
    <div class="page-nav-btn-clstr">
        <div class="pusher"></div>
        <?php
            if($pagelen <= 5){
                for ($i=1; $i <= $pagelen; $i++) { 
                    if($i === $currentpage){
                        $buttonconfig = '<a class="btn page-nav-btn-on" name="navigation button">';
                    }
                    else{
                        $buttonconfig = '<a class="btn page-nav-btn" name="navigation button"
                                        onclick="' . $clickfunction . '(' . $i . $clickparams . ')' . '">';
                    }
                    echo $buttonconfig . $i ."</a>";
                }
            }
            else{
                $offsetL = $currentpage - 2;
                $offsetR = $currentpage + 2;

                if($offsetL <= 0){
                    for ($i = 1; $i <= 5; $i++) { 
                        if($i === $currentpage){
                            $buttonconfig = '<a class="btn page-nav-btn-on" name="navigation button">';
                        }
                        else{
                            $buttonconfig = '<a class="btn page-nav-btn name="navigation button""
                                            onclick="' . $clickfunction . '(' . $i . $clickparams . ')' . '">';
                        }
                        echo $buttonconfig . $i ."</a>";
                    }
                }
                else if($offsetR >= $pagelen){
                    for ($i = $pagelen - 4; $i <= $pagelen; $i++){ 
                        if($i === $currentpage){
                            $buttonconfig = '<a class="btn page-nav-btn-on"> name="navigation button"';
                        }
                        else{
                            $buttonconfig = '<a class="btn page-nav-btn" name="navigation button"
                                            onclick="' . $clickfunction . '(' . $i . $clickparams . ')' . '">';
                        }
                        echo $buttonconfig . $i ."</a>";
                    }
                }else{
                    for ($i = $currentpage - 2; $i <= $currentpage + 2; $i++){ 
                        if($i === $currentpage){
                            $buttonconfig = '<a class="btn page-nav-btn-on"> name="navigation button"';
                        }
                        else{
                            $buttonconfig = '<a class="btn page-nav-btn" name="navigation button"
                                            onclick="' . $clickfunction . '(' . $i . $clickparams . ')' . '">';
                        }
                        echo $buttonconfig . $i ."</a>";
                    }
                }
            }
        ?>
        <div class="pusher"></div>
    </div>
    <?php
        if($currentpage === $pagelen || $pagelen <= 1){
            $buttonconfig = '<a class="btn page-nav-btn-lr-n" name="navigation button">';
        }
        else{
            $buttonconfig = '<a class="btn page-nav-btn-lr" name="navigation button"
                            onclick="' . $clickfunction . '(' . $pagelen . $clickparams . ')' . '">';
        }
        echo $buttonconfig . "Last > </a>";
    ?>
    <div class="pusher"></div>
</div>