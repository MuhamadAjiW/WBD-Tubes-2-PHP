<div class="page-nav">
    <div class="pusher"></div>
    <?php
        $buttonconfig;
        if($currentpage === 1){
            $buttonconfig = '<button class="btn page-nav-btn-lr-n">';
        }
        else{
            $buttonconfig = '<button class="btn page-nav-btn-lr"
                                onclick="location.href=\'home?page=' . 1 . '\'">';
        }
        echo $buttonconfig . "&lt First </button>";
    ?>
    <div class="page-nav-btn-clstr">
        <div class="pusher"></div>
        <?php
            if($pagelen <= 5){
                for ($i=1; $i <= $pagelen; $i++) { 
                    if($i === $currentpage){
                        $buttonconfig = '<button class="btn page-nav-btn-on">';
                    }
                    else{
                        $buttonconfig = '<button class="btn page-nav-btn"
                                            onclick="location.href=\'home?page=' . $i . '\'">';
                    }
                    echo $buttonconfig . $i ."</button>";
                }
            }
            else{
                $offsetL = $currentpage - 2;
                $offsetR = $currentpage + 2;

                if($offsetL <= 0){
                    for ($i = 1; $i <= 5; $i++) { 
                        if($i === $currentpage){
                            $buttonconfig = '<button class="btn page-nav-btn-on">';
                        }
                        else{
                            $buttonconfig = '<button class="btn page-nav-btn"
                                                onclick="location.href=\'home?page=' . $i . '\'">';
                        }
                        echo $buttonconfig . $i ."</button>";
                    }
                }
                else if($offsetR >= $pagelen){
                    for ($i = $pagelen - 4; $i <= $pagelen; $i++){ 
                        if($i === $currentpage){
                            $buttonconfig = '<button class="btn page-nav-btn-on">';
                        }
                        else{
                            $buttonconfig = '<button class="btn page-nav-btn"
                                                onclick="location.href=\'home?page=' . $i . '\'">';
                        }
                        echo $buttonconfig . $i ."</button>";
                    }
                }else{
                    for ($i = $currentpage - 2; $i <= $currentpage + 2; $i++){ 
                        if($i === $currentpage){
                            $buttonconfig = '<button class="btn page-nav-btn-on">';
                        }
                        else{
                            $buttonconfig = '<button class="btn page-nav-btn"
                                                onclick="location.href=\'home?page=' . $i . '\'">';
                        }
                        echo $buttonconfig . $i ."</button>";
                    }
                }
            }
        ?>
        <div class="pusher"></div>
    </div>
    <?php
        if($currentpage === $pagelen){
            $buttonconfig = '<button class="btn page-nav-btn-lr-n">';
        }
        else{
            $buttonconfig = '<button class="btn page-nav-btn-lr"
                                onclick="location.href=\'home?page=' . $pagelen . '\'">';
        }
        echo $buttonconfig . "Last > </button>";
    ?>
    <div class="pusher"></div>
</div>