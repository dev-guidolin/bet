<?php
/*show_array($paises);*/
?>



<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <h3>Paises</h3>
            <ul class="list-group">
                <?php
                    foreach ($paises as $item){ ?>

                        <a href="<?php echo base_url('futebol/ligas/').$item['slug'] ;?>" style="text-decoration: none; color: #333333">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo $item['nome_pais'];?>
                                <span class="flag-icon flag-icon-<?php echo $item['flag'];?>"></span>
                            </li>
                        </a>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
